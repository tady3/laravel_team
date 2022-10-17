<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Tag;
use App\Models\User;
use App\Models\Tweet;
use App\Models\CardLike; //cardlikeを追記
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return redirect('tweets-index/'.auth()->user()->id); 

    }
        // $tweets = Tweet::all(); //全て取ってくるというメソッド。
        


    public function showTweetsIndex($id)
    {   
        $user_id = auth()->user()->id;

        //$idの中身が"user_id"でダブルクオテーションがどうしてもエスケープできなかったので、user_idにダブルクォテーションをつけた
        $usr_id = stripslashes($user_id); 
        
        $tweets = Tweet::with(['user','tags']);

        //Tweetモデルのクエリビルダを開始。queryにしないと、orderByやgetが謎にエラーが出てしまう
        $query = Tweet::query()->where([['published',1]]);

        if($id==$user_id)           //表示ページの投稿者IDとログインしているユーザーのIDが一致してたら
        {
        $tweets = $tweets
        ->where('user_id',$id)

        ->orderBy('created_at','desc')
        ->get(); //Eager Loadの描き方

        }
        else
        {
            $tweets=$query->where('user_id',$id)
    
            ->orderBy('created_at','desc')
            ->get(); //Eager Loadの描き方
    
        }
        $tags = Tag::all();
        $card_likes =CardLike::all(); //card_likesから全て取ってくる

        return view('tweets-index',compact('tweets','tags','card_likes')
       );
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showThumbnail(Tweet $tweet)
    {


        return view('tweets-index',compact('title','image')
    );
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function store(Request $request)
    {
        // バリデーション（空欄投稿でもエラー表示でなく注意書きが出るようにする）追記開始
		$validated = $request->validate([ //validateというメソッドを使う指示。
            'message' => 'required|max:100'         //messageは記入が求められているrequiredだということを記載。その上で最大値も記載
        ]);
        // 追記終了


        $tweet = Tweet::create([
            'message' => $validated['message'],          // データを新規作成
            
            //多田追記
            'bywho' => $request['bywho'],
            'source' => $request['source'],

            'withwho' => $request['withwho'],
            'location' => $request['location'],
            'category' => $request['category'],
           

            'when' => $request['when'],
            'url' => $request['url'],
            'story' => $request['story'],
            'rate' => $request['rate'],
            'published' => $request['published'],            
            'card_type_id' => $request['card_type_id'],
            //多田追記、了

            'user_id' => auth()->user()->id,//ログイン中のユーザのIDを取ってきてそれをDBに入れる
        ]); 

        if ($request->has('impact')) {
            $impact = $request->impact; 
            $string = implode(",", $impact);
            $tweet->impact = $string;
        }
        

        // アップロードされたファイル名を取得     
        $file_name = $request->file('img');
        if($request->hasFile('img')){
            
        // // 取得したファイル名で保存
        $file_name = $request->img->getClientOriginalName();
        $img =$request->img->storeAs('',$file_name,'public');

        }else{
            $img = null;
        }

        // ファイル情報をDBに保存
        $tweet->update(['img'=> $img]);

        
        $tweet->tags()->attach($request->tags); 
        
        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show()
    {
        // $tweets = Tweet::with(['user','tags'])
        $tags = Tag::where('id','<=',9)->get();

        // dd($tweets);

        return view('tweets-form', [
            'tags'=>$tags
        ]);
    }

    public function showFoods()
    {
        // $tweets = Tweet::with(['user','tags'])
        $tags = Tag::where('id','>=',10)->get();

        // dd($tweets);

        return view('tweets-food-form', [
            'tags'=>$tags
        ]);
    }

    public function showMedias()
    {
        // $tweets = Tweet::with(['user','tags'])
        $tags = Tag::where('id','<=',9)->get();

        // dd($tweets);

        return view('tweets-media-form', [
            'tags'=>$tags
        ]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Tweet $tweet) // ここも $id から書き変わっている点注意！
    {
        $this->authorize('update', $tweet); 
        
        if($tweet->card_type_id == 1 or 3)
        {
            $tags = Tag::where('id','<=',9)->get();
        }
        else
        {   
            $tags = Tag::where('id','>=',10)->get();
        }

        $selectedTags = $tweet->tags->pluck('id')->all();

        return view('card-edit', [
            'tweet' => $tweet,
            'tags' => $tags,
            'selectedTags' => $selectedTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet) // ここも変わってる点注意！
    {
            // ツイートのメッセージ内容を更新
        $tweet->update([
            'message' => $request->message,

            'bywho' => $request->bywho,
            'source' => $request->source,
            'withwho' => $request->withwho,
            'location' => $request->location,
            'category' => $request->category,

            'when' => $request->when,
            'url' => $request->url,
            'story' => $request->story,
            'rate' => $request->rate,
            'published' => $request->published,
    
    ]);

        if ($request->has('impact')) {
            $impact = $request->impact; 
            $string = implode(",", $impact);
            $tweet->update(['impact' => $string]);
        }

    //ファイルアップロード（新規作成）
    $file_name = $request->file('img');
    if($request->hasFile('img')){
        $file_name = $request->img->getClientOriginalName();
        $img =$request->img->storeAs('',$file_name,'public');
        
    // ファイル情報をDBに保存
    //updateの時は、新しい送信ファイルがあるときだけファイル名を変更すれば良いので、Null値の条件分岐は不要で。ファイル名変更はここに書けば良い。
        $tweet->update(['img'=> $img]); 
        // }else{
        //     $img = null;
        }

        $this->authorize('update', $tweet); 


        // ツイートに紐づいているタグを更新
        $tweet->tags()->sync($request->tags);
        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {   
        $id=$tweet->id;
        $tweet->deleteCardLike($id);
        $tweet->deleteComment($id);
        $this->authorize('update', $tweet); 
        $tweet->tags()->detach(); //tweetを削除する際にtagとの関係性を一旦解除してから削除している
        $tweet->delete();
        return redirect()->route('tweets.index');
    }

   
    // $users = \App\User::where([
    //     ['id', 2],
    //     ['name', 'like', '鈴木%']
    // ])->get();

    public function search(Request $request)
    {
        // バリデーション追記開始
            if(!$request->has('keyword')) {
                return redirect('/tweets-index');
            }
        // バリデーション追記終了

        // キーワードを取得
        // $keyword = $request->keyword;
        // $tweets = Tweet::paginate(20); //ページネーション
        $keyword = $request->get('keyword');        
        $tweets = Tweet::with(['user', 'tags']);
        $query = Tweet::query();
        // ->where([['published',1]]);//Tweetモデルのクエリビルダを開始
        $nt = 0;

        if (isset($keyword)) 
            {
            $array_keywords = preg_split('/\s+/ui', $keyword, -1, PREG_SPLIT_NO_EMPTY); //複数キーワードをスペース区切った配列にする
            $n = count($array_keywords); //入力された言葉の数を数える 
            
            $words = []; //配列を宣言
            for ($i=0; $i<$n; $i++) {
                $words[] = addcslashes(($array_keywords[$i]), '\\_%');    //入力した言葉をエスケープ化し、言葉を配列に入れるということを、入力した言葉の数だけ繰り返す
            }

            $tweets=[];   //配列を宣言。複数キーワードがある場合、変数だと上書きされてしまうので、結果を一つずつ配列に入れたい。多次元配列になる。
                foreach ($words as $w) {
                    // $search_data=Tweet::where([['published',1]])
                    // ->where(function($query){ 
                    
                    $query = $query->where([['published', 1] , ['message', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['bywho', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['location', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['withwho', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['source', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['when', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['impact', 'LIKE', '%'.$w .'%']])
                    ->orwhere([['published', 1] ,['story', 'LIKE', '%'.$w .'%']])
                    ->orWhereHas('tags', function ($tag_query) use ($w )
                        {
                        $tag_query->where([['published', 1],['name', 'like', '%' . $w  . '%']]);
                        })
                    ->orderBy('created_at', 'desc'); // 追記          
                    };
                // }

            
            $tweets[] = $query->get(); //検索結果が配列になったものをとってきている 
    

            $nt=count($tweets[0]);   //検索結果の配列の数を数える。[0]を入れることで階層を一つ下げている。
    
            }
        return view(
            'search',
            [    'keyword'=>$keyword,
                'tweets' => $tweets,
                'nt'=>$nt
            ]
        );

        }


//card_likes用の記述

    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
  {
    $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
  }


   /**
  * 引数のIDに紐づくTweetにLIKEする
  *
  * @param $id リプライID
  * @return \Illuminate\Http\RedirectResponse
  */
  public function card_like($id)
  {
    CardLike::create([
      'tweet_id' => $id,
      'user_id' => auth()->user()->id,
    ]);

    session()->flash('success', 'You Liked the Tweet.');

    return redirect()->back();
  }

  /**
   * 引数のIDに紐づくtweetにUNLIKEする
   *
   * @param $id tweetID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function card_unlike($id)
  {
    $like = CardLike::where('tweet_id', $id)->where('user_id', auth()->user()->id)->first();
    $like->delete();

    session()->flash('success', 'You Unliked the  Tweet.');

    return redirect()->back();
  }





}

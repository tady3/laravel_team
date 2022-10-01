<?php

namespace App\Http\Controllers;

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
        // $tweets = Tweet::all(); //全て取ってくるというメソッド。
        
        $tweets = Tweet::with(['user','tags'])
        
        //多田追記
        ->where('user_id',auth()->user()->id)
        //多田追記了

        ->orderBy('created_at','desc')
        ->get(); //Eager Loadの描き方

        $tags = Tag::all();
        $card_likes =CardLike::all(); //card_likesから全て取ってくる

        // dd($tweets);

        return view('tweets-index', [
            'tweets' => $tweets,
            'tags'=>$tags,
            'card_likes' =>$card_likes //card_likesを追記

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'when' => $request['when'],
            'url' => $request['url'],
            'story' => $request['story'],
            'rate' => $request['rate'],
            'published' => $request['published'],
            'card_type_id' => $request['card_type_id'],
            //多田追記、了

            'user_id' => auth()->user()->id,          //ログイン中のユーザのIDを取ってきてそれをDBに入れる
        ]); 
        

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
        $tags = Tag::all();

        // dd($tweets);

        return view('tweets-form', [
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
        $tags = Tag::all();
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
        //多田追記
            'bywho' => $request->bywho,
            'source' => $request->source,
            'when' => $request->when,
            'url' => $request->url,
            'story' => $request->story,
            'rate' => $request->rate,
            'published' => $request->published,
        //多田追記、了
    ]);
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
        $this->authorize('update', $tweet); 
        $tweet->tags()->detach(); //tweetを削除する際にtagとの関係性を一旦解除してから削除している
        $tweet->delete();
        return redirect()->route('tweets.index');
    }

   
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
        $query = Tweet::query();//Tweetモデルのクエリビルダを開始
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
            $result=[]; 
            $search_data=Tweet::where([['published',1]])->get();
            foreach($search_data as $s){

            
                foreach ($words as $w) {


                    $query = $query->where('message', 'LIKE', '%'.$w .'%')
                    ->orwhere('bywho', 'LIKE', '%'.$w .'%')
                    ->orwhere('source', 'LIKE', '%'.$w .'%')
                    ->orwhere('when', 'LIKE', '%'.$w .'%')
                    ->orwhere('story', 'LIKE', '%'.$w .'%')
                    ->orWhereHas('tags', function ($tag_query) use ($w )
                        {
                        $tag_query->where('name', 'like', '%' . $w  . '%');
                        })
                    ->orderBy('created_at', 'desc'); // 追記   
                    $result = $query->get(); //検索結果が配列になったものをとってきている
                    // dd(count($result)); 
                    if(count($result)>=1){
                        // foreach($result as $res){
                        //     if($res['id']==$s['id']){
                                
                        //         $tweets[]=$s['message'];};
                        // }

                        for ($i=0; $i<count($result); $i++) 
                        {
                            if($result[$i]['id']==$s['id']){
                                
                            $tweets[]=$result[$i];};
                            // dd($result[$i]['id']);
                        }

                    }
                    // dump($tweets);

                    // dd('aaaaa');
                    // $tweets[] = $query->get();
                    // if($s['id']==$result[0]['id']){
                    //     $tweets[]=$result;
                    // }
                    // dd($result[0]['id']); //keywordが含まれないとエラーになる 
                }
                }
                  
                                
            $nt=count($tweets);   //検索結果の配列の数を数える。[0]を入れることで階層を一つ下げている。
    
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

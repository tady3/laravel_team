<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }


    public function store(Request $request)
    {

        // dd($request);
        
        $comment = Comment::create([
            'comment' => $request['comment'],          // データを新規作成            
            'tweet_id' => $request['tweet_id'],
            'user_id' => auth()->user()->id,          //ログイン中のユーザのIDを取ってきてそれをDBに入れる
        ]); 
        
        return redirect('tweets-index');
    }
 

     public function destroy(Request $request)
     {
         $comment = Comment::find($request->comment_id);
         $comment->delete();
         return redirect()->back();
     }

}

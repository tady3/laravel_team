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


    public function store(Tweet $tweet, Request $request)
    {

        $user_id = Tweet::find($request->tweet_id)->user_id; //tweetに紐づいたユーザーIDを取得
        
        $comment = Comment::create([
            'comment' => $request['comment'],          // データを新規作成            
            'tweet_id' => $request['tweet_id'],
            'user_id' => auth()->user()->id,          //ログイン中のユーザのIDを取ってきてそれをDBに入れる
        ]); 
        
        return redirect(route('tweets.showTweetsIndex',[
            'user'=> $user_id]));                      //tweet-index/user_idとして、投稿者の投稿一覧に戻っている
    }
 

     public function destroy(Request $request)
     {
         $comment = Comment::find($request->comment_id);
         $comment->delete();
         return redirect()->back();
     }

}

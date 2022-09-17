<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
            
    protected $fillable = ['message','user_id','bywho','source','when','url','story','rate','published','img']; // 外部からの書き込みを許可するカラム

    //  // tweets テーブルではなく tweeeeeets テーブルを参照する
    //  protected $table = 'tweeeeeets'; // 設定を上書きしている  今の場合は、Tweetモデルはtweetテーブルと紐づくであろうと勝手に判断してくれるので特に紐付けのところについて書いていない。

    public function user()
    {
        return $this->belongsTo(User::class); // ツイートはユーザを１つ持てる
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function card_type()
    {
    return $this->belongsTo(CardType::class); // ツイートはtypeを１つ持てる
    }   


    //TweetとCardLikeのリレーション
    public function card_likes()
    {
    return $this->hasMany(CardLike::class, 'tweet_id'); // ツイートはtypeを１つ持てる
    }


    /**
     * TweetにLIKEを付いているかの判定
    *
    * @return bool true:Likeがついてる false:Likeがついてない
    */
    public function is_liked_by_auth_user()
    {
        $id = auth()->user()->id;

        $likers = array();
        foreach($this->card_likes as $card_like) {
        array_push($likers, $card_like->user_id);
        }

        if (in_array($id, $likers)) {
        return true;
        } else {
        return false;
        }
    }


    //Tweetとコメントのリレーション

    public function comments() {
        return $this->hasMany(Comment::class); 
    }

}



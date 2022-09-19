<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'search_id',
        'email',
        'password',
        'gender',
        'age',
        'industry',
        'img'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets() 
    {
        return $this->hasMany(Tweet::class); // ユーザはツイートを複数持てる
    }

    public function card_like() 
    {
        return $this->belongsToMany('App\Models\Tweet','card_likes','user_id','tweet_id')->withTimestamps();    
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($tweetId)
    {
      return $this->likes()->where('tweet_id',$tweetId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($tweetId)
    {
      if($this->isLike($tweetId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->likes()->attach($tweetId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($tweetId)
    {
      if($this->isLike($tweetId)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($tweetId);
      } else {
      }
    }


    //コメントとのリレーション
    public function comments()
{
    return $this->hasMany(Comment::class);
}

    //Friendとのリレーション
    public function friends()
{
    return $this->hasMany(friends::class);
}

    
}

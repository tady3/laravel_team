<?php
use App\Http\Controllers\FriendController; // 追記
use App\Http\Controllers\CommentsController; // 追記
use App\Http\Controllers\UserController; // 追記
use App\Http\Controllers\TweetController; // 追記
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('top'); // welcome から top に変更
});

// グループで囲み、その中にエンドポイントを作成
Route::group(['middleware' => ['auth']], function () {

    // Route::resource('tweets', TweetController::class); //下の5行分と同じ

    Route::get('/tweets-index', [TweetController::class, 'index'])->name('tweets.index');
    Route::post('/tweets-index', [TweetController::class, 'store'])->name('tweets.store');
    Route::get('/tweets-index/{user}', [TweetController::class, 'showTweetsIndex'])->name('tweets.showTweetsIndex');

    Route::get('/tweets-form', [TweetController::class, 'show']);
    Route::post('/tweets-form', [TweetController::class, 'store'])->name('tweets.store');

    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');

    Route::get('/search', [TweetController::class, 'search'])->name('tweets.search');


    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.show'); 

    Route::get('/profile-upload', function () {return view('/profile-upload');});
    Route::post('/profile-upload', [UserController::class, 'store'])->name('profile.upload');


    Route::get('/tweets-index/like/{id}', [TweetController::class,'card_like'])->name('tweet.like');
    Route::get('/tweets-index/unlike/{id}', [TweetController::class,'card_unlike'])->name('tweet.unlike');


    //コメント投稿処理
    Route::post('/tweets-index/{user}/{tweet_id}/comments',[CommentsController::class,'store']);

    //コメント取消処理
    Route::get('/comments/{comment_id}', [CommentsController::class,'destroy']);


    //友達検索
    Route::get('/friend-search', [FriendController::class, 'search'])->name('friend.search');

    //友達申請リスト取得
    Route::get('/friend-index', [FriendController::class, 'index'])->name('friend.index');

    //友達申請
    Route::post('/friend-index', [FriendController::class, 'store'])->name('friend.store');

    //友達ステータス変更
    Route::put('/friend-index/{friend_id}', [FriendController::class, 'update'])->name('friend.update');
    
    // Route::get('/friend-index', function () {
    //     return view('friend-index');
    // })->name('friend.index');
    

    // Route::get('/test', function () {
    // return view('test');
    // });


    });

    


require __DIR__.'/auth.php';
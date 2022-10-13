<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function authGoogleCallback()
    {
        // $googleUser = Socialite::driver('google')->stateless()->user();
        // $user = User::firstOrCreate([
        //     'email' => $googleUser->email
        // ], [
        //     'email_verified_at' => now(),
        //     'google_id' => $googleUser->getId()
        // ]);
        // Auth::login($user, true);
        // return redirect('http://localhost/tweets-index');


        $googleUser = Socialite::driver('google')->user();
 

    // emailを基準にユーザーの既存を確認して、
    // 存在しなかったら作成、存在したら更新
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'password'=> $googleUser->token,


        // googleから得られる情報　DBテーブルに対象のカラムがないのでコメントアウト
        //'google_token' => $googleUser->token,
        //'google_refresh_token' => $googleUser->refreshToken,
    ]);

    // ユーザーをログイン済みに
    Auth::login($user);

    // ログイン後のページへ
    return redirect('http://factly.ne.jp/laravel_team/tweets-index');
    }

}
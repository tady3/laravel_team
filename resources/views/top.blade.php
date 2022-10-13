<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selfly </title>

    <!-- Material Design for Bootstrap 読み込み 開始 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}" defer></script>
    <!-- Material Design for Bootstrap 読み込み 終了 -->
</head>
<body class="vh-100">

    <div style="background-image: url({{ asset('img/top.jpg') }});
    background-position: center;
    background-size: cover;
    text-align: center; 
    height:auto; width:auto;
    position: relative;">


    <div class="row">
        <div class=" d-block col-lg-5 vh-80" >
            
            {{-- <img src="{{ asset('img/top.jpg') }}" alt="" class=" vh-100" style="object-fit: cover; height:auto; width:auto;"> --}}
        </div>
        <div class="col-12 col-lg-5 vh-100">
            <div class="vh-100 d-flex flex-column  px-4 px-lg-0 mx-auto" style="position: absolute; text-aling:center">
                <img src="/img/logo.jpg" alt=""  style="width: 150px; opacity:0.75; border-radius:100px; " class="mt-5 mb-5 d-block mx-auto ">

                <h1 class="font-weight-bold mb-1 mx-auto" style="font-size: 16px;">~ ジブンのスキで空を飛ぶ ~</h1>

                <div>
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <div class="mb-6">
                                    <a href="{{ route('tweets.index') }}"  class="btn btn-primary btn-rounded font-weight-bold btn-lg" style="width: 200px;">
                                        「スキ」コレクション
                                    </a>
                                </div>
                            @else
                            <div>
                                <div class="mb-2">
                                    <a href="{{ route('login') }}"  class="btn btn-primary btn-rounded font-weight-bold btn-lg shadow-1" style="width: 200px;">
                                        ログイン
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <a href="/redirect-to-google"  class="btn btn-primary btn-rounded font-weight-bold btn-lg shadow-1" style="width: 200px;" role="button">
                                        Google ログイン
                                    </a>
                                </div>
                            </div>
                            @if (Route::has('register'))
                            <p class="font-weight-bold mb-2 mt-4">アカウントをお持ちでない場合</p>
                                <div class="mb-6">
                                    {{-- <a href="{{ route('register') }}"  class="btn btn-primary btn-rounded font-weight-bold btn-lg shadow-1" style="width: 200px;"> --}}
                                    <a href="{{ route('register') }}"  class="btn btn-outline-primary btn-rounded font-weight-bold btn-lg" style="width: 200px;">
                                        メールアドレスで登録
                                    </a>
                                </div>
                            @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
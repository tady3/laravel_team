<x-app-layout>
    <div class="container mt-4">
        <form method="GET" action="/search">   
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            <input type="search" id="default-search" class="py-3 block p-8 pl-10 w-full text-sm bg--50 text-blue-800 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "  placeholder="投稿を検索" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2" style="background-color:#252f5a">
                検索</button>
            </div>
        </form>
    </div>
    


    <div class="row justify-content-center">
        <button type="button"
          class=" mt-3 py-2.5 px-5 mr-2 mb-2 text-sm font-bold text-white focus:outline-none  rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600  w-64" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  style="background-color:rgb(29 78 216);">
            + スキを投稿する
        </button>
    </div>
<!-- Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0  justify-between p-4 border-b border-gray-200 rounded-t-md">
                </div>
                <div class="modal-body relative p-3 space-x-2 flex justify-content-center">
                    <a href="/tweets-form" type="button" class="inline-block px-10 py-2.5  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg ease-in-out" style = "background-color: #252f5a">コトバ</a>
                    <a href="/tweets-food-form" type="button" class="inline-block px-10 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg ease-in-out" style = "background-color: #ce3126">食事 & 飲み物</a>
                    <a href="/tweets-media-form" type="button" class="inline-block px-10 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg  ease-in-out" style = "background-color: #0d6efd">メディア</a>


                    {{-- <button type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">メモ</button> --}}
                </div>
                <div class="modal-footer flex justify-content-center flex-shrink-0 flex-wrap items-center p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg  ease-in-out" data-bs-dismiss="modal" style = "background-color: #6c757d">キャンセル</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill=" #ec7682" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>  <p style="font-style: bold">「わかる！」リスト</p>                        

                @foreach($tweets as $t)
                {{-- 「多次元配列」に入っているので
                {
                    スラダン（0） => {
                   　　　結果 ※tweet 
                    }
                   　ワンピース（1） => {
                        結果 ※tweet
                    }
                   }
                   階層を一つ掘って、userやtagとリレーションとっているtweetの層にアクセスするために、foreachを2回回す --}}
                @foreach($t as $tweet) 

                <x-tweet-card :tweet="$tweet" />

                @endforeach
            @endforeach
    </div>
        </div>
    </div></x-app-layout>
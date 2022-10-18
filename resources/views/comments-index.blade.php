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
                <svg xmlns="http://www.w3.org/2000/svg" fill="#ADD8E6" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                  </svg>  <p style="font-style: bold">コメント リスト</p>                        

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
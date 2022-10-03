<x-app-layout>

    {{-- <form method="GET" action="/search">
        <input type="search" placeholder="キーワードを入力" name="keyword" value="@if (isset($search)) {{ $search }} @endif">
        <div>
            <button>
                <a href="/search" class="text-white">
                    クリア
                </a>
            </button>
        </div>
    </form> --}}

<div class="container mt-4">
    <div class="row justify-content-center">
        <form method="GET" action="/search">   
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" id="default-search" class=" py-3 block p-8 pl-10 w-full text-sm bg--50 text-blue-800 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="投稿を検索" name="keyword" value="@if (isset($search)) {{ $search }} @endif">
            <button type="submit" class="font-bold text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color:#252f5a">
                検索</button>
        </div>
    </form>
    </div>
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
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                </div>
                <div class="modal-body relative p-3 ">
                    <a href="/tweets-form" type="button" class="inline-block px-10 py-2.5  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style = "background-color: #252f5a">コトバ</a>
                    <a href="/tweets-food-form" type="button" class="inline-block px-10 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out" style = "background-color: #ce3126">食事 & 飲み物</a>

                    {{-- <button type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">メモ</button> --}}
                </div>
                <div class="modal-footer flex justify-content-center flex-shrink-0 flex-wrap items-center p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal" style = "background-color: #953037">キャンセル</button>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">

                @foreach ($tweets as $tweet)
                
                    <x-tweet-card :tweet=$tweet/>
                    <!-- カード 開始 -->
                    
                    
                     <!-- カード終了 -->
                @endforeach
            </div>


        </div>
    </div>
</x-app-layout>
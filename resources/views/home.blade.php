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

    <form method="GET" action="/search">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="  検索ワード" name="keyword" value="@if (isset($search)) {{ $search }} @endif">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>


     <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="Rounded avatar">
     <a href="/tweets-form" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Post New collection</a>
    


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">

                @foreach ($tweets as $tweet)
                
                    <x-tweet-card :tweet=$tweet/>
                    <!-- ぼやき表示用のカード 開始 -->
                    
                    
                     <!-- ぼやき表示用カード終了 -->
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
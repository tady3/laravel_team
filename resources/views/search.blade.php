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
    
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                @if($nt === 0)
                    <p>検索結果がありませんでした</p>
                @else
                    <p>{{ $nt }} 件の結果が見つかりました</p>
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
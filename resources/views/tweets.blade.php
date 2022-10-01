<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">

                <x-tweet-form :tags=$tags/> {{-- 追記 --}}

                @foreach ($tweets as $tweet)
                
                    <x-tweet-card :tweet=$tweet/>
                    <!-- ぼやき表示用のカード 開始 -->
                    
                    
                     <!-- ぼやき表示用カード終了 -->
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

@foreach ($tweet->comments()->orderBy('id', 'desc')->get() as $comment)
  <div class="mb-2">      
    

    <div class="flex items-center">
        <div class="text-sm">
          @if(isset($user->img))
          <span><img class="w-10 h-10 rounded-full" src="{{ '/storage/' . $comment->user->img}}" alt="Rounded avatar"></span>
          @else <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8" style="color::#252f5a">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          @endif
          <span class="text-gray-900 leading-none">{{ $comment->user->nickname }}</span>


          @if($comment->user->id == auth()->user()->id)
          <div class="w-60 mb-4 bg-blue-100 text-black-800 text-s mr-2 px-3.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
            <span class="text-gray-700 text-base ">{{ $comment->comment }}</span>                   
            <p class="text-gray-600"> :{{ $comment->created_at }}</p>
          </div>
          @else
          <div class="w-60 mb-4 bg-red-100 text-black-800 text-s mr-2 px-3.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
            <span class="text-gray-700 text-base ">{{ $comment->comment }}</span>                   
            <p class="text-gray-600"> :{{ $comment->created_at }}</p>
          </div>

          @endif

            
          {{-- コメント削除 --}}
            @if ($comment->user->id == auth()->user()->id)
                <a class=" delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}">
                    <svg class=" -mt-5 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" data-tooltip-target="tooltip-default2"></path></svg>
                    <div id="tooltip-default2" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                  コメント削除
                      <div class="tooltip-arrow" data-popper-arrow>
                      </div>
                    </div>
                </a>
            @endif
      {{-- コメント削除了 --}}
          
        </div>
        <hr class="my-6 h-px bg-black-200  border-5 dark:bg-black-700">
    </div>
  </div>
@endforeach

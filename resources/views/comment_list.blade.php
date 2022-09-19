
@foreach ($tweet->comments()->orderBy('id', 'desc')->get() as $comment)
  <div class="mb-2">      
          <div class="mb-4 ">
            <p class="text-gray-700 text-base ">{{ $comment->comment }}</p>
          </div>

          <div class="flex items-center">
                <img class="w-10 h-10 rounded-full" src="{{ '/storage/' . Auth::user()->img}}" alt="Rounded avatar">
                
                <div class="text-sm">
                    <p class="text-gray-900 leading-none">　{{ $comment->user->nickname }}</p>
                    <p class="text-gray-600">　:{{ $comment->created_at }}</p>
                </div>
                
                @if ($comment->user->id == auth()->user()->id)
                <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" data-tooltip-target="tooltip-default2"></path></svg>
                    <div id="tooltip-default2" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                    delete-comment
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </a>
        @endif
          </div>
          <hr class="my-6 h-px bg-black-200  border-5 dark:bg-black-700">


  </div>
@endforeach

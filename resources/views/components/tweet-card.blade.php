@props(["tweet"])

<div style="">
  <div class="card card-body shadow-2 mb-2">
    <div class="d-flex justify-content-between">
        <p>
            <a href="/profile/{{ $tweet->user->id }}">
                <span><img class="w-10 h-10 rounded-full" src="{{ '/storage/' . $tweet->user->img}}" alt="Rounded avatar"></span>
                <span class="font-weight-bold mr-2">{{$tweet->user->nickname  }}</span>
            </a>
            <span style="font-size: 0.8rem;">{{ $tweet->created_at }}</span>
        </p>
        <div class="d-flex" style="z-index:2">
            
            @can('update', $tweet)
            <a href="/tweets/{{$tweet->id}}/edit"  class="btn btn-floating shadow-0" >
                <i class="fas fa-edit fa-lg"></i>
            </a>
            @endcan

            @can('update', $tweet)
            <form action="/tweets/{{$tweet->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-floating shadow-0">
                    <i class="fas fa-trash fa-lg"></i>
                </button>
            </form>
            @endcan

        </div>
    </div>
    
    <img id="showImage" class="max-w-xs w-60 items-center border" src="{{'/storage/'. $tweet['img']}}" alt=""> 
    
    <p class="font-weight-bold" style="font-size: 1.4rem;"></p>

    <p class="font-weight-bold" style="font-size: 1.4rem; color: #953037;">
        <a href="{{ $tweet->url}}" style="text-decoration:underline;">
            @if($tweet->card_type_id === 1)
            👤 "{{ $tweet->message }}"
            @else🍽 {{ $tweet->message }}
            @endif
        </a>
        @if($tweet->published === 1)
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                公開</span>
        @else
            <span>
            </span>
        @endif
        <br/>
    </p>




    <p class="font-weight-bold" style="font-size: 0.8rem; color:blue">★ {{ $tweet->rate}}</p> 
    {{-- card_like部分 --}}
    <div>
        @if($tweet->is_liked_by_auth_user())
          <a href="{{ route('tweet.unlike', ['id' => $tweet->id]) }}" class="btn btn-success btn-sm" style="background-color: #ce3126;" data-tooltip-target="tooltip-default" >わかる！<span class="badge">{{ $tweet->card_likes->count() }}</span></a>
        @else
          <a href="{{ route('tweet.like', ['id' => $tweet->id]) }}" class="btn btn-secondary btn-sm " style="background-color: #252f5a" data-tooltip-target="tooltip-default" >わかる！<span class="badge">{{ $tweet->card_likes->count() }}</span></a>
        @endif
      </div>

      <div id="tooltip-default" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">       
        {{-- @foreach ($tweet->card_likes as $card_like)
            @if ($tweet->id == $card_like->tweet_id) {{ $card_like->user->nickname }} --}}
            <div class="tooltip-arrow" data-popper-arrow></div>
            {{-- @endif
        @endforeach --}}
    </div>


    <p class="card-text">
        #{{ $tweet->source }}
        　#@if($tweet->card_type_id==1){{ $tweet->bywho}}@else{{ $tweet->location}}@endif
        @if($tweet->card_type_id==2)　#{{ $tweet->withwho}}@else @endif
        　#{{ $tweet->when}}


        
        
        <br/>
    </p>

                
     {{-- tags 追記 --}}
     @if($tweet->card_type_id == 1)
     <div>
        @foreach($tweet->tags as $tag)
            <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
        @endforeach
    </div>
    {{-- tags 追記完了 --}}
    @else 
    <div class="form-outline mb-2">
        <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox"  name="category" value="内食" />
                <label class="form-check-label" for="tag-checkbox2">手作り</label>
        </div>
                <input class="form-check-input" type="checkbox"  name="category" value="外食" />          
                <label class="form-check-label" for="tag-checkbox2">外食</label>
                <input class="form-check-input" type="checkbox"  name="category" value="旅先" />
                <label class="form-check-label" for="tag-checkbox2">旅先</label>
                <input class="form-check-input" type="checkbox"  name="category" value="ラップアップ" />
                <label class="form-check-label" for="tag-checkbox2">ラップアップ</label>
                <input class="form-check-input" type="checkbox"  name="category" value="記念日" />
                <label class="form-check-label" for="tag-checkbox2">記念日</label>
      </div>
    @endif

    
    <p class="font-weight-bold" style="font-size: 1.2rem;"></p>

    <div class="bg-blue-100 text-black-800 text-s font-semibold mr-2 px-3.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800" >

        {{ $tweet->story}}
        </div>
    


    <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>

    <div><h1 class="font-weight-bold" style="font-size: 1.4rem;">Comments</h1>

        <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>


        <div id="comment-tweet-{{ $tweet->id }}">
          @include('comment_list')
      </div>

      <div class="row actions" id="comment-form-tweet-{{ $tweet->id }}">
          <form class="w-100" id="new_comment" action="/tweets-index/{user}/{tweet_id}/comments" accept-charset="UTF-8" data-remote="true" method="post">
              @csrf
              <input value="{{ $tweet->id }}" type="hidden" name="tweet_id" />
              <input value="{{ auth()->user()->id}}" type="hidden" name="user_id" />
              <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="on" type="text" name="comment" />
          </form>
      </div>
    </div>





</div>
</div>

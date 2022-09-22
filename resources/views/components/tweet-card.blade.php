@props(["tweet"])

<div>
  <div class="card card-body shadow-2 mb-2">
    <div class="d-flex justify-content-between">
        <p>
            <span class="font-weight-bold mr-2">{{$tweet->user->nickname  }}</span>
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
    <p class="font-weight-bold" style="font-size: 1.4rem;">
        <a href="{{ $tweet->url}}">{{ $tweet->message }}</a><br/>
    </p>

{{-- card_like部分 --}}
    <div>
        @if($tweet->is_liked_by_auth_user())
          <a href="{{ route('tweet.unlike', ['id' => $tweet->id]) }}" class="btn btn-success btn-sm" data-tooltip-target="tooltip-default" >わかる！<span class="badge">{{ $tweet->card_likes->count() }}</span></a>
        @else
          <a href="{{ route('tweet.like', ['id' => $tweet->id]) }}" class="btn btn-secondary btn-sm"  >わかる！<span class="badge">{{ $tweet->card_likes->count() }}</span></a>
        @endif
      </div>
      <div id="tooltip-default" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        ここにLikeをしたユーザー名の一覧を表示させたい
        {{-- @foreach ($tweet->card_likes as $card_like)
                {{ $card_like->user->nickname }}
        @endforeach --}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>




    <p class="font-weight-bold" style="font-size: 0.8rem; color:blue">★ {{ $tweet->rate}}</p> 

    <img id="showImage" class="max-w-xs w-32 items-center border" src="{{'/storage/'. $tweet['img']}}" alt=""> 

    <p class="card-text">
        #{{ $tweet->bywho}}　#{{ $tweet->source }}　#{{ $tweet->when}}<br/>
    </p>

                
     {{-- tags 追記 --}}
     <div>
        @foreach($tweet->tags as $tag)
            <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
        @endforeach
    </div>
    {{-- tags 追記完了 --}}
    

    <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>
 
    <div style="background-color: #CFF3FE;">
        {{ $tweet->story}}
        </div>
    


    <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>

    <div><h1 class="font-weight-bold" style="font-size: 1.4rem;">Comment</h1>

        <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>


        <div id="comment-tweet-{{ $tweet->id }}">
          @include('comment_list')
      </div>

      <div class="row actions" id="comment-form-tweet-{{ $tweet->id }}">
          <form class="w-100" id="new_comment" action="tweets-index/{tweet_id}/comments" accept-charset="UTF-8" data-remote="true" method="post">
              @csrf
              <input value="{{ $tweet->id }}" type="hidden" name="tweet_id" />
              <input value="{{ auth()->user()->id}}" type="hidden" name="user_id" />
              <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="on" type="text" name="comment" />
          </form>
      </div>
      </div>





</div>
</div>

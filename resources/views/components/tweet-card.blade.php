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
                {{ csrf_field() }}
                @method('DELETE')
                <button type="submit" name="delete" class="btn btn-floating shadow-0" onClick="delete_alert(event); return false;">
                    <i class="fas fa-trash fa-lg"></i>
                </button>
            </form>
            @endcan



        </div>
    </div>
    
    
    <p class="mt-3 font-weight-bold" style="">
        <a href="{{ $tweet->url}}" style="font-size: 1.4rem; color: #953037; text-decoration:underline;">
            @if($tweet->card_type_id === 1)
            👤 "{{ $tweet->message }}"
            @elseif($tweet->card_type_id === 2)🍽 {{ $tweet->message }}
            @else📀{{ $tweet->message }}
            @endif
        </a>

        @if($tweet->published === 1)
        　<span class="badge badge-pill badge-danger text-dark">公開</span>
        @else
            <span>
            </span>
        @endif
    </p>
    
    <div class="">
        @if(isset($tweet->img)) 
    <img id="showImage" class="max-w-xs w-60 items-center border" src="{{'/storage/'. $tweet['img']}}" alt=""> 
        @else
        @endif

    @php 
        //OGPを取得したいURL
        if(isset($tweet->url))
        {
        $url = ($tweet->url);

        //Webページの読み込みと文字コード変換
        $html = file_get_contents($url);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
        //DOMDocumentとDOMXpathの作成
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        //XPathでmetaタグのog:titleおよびog:imageを取得
        $node_title = $xpath->query('//meta[@property="og:title"]/@content');
        $node_image = $xpath->query('//meta[@property="og:image"]/@content');
        if ($node_title->length > 0 && $node_image->length > 0) 
        {
            //タグが存在すればサムネイルとタイトルを表示してリンクする
            $title = $node_title->item(0)->nodeValue;
            $image = $node_image->item(0)->nodeValue;

            echo '<a href="'.$url.'">';
            echo '<img class="max-w-xs w-60 items-center border" src="'.$image.'">';
            echo $title;
            echo '</a>';
        }
    };
    @endphp
    </div>



    <p class="mt-1 font-weight-bold" style="font-size: 0.8rem; color:blue">ジブン度★ {{ $tweet->rate}}</p> 
    {{-- card_like部分 --}}
    <div class="mt-1">
        @if($tweet->is_liked_by_auth_user())
          <a href="{{ route('tweet.unlike', ['id' => $tweet->id]) }}" class="btn btn-success btn-sm" style="background-color: #ec7682;" data-tooltip-target="tooltip-default" >わかる！<span class="badge">{{ $tweet->card_likes->count() }}</span></a>
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


    <div class="mt-2 card-text">
        <span class="badge badge-pill badge-primary text-red">{{ $tweet->source }}</span>
        
        <span class="badge badge-pill badge-primary text-red">
        @if($tweet->card_type_id==1 || $tweet->card_type_id==3){{ $tweet->bywho}}@elseif($tweet->card_type_id==2) {{ $tweet->location}}@endif
        </span>
        @if($tweet->card_type_id==2)<span class="badge badge-pill badge-primary text-red">{{ $tweet->withwho}}</span>@else @endif
        <span class="badge badge-pill badge-primary text-red">{{ $tweet->when}}</span>
        　
        <br/>
    </div>

                
     {{-- tags 追記 --}}
     <div>
        @foreach($tweet->tags as $tag)
            <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
        @endforeach
    </div>
    {{-- tags 追記完了 --}}

    <div class="mt-2 card-text">
        @php
        if(!empty($tweet->impact))
            {
            $impacts=explode(",", $tweet->impact);
        
            }
        else{
            $impact=("");
        }
        @endphp
        @if(!empty($tweet->impact))
           @foreach( $impacts as $impact )
           <span class="badge badge-pill badge-primary">{{$impact}}</span>
           @endforeach
        @else
        <span class="badge badge-pill badge-primary">{{$impact}}</span>
        @endif
        </span>
    </div>

    
    <p class="font-weight-bold" style="font-size: 1.2rem;"></p>

    <div class="mt-2 bg-blue-100 text-black-800 text-s font-semibold mr-2 px-3.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800" >

        {{ $tweet->story}}
        </div>
    

    <div class="mt-2">

        <div class="row actions" id="comment-form-tweet-{{ $tweet->id }}">
            <form class="w-100" id="new_comment" action="/tweets-index/{user}/{tweet_id}/comments" accept-charset="UTF-8" data-remote="true" method="post">
                @csrf
                <input value="{{ $tweet->id }}" type="hidden" name="tweet_id" />
                <input value="{{ auth()->user()->id}}" type="hidden" name="user_id" />
                <input class="form-control comment-input border-1" placeholder="コメント ..." autocomplete="on" type="text" name="comment" />
            </form>
        </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed font-weight-bold"
              type="button" data-mdb-toggle="collapse" data-mdb-target="#flush-collapseOne-{{ $tweet->id }}"
              aria-expanded="false"aria-controls="flush-collapseOne-{{ $tweet->id }}" style="font-size: 1.2rem;">
              コメントを表示 ({{ $tweet->comments->count() }})
            </button>
          </h2>
          
          <div id="flush-collapseOne-{{ $tweet->id }}" class="accordion-collapse collapse"
            aria-labelledby="flush-headingOne" data-mdb-parent="#accordionFlushExample">
            <div class="accordion-body">

                <div class="mt-3" id="comment-tweet-{{ $tweet->id }}">
                    @include('comment_list')
                </div>
              


            </div>
          </div>
        </div>

      </div>






      
    </div>





</div>
</div>

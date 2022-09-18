
@foreach ($tweet->comments as $comment)
  <div class="mb-2">
        <span>
            {{-- <strong>
                <a class="no-text-decoration black-color" href="{{ route('users.show', ['nickname' => $comment->user->nickname]) }}">{{ $comment->user->nickname }}</a>
            </strong> --}}
            {{ $comment->user->nickname }}
        </span>
        <span>{{ $comment->comment }}</span>
        @if ($comment->user->id == auth()->user()->id)
            <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </a>
        @endif
  </div>
@endforeach

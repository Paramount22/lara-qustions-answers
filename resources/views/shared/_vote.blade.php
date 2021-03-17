@if( $model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp

    @elseif( $model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

<div class="d-flex flex-column vote-controls pr-4">
    <a href="" title="This {{ $name }} is useful"
       class="vote-up {{ auth()->guest() ? 'off' : '' }}"
       onclick="event.preventDefault();
           document.getElementById('up-votes-{{$name}}-{{$model->id}}').submit()"
    >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form action="/{{ $firstURISegment }}/{{$model->id}}/vote"
          id="up-votes-{{$name}}-{{$model->id}}" method="post" class="accept-form">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count"> {{$model->votes_count}} </span>

    <a href="" title="This {{$name}} is not useful"
       class="vote-down {{ auth()->guest() ? 'off' : '' }}"
       onclick="event.preventDefault();
           document.getElementById('down-votes-{{$name}}-{{$model->id}}').submit()"
    >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="/{{$firstURISegment}}/{{$model->id}}/vote"
          id="down-votes-{{$name}}-{{$model->id}}" method="post" class="accept-form">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if( $model instanceof App\Question)
        @include('shared._favorite', [
            'model' => $model
        ])
    @elseif( $model instanceof App\Answer )
        @include('shared._accept', [
        'model' => $model
        ])
     @endif
</div>

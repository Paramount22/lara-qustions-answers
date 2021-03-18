<div class="media mb-2 post">
    <div class="d-flex flex-column counters">
        <div class="vote mb-2">
            <strong>{{$question->votes_count}}</strong>
            {{Str::plural('vote', $question->votes_count)}}
        </div>

        <div class="status answered {{$question->status}} mb-2">
            <strong>{{$question->answers_count}}</strong>
            {{Str::plural('answer', $question->answers_count)}}
        </div>

        <div class="view">
            {{$question->views . " " . Str::plural('view', $question->views)}}
        </div>
    </div>

    <div class="media-body">
        <div class="d-flex align-items-center">
            <h4 class="mt-0">
                <a href="{{route('questions.show', $question->slug)}}">
                    {{$question->title}}
                </a>
            </h4>


            <div class="ml-auto">
                @can('update', $question)
                    <a href="{{route('questions.edit', $question->slug)}}" class="btn
                                                    btn-outline-info btn-sm">Edit</a>
                @endcan

                @can('delete', $question)
                    <form class="d-inline" action="{{route('questions.destroy',
                                                    $question->slug)}}"
                          method="post" >
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Are you sure?')"
                        >
                            Delete
                        </button>
                    </form>
                @endcan
            </div>

        </div>

        <p class="lead">
            Asked by:
            <a href="{{$question->user->url}}">
                {{$question->user->name}}
            </a>
            <time datetime="{{ $question->created_at->toW3cString() }}" class="text-muted">
                <small>
                    {{ $question->created_at->diffForHumans() }}
                </small>
            </time>
        </p>
        <div class="excerpt">
            {{ $question->excerpt }}
        </div>

    </div>
</div>

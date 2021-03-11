<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-4">
            <div class="card-body">
                <div class="card-title">
                    <h2>
                        {{ $question->answers_count . " " . Str::plural('Answer', $question->answers_count)}}
                    </h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($question->answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls pr-4">
                            <a href="" title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">54</span>

                            <a href="" title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (Click again to undo)"
                               class="mt-2 vote-accepted favorited" href="">
                                <i class="fas fa-check fa-2x"></i>

                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body !!}
                            <time datetime="{{ $answer->created_at->toW3cString() }}"
                                  class="text-muted float-right d-block mt-5 time">
                                <small>
                                    Answered    {{ $answer->created_at->diffForHumans() }}
                                </small>
                            </time>

                            <div class="media mt-4">
                                <a href="" class="pr-2">
                                    <img src="{{$answer->user->avatar}}" alt="">
                                </a>
                                <div class="media-body pt-1">
                                    <a href="">{{$answer->user->name}}</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex align-items-center">
                        <h2>{{$question->title}}</h2>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}"
                               class="btn btn-outline-success">Back</a>
                        </div>
                    </div>
                </div>
                <hr>
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
                           class="mt-2 favorite {{ auth()->guest() ? 'off' :
                           ($question->is_favorited ? 'favorited' : '')
                           }}"
                           onclick="event.preventDefault();
                               document.getElementById('favorite-question-{{$question->id}}').submit()"
                        >
                            <i class="fas fa-star fa-2x"></i>
                            <span class="favorites-count d-block"> {{$question->favorites_count}} </span>
                        </a>
                        <form action="/questions/{{$question->id}}/favorites"
                              id="favorite-question-{{$question->id}}" method="post" class="accept-form">
                            @csrf
                            @if($question->is_favorited)
                                @method('delete')
                            @endif
                        </form>
                    </div>
                    <div class="media-body">
                        {!! $question->body_html !!}
                        <time datetime="{{ $question->created_at->toW3cString() }}"
                              class="text-muted float-right d-block time">
                            <small>
                                {{ $question->created_at->diffForHumans() }}
                            </small>
                        </time>

                        <div class="media">
                            <a href="" class="pr-2">
                                <img src="{{$question->user->avatar}}" alt="">
                            </a>
                            <div class="media-body pt-1">
                                <a href="">{{$question->user->name}}</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

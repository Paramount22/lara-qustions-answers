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
                        <a href="" title="This question is useful"
                           class="vote-up {{ auth()->guest() ? 'off' : '' }}"
                           onclick="event.preventDefault();
                               document.getElementById('up-votes-question-{{$question->id}}').submit()"
                        >
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <form action="/questions/{{$question->id}}/vote"
                              id="up-votes-question-{{$question->id}}" method="post" class="accept-form">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>
                        <span class="votes-count"> {{$question->votes_count}} </span>

                        <a href="" title="This question is not useful"
                           class="vote-down {{ auth()->guest() ? 'off' : '' }}"
                           onclick="event.preventDefault();
                               document.getElementById('down-votes-question-{{$question->id}}').submit()"
                        >
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <form action="/questions/{{$question->id}}/vote"
                              id="down-votes-question-{{$question->id}}" method="post" class="accept-form">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>
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
                        @include('shared._author', [
                          'model' => $question,
                           'label' => 'Asked'
                            ])

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

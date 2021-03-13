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

                            @can('accept', $answer)
                            <a data-toggle="tooltip" data-placement="top" title="Mark this answer as best answer"
                               class="mt-2 {{ $answer->status  }}" href=""
                               onclick="event.preventDefault();
                               document.getElementById('accept-answer-{{$answer->id}}').submit()"
                            >  <i class="fas fa-check fa-2x"></i>
                            </a>

                            <form action="{{route('answers.accept', $answer->id)}}"
                                  id="accept-answer-{{$answer->id}}" method="post" class="accept-form"
                            >
                                @csrf
                            </form>
                                @else
                                    @if($answer->is_best)
                                        <a data-toggle="tooltip" data-placement="top"
                                           title="The question owner accepted this answer as best answer"
                                           class="mt-2 {{ $answer->status  }}"
                                        >  <i class="fas fa-check fa-2x"></i>
                                        </a>
                                    @endif
                            @endcan
                        </div>

                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <div class="media mt-4">
                                        <a href="" class="pr-2">
                                            <img src="{{$answer->user->avatar}}" alt="">
                                        </a>
                                        <div class="media-body pt-1">
                                            <a href="">{{$answer->user->name}}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <time datetime="{{ $answer->created_at->toW3cString() }}"
                                          class="text-muted d-block mt-4 time">
                                        <small>
                                            Answered    {{ $answer->created_at->diffForHumans() }}
                                        </small>
                                    </time>
                                </div>

                                <div class="col-md-3 d-flex justify-content-end align-items-center">
                                    <div class="d-flex">
                                        @can('update', $answer)
                                        <a href="{{route('questions.answers.edit',
                                            [$question->id, $answer->id])}}"
                                           class="btn btn-outline-info btn-sm mr-2">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                         @endcan
                                        @can('delete', $answer)
                                        <form class="d-inline" action="{{route('questions.answers.destroy',
                                                    [$question->id, $answer->id])}}"
                                              method="post" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit"  class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure?')"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
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

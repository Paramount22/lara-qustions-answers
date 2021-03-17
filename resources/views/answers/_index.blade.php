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
                        @include('shared._vote', [
                       'model' => $answer
                   ])

                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row mt-2">
                                @include('shared._author', [
                                    'model' => $answer,
                                    'label' => 'Answered'
                                ])

                                <div class="col-md-3 d-flex justify-content-end align-items-center">
                                    <div class="d-flex">
                                        @can('update', $answer)
                                        <a href="{{route('questions.answers.edit',
                                            [$question->id, $answer->id])}}"
                                           class="btn btn-outline-info btn-sm mr-2 edit">
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

@if($question->answers_count > 0 )
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
                        @include('answers._answer')

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif



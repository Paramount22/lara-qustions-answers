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
                    @include('shared._vote', [
                        'model' => $question
                    ])
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

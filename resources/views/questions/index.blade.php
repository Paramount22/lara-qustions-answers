@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">All questions</div>

                    <div class="card-body">
                        @foreach($questions as $question)
                            <div class="media mb-2">
                                <div class="media-body">
                                    <h3 class="mt-0">
                                        <a href="{{route('questions.show', $question)}}">
                                            {{$question->title}}
                                        </a>
                                    </h3>
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
                                    {{Str::limit($question->body, 250)}}
                                </div>
                            </div>
                            <hr>
                        @endforeach

                            {{ $questions->links()  }}

                    </div>
                </div>
            </div>

        </div>




    </div>

@endsection


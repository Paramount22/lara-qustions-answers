@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h2>All questions</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.create')}}"
                                   class="btn btn-outline-success">Ask question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @include('layouts._messages')
                        @foreach($questions as $question)
                            <div class="media mb-2">
                                <div class="d-flex flex-column counters">
                                    <div class="vote mb-2">
                                        <strong>{{$question->votes}}</strong>
                                        {{Str::plural('vote', $question->votes)}}
                                    </div>

                                    <div class="status answered {{$question->status}} mb-2">
                                        <strong>{{$question->answers}}</strong>
                                        {{Str::plural('answer', $question->answers)}}
                                    </div>

                                    <div class="view">
                                        {{$question->views . " " . Str::plural('view', $question->views)}}
                                    </div>
                                </div>

                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0">
                                            <a href="{{route('questions.show', $question)}}">
                                                {{$question->title}}
                                            </a>
                                        </h3>
                                        <div class="ml-auto">
                                            <a href="{{route('questions.edit', $question->id)}}" class="btn
                                            btn-outline-info btn-sm">Edit</a>
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


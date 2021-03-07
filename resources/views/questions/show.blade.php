@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>{{$question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}"
                                   class="btn btn-outline-success">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! $question->body_html !!}

                        <div class="d-flex justify-content-between">
                            <a href="" class="btn-link">{{ $question->user->name  }}</a>
                            <time datetime="{{ $question->created_at->toW3cString() }}" class="text-muted">
                                <small>
                                    {{ $question->created_at->diffForHumans() }}
                                </small>
                            </time>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

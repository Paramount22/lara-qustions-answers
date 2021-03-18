@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h2>All questions</h2>
                            @if(auth()->user())
                            <div class="ml-auto">
                                <a href="{{route('questions.create')}}"
                                   class="btn btn-outline-success">Ask question</a>
                            </div>
                            @endif
                        </div>

                    </div>

                    <div class="card-body">
                        @include('layouts._messages')
                        @forelse($questions as $question)
                            @include('questions._excerpt')

                        @empty
                            <div class="alert alert-info" role="alert">
                                No questions yet
                            </div>
                        @endforelse

                    </div>
                    {{ $questions->links()  }}
                </div>
            </div>
        </div>
    </div>

@endsection


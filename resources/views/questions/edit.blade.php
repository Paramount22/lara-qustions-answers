@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Edit questions</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}"
                                   class="btn btn-outline-success">Back</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.update', $question->id)}}" method="post">
                            @method('put')
                            @include('questions._form', ['buttonText' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

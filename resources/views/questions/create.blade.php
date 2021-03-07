@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask questions</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}"
                                   class="btn btn-outline-success">Back</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="question-title">Question title</label>
                                    <input type="text" name="title" id="question-title" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="question-body">Ask your question</label>
                                <textarea name="body" id="question-body" rows="5"
                                          class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection



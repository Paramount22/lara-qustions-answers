@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex justify-content-sm-between align-items-center">
                            <h3>Edit Answer</h3>
                            <a class="btn btn-sm btn-outline-success" href=" {{ url()->previous() }} ">Back</a>
                        </div>

                    </div>
                    <hr>
                    <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}"
                          method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="body"></label>
                            <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : '' }} "
                                      name="body" id="body" rows="7">
                                {{old('body', $answer->body)}}
                        </textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('body')}}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @endsection

<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{route('questions.answers.store', $question->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="body"></label>
                        <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : '' }} "
                                  name="body" id="body" rows="7">
                        </textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('body')}}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

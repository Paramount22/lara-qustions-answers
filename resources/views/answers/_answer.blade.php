<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
      {{--   @include('shared._vote', [
       'model' => $answer
    ]) --}}
        <vote :model="{{$answer}}" name="answer"></vote>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <label for="">Edit</label>
                    <textarea name="" id="" v-model="body" class="form-control" required
                              rows="5"></textarea>
                </div>
                <button class="btn btn-outline-success" :disabled="isInvalid">Update
                </button>
                <button @click="cancel" type="button" class="btn
                btn-outline-secondary">Cancel</button>
            </form>
            <div v-if="!editing">
                <div v-html="bodyHtml"></div>
              {{--  {!! $answer->body_html !!} -}}
                <div class="row mt-2">
                    {{--   @include('shared._author', [
                          'model' => $answer,
                          'label' => 'Answered'
                      ]) --}}
                    <user-info :model="{{ $answer }}" label="Answered"></user-info>

                    <div class="col-md-3 d-flex justify-content-end align-items-center">
                        <div class="d-flex">
                            @can('update', $answer)
                                <a href="" @click.prevent="edit"
                                   class="btn btn-outline-info btn-sm mr-2 edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endcan
                            @can('delete', $answer)
                                    <button class="btn btn-outline-danger btn-sm"
                                            @click="destroy"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                               {{-- <form class="d-inline" action="{{route('questions.answers.destroy',
                                                    [$question->id, $answer->id])}}"
                                      method="post" >
                                    @csrf
                                    @method('delete')
                                </form> --}}
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
</answer>

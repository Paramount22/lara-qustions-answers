   <a title="Click to mark as favorite question (Click again to undo)"
           class="mt-2 favorite {{ auth()->guest() ? 'off' :
                                   ($model->is_favorited ? 'favorited' : '')
                                   }}"
           onclick="event.preventDefault();
               document.getElementById('favorite-question-{{$model->id}}').submit()"
        >
            <i class="fas fa-star fa-2x"></i>
            <span class="favorites-count d-block"> {{$model->favorites_count}} </span>
        </a>
        <form action="/questions/{{$model->id}}/favorites"
              id="favorite-question-{{$model->id}}" method="post" class="accept-form">
            @csrf
            @if($model->is_favorited)
                @method('delete')
            @endif
        </form>

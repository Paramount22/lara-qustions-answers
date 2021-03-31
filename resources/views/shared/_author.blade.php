<div class="col-md-4">
    <div class="media mt-4 d-flex">
        <a href="" class="pr-2">
            <img src="{{$model->user->avatar}}" alt="">
        </a>
        <div class="media-body pt-1">
            <a href="">{{$model->user->name}}</a>
        </div>
    </div>
</div>

<div class="col-md-5">
    <time datetime="{{ $model->created_date_for_pc }}"
          class="text-muted d-block mt-4 time">
        <small>
            {{ $label . " " . $model->created_date }}
        </small>
    </time>
</div>

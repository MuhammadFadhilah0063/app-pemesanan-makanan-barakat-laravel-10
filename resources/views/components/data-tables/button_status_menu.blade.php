@if ($model->ready == 1)
<button class="font-weight-bolder btn btn-success" style="width: 70px" id="btn-ready" data-id="{{ $model->food_id }}"
    data-ready="{{ $model->ready }}">
    Ada
</button>
@else
<button class="font-weight-bolder btn btn-danger" style="width: 70px" id="btn-ready" data-id="{{ $model->food_id }}"
    data-ready="{{ $model->ready }}">
    Habis
</button>
@endif
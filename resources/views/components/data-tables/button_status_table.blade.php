@if ($model->ready == 1)
<button class="d-inline p-2 btn-success text-white font-weight-bolder btn btn-sm mr-xl-1 mb-1" style="width: 110px"
    id="btn-ready" data-id="{{ $model->id }}" data-ready="{{ $model->ready }}">
    Tersedia
</button>
@else
<button class="d-inline p-2 btn-danger text-white font-weight-bolder btn btn-sm mr-xl-1 mb-1" style="width: 110px"
    id="btn-ready" data-id="{{ $model->id }}" data-ready="{{ $model->ready }}">
    Tidak Tersedia
</button>
@endif
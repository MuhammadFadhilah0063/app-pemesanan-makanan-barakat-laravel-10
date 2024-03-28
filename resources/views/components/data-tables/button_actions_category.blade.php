@if ($model->slug != 'lainnya')
<button class="d-inline p-2 btn-warning text-white btn btn-sm mr-xl-1 mb-1" id="btn-edit" data-id="{{ $model->id }}">
    <i class="fas fa-pen"></i>
</button>
<button class="d-inline p-2 btn-danger text-white btn btn-sm mr-xl-1 mb-1" id="btn-delete" data-id="{{ $model->id }}">
    <i class="fas fa-trash"></i>
</button>
@else
<span>-</span>
@endif
<button class="d-inline p-1 rounded-lg btn-primary text-white btn btn-sm mr-xl-1 mb-1" id="btn-accept"
    data-id="{{ $model->reservation_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
<button class="d-inline p-1 rounded-lg btn-danger text-white btn btn-sm mr-xl-1 mb-1" id="btn-rejected"
    data-id="{{ $model->reservation_id }}">
    <i class="fas fa-times-circle fa-xs fa-2x"></i>
</button>
@if(date('Y-m-d') == $model->reservation_date)
@if($model->reservation_status == 'pending')
<button title="Terima reservasi" class="d-inline p-1 rounded-lg btn-primary text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-accept" data-id="{{ $model->reservation_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
<button title="Tolak reservasi" class="d-inline p-1 rounded-lg btn-danger text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-rejected" data-id="{{ $model->reservation_id }}">
    <i class="fas fa-times-circle fa-xs fa-2x"></i>
</button>
@elseif($model->reservation_status == 'process')
<button title="Selesaikan Reservasi" class="d-inline p-1 rounded-lg btn-success text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-finish-reservation" data-id="{{ $model->reservation_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
@endif
@endif

@if($model->online_order)
@if($model->reservation_status == 'success' && $model->online_order->payment->payment_status == 'pending')
<button title="Selesaikan Pembayaran" class="d-inline p-1 rounded-lg btn-info text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-done-payment" data-id="{{ $model->reservation_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
@endif
@endif

<button title="Detail reservasi" class="d-inline p-1 btn-warning text-white btn btn-sm mr-xl-1 mb-1 rounded-lg"
    id="btn-detail" data-id="{{ $model->reservation_id }}">
    <i class="fas fa-info-circle fa-xs fa-2x"></i>
</button>
@if($model->status == 'pending')
<button title="Terima pesanan" class="d-inline p-1 rounded-lg btn-primary text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-accept" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
<button title="Tolak pesanan" class="d-inline p-1 rounded-lg btn-danger text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-rejected" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-times-circle fa-xs fa-2x"></i>
</button>
@endif

@if($model->status == 'process' && $model->payment_method == 'cash')
<button title="Selesaikan pesanan" class="d-inline p-1 rounded-lg btn-success text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-done-cash" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
@endif

@if($model->payment)
@if($model->status == 'success' && $model->payment->payment_status == 'pending')
<button title="Selesaikan pembayaran" class="d-inline p-1 rounded-lg btn-info text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-done-payment" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
@endif
@endif

{{-- bukti pembayaran --}}
@if($model->payment)
@if($model->status == 'success' && $model->payment->payment_status == 'success')
<button title="Bukti Pembayaran" class="d-inline p-1 rounded-lg btn-warning text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-payment" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-wallet fa-xs fa-2x"></i>
</button>
@endif
@endif

<button title="Detail pesanan" class="d-inline p-1 btn-warning text-white btn btn-sm mr-xl-1 mb-1 rounded-lg"
    id="btn-detail" data-id="{{ $model->online_order_id }}">
    <i class="fas fa-info-circle fa-xs fa-2x"></i>
</button>
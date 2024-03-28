@if($model->status == 'process')
<button title="Batalkan pesanan" class="d-inline p-1 rounded-lg btn-danger text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-rejected" data-id="{{ $model->offline_order_id }}">
    <i class="fas fa-times-circle fa-xs fa-2x"></i>
</button>
@endif

{{-- Status pembayaran --}}
@if($model->status != 'failed')
@if(!$model->payment)
<button title="Tutup pesanan" class="d-inline p-1 rounded-lg btn-success text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-close-order" data-id="{{ $model->offline_order_id }}">
    <i class="fas fa-check-circle fa-xs fa-2x"></i>
</button>
@else
@if($model->payment->payment_status == 'pending')
<button title="Selesaikan pembayaran" class="d-inline p-1 rounded-lg btn-success text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-payment-accept" data-id="{{ $model->offline_order_id }}">
    <i class="fas fa-wallet fa-xs fa-2x"></i>
</button>
@endif
@endif
@endif

{{-- bukti pembayaran --}}
@if($model->payment)
@if($model->status == 'success' && $model->payment->payment_status == 'success')
<button title="Bukti Pembayaran" class="d-inline p-1 rounded-lg btn-warning text-white btn btn-sm mr-xl-1 mb-1"
    id="btn-payment" data-id="{{ $model->offline_order_id }}">
    <i class="fas fa-wallet fa-xs fa-2x"></i>
</button>
@endif
@endif

<button class="d-inline p-1 btn-warning text-white btn btn-sm mr-xl-1 mb-1 rounded-lg" id="btn-detail"
    data-id="{{ $model->offline_order_id }}">
    <i class="fas fa-info-circle fa-xs fa-2x"></i>
</button>
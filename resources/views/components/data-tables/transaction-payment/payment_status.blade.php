@if($model->online_order_id)
@if ($model->order->payment->payment_status == 'pending')
<span class="btn-warning text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Tertunda
</span>

@elseif ($model->order->payment->payment_status == 'success')
<span class="btn-success text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Berhasil
</span>

@else
<span class="btn-danger text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Gagal
</span>
@endif

@else
@if ($model->offline_order->payment->payment_status == 'pending')
<span class="btn-warning text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Tertunda
</span>

@elseif ($model->offline_order->payment->payment_status == 'success')
<span class="btn-success text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Berhasil
</span>

@else
<span class="btn-danger text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Gagal
</span>
@endif
@endif
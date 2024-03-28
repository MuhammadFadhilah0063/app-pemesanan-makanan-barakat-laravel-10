@if($model->online_order_id)
<span>{{ rupiah($model->order->total) }}</span>
@else
<span>{{ rupiah($model->offline_order->total) }}</span>
@endif
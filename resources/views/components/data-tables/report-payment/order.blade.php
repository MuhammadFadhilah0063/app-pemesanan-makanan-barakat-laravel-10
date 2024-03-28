{{-- Online --}}
@if ($model->order)
<span>{{ $model->order->online_order_id }}</span>
@else
{{-- Offline --}}
<span>{{ $model->offline_order->offline_order_id }}</span>
@endif
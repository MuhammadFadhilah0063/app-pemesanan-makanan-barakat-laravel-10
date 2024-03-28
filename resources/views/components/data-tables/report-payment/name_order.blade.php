{{-- Online --}}
@if ($model->order)
<span>{{ $model->order->name }}</span>
@else
{{-- Offline --}}
<span>{{ $model->offline_order->name }}</span>
@endif
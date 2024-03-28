{{-- online --}}
@if ($model->order)
{{ $model->order->total }}
@else
{{-- offline --}}
{{ $model->offline_order->total }}
@endif
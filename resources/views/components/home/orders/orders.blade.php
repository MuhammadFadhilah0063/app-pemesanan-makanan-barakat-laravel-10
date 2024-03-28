{{-- Items --}}
@if (count($orders) == 0)
<x-home.orders.order-items-empty />
@else
<x-home.orders.order-items :orders="$orders" />
@endif
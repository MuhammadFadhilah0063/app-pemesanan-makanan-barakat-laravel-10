@if (Str::startsWith(request()->path(), 'order/offline')|| Str::startsWith(request()->path(), 'reservation/offline'))
<x-home.navbar.offline-navbar :carts="$carts" />
@else
<x-home.navbar.online-navbar :carts="$carts" />
@endif
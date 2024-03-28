{{-- Home --}}
@if (Request::is('/'))
<x-home.hero.hero-home />

{{-- Orders --}}
@elseif (Request::is('orders'))
<x-home.hero.hero-orders />

{{-- Reservation --}}
@elseif (Request::is('reservation'))
<x-home.hero.hero-reservation />

@endif
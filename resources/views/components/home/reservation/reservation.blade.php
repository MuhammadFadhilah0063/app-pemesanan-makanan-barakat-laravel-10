@if (count($reservations) == 0)
<x-home.reservation.reservation-items-empty />
@else
<x-home.reservation.reservation-items :reservations="$reservations" />
@endif
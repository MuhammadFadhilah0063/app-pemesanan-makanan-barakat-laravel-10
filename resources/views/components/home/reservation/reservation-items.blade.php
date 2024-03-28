@foreach ($reservations as $reservation)
<div class="row mb-3 wow fadeIn">
  <div class="col">
    <div class="card bg-dark px-4 py-3 rounded-3 shadow-sm">
      <div class="row">
        <div class="col-12 col-md-9 col-lg-9 text-start my-auto d-flex">
          <span class="fw-bold text-light text-nowrap d-flex my-auto">{{ $reservation->reservation_id }}</span>

          {{-- Reservation status start --}}
          <span
            class="ms-3 fw-bold @if ($reservation->reservation_status == 'success') text-success @elseif ($reservation->reservation_status == 'pending') text-warning @elseif ($reservation->reservation_status == 'process') text-info @else text-danger @endif selesai text-uppercase">{{
            $reservation->reservation_status }}
          </span>
          {{-- Reservation status end --}}
        </div>

        {{-- Button order start --}}
        <div class="col-12 col-md-3 col-lg-3 mt-2 mt-md-0">
          @if (!($reservation->reservation_status == 'failed' || $reservation->reservation_status ==
          'success' || $reservation->online_order))
          <div class="d-grid">
            <a href="/reservation/online/order/{{ $reservation->reservation_id }}"
              class="btn btn-primary fw-bold rounded-3 shadow-sm text-nowrap">
              Pesan Makan
            </a>
          </div>
          @endif
        </div>
        {{-- Button order end --}}
      </div>

      <!-- Accordion reservation detail start -->
      <x-home.reservation.accordion-reservation-details :loop="$loop" :reservation="$reservation" />
      <!-- Accordion reservation detail end -->
    </div>
  </div>
</div>
@endforeach
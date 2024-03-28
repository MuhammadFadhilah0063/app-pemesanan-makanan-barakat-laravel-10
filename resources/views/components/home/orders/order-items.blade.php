@foreach ($orders as $order)
<div class="row mb-3 wow fadeIn">
  <div class="col">
    <div class="card bg-dark px-4 py-3 rounded-3 shadow-sm">
      <div class="row">
        <div class="col-12 col-md-5 col-lg-7 text-start my-auto d-flex">
          <span class="fw-bold text-light text-nowrap d-flex my-auto">{{ $order->online_order_id }}</span>

          {{-- Status order start --}}
          <span
            class="ms-3 fw-bold @if ($order->status == 'success') text-success @elseif ($order->status == 'pending') text-warning @elseif ($order->status == 'process') text-info @else text-danger @endif selesai text-uppercase">{{
            $order->status }}
          </span>
          {{-- Status order end --}}
        </div>

        {{-- Button Reservation Start --}}
        <div class="col-12 col-md-3 col-lg-2 mt-2 mt-md-0 mb-2 mb-md-0 px-md-0">
          <div class="d-grid">
            <button @disabled($order->status == 'failed' || $order->status == 'success' || $order->reservation)
              class="btn btn-light fw-bold
              rounded-3 shadow-sm text-nowrap btn-reservation"
              data-order-id="{{ $order->online_order_id }}">
              Reservasi
            </button>
          </div>
        </div>
        {{-- Button Reservation End --}}

        {{-- Button Payment Start --}}
        <x-home.orders.button-pay :order="$order" />
        {{-- Button Payment End --}}
      </div>

      <!-- Accordion order details start -->
      <x-home.orders.accordion-details-order :loop="$loop" :order="$order" />
      <!-- Accordion order details end -->
    </div>
  </div>
</div>
@endforeach
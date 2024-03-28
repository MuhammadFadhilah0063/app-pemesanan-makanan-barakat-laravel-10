<div class="col-12 col-md-4 col-lg-3 mb-1 mb-md-0">
  <div class="d-grid">

    {{-- Payment Virtual Start --}}
    @if ($order->payment_method == 'virtual')

    {{-- Pending Start --}}
    @if ($order->payment->payment_status == 'pending')
    <button data-snap-token="{{ $order->snap_token }}"
      class="btn btn-primary fw-bold rounded-3 shadow-sm text-nowrap btn-pay">
      Bayar Sekarang
    </button>
    {{-- Pending End --}}

    {{-- Success Start --}}
    @elseif ($order->payment->payment_status == 'success')
    <button disabled class="btn btn-success fw-bold rounded-3 shadow-sm text-nowrap">
      Sudah Bayar
    </button>
    {{-- Success End --}}

    {{-- Expired Start --}}
    @elseif ($order->payment->payment_status == 'expired')
    <button disabled class="btn btn-danger fw-bold rounded-3 shadow-sm text-nowrap">
      Kedaluwarsa
    </button>
    {{-- Expired End --}}

    {{-- Failed Start --}}
    @else
    <button disabled class="btn btn-danger fw-bold rounded-3 shadow-sm text-nowrap">
      Dibatalkan
    </button>
    @endif
    {{-- Failed End --}}
    {{-- Payment Virtual End --}}

    {{-- Payment Cash Start --}}
    @else
    {{-- Failed Start --}}
    @if ($order->status == 'failed')
    <button disabled class="btn btn-danger fw-bold rounded-3 text-nowrap">
      Dibatalkan
    </button>
    {{-- Failed End --}}

    {{-- Except Failed Start --}}
    @else
    <button disabled class="btn btn-success fw-bold rounded-3 text-nowrap">
      Bayar ditempat
    </button>
    @endif
    {{-- Except Failed End --}}
    @endif
    {{-- Payment Cash End --}}

  </div>
</div>
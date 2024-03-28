@if ($order != '')
{{-- Button bukti pembayaran start --}}
@if ($order->status == 'success' && $order->payment->payment_status == 'success')
<div class="row">
  <div class="col">
    <div class="mb-3">
      <button type="button" class="btn rounded-3 shadow-sm btn-info ms-1 btn-payment-offline"
        data-id="{{ $order->offline_order_id }}">Bukti Pembayaran</button>
    </div>
  </div>
</div>
@endif
{{-- Button bukti pembayaran end --}}

<div class="row">
  <div class="col">
    <div class="mb-3">
      <label for="name" class="form-label fw-bold">Nama</label>
      <input value="{{ $order->name }}" readonly type="text" class="form-control" id="name">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-7">
    <div class="mb-3">
      <label for="offline_order_id" class="form-label fw-bold">Nomor Pesanan</label>
      <input value="{{ $order->offline_order_id }}" readonly type="text" class="form-control" id="offline_order_id">
    </div>
  </div>
  <div class="col-12 col-sm-5">
    <div class="mb-3">
      <label for="offline_order_id" class="form-label fw-bold">Tanggal Pesanan</label>
      <input value="{{ formatDateWithTime($order->created_at) }}" readonly type="text" class="form-control">
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    @foreach ($order->order_items as $item)
    <div class="row mb-2 item-row" data-cart-id="{{ $item->id }}">
      <div class="col-12">
        <span class="fw-bold">{{ $item->food->name }}</span>
      </div>
      <div class="col-12">
        <span>{{ $item->quantity }}x {{ ribu($item->price) }}</span>
      </div>
      <div class="col-12 d-flex justify-content-between">
        <span>Subtotal </span><span class="subtotal-order">{{ rupiah(($item->quantity * $item->price)) }}</span>
      </div>
    </div>
    <hr>
    @endforeach
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="col-12 d-flex justify-content-between fw-bold">
      <span>Total </span><span class="total-order">0</span>
    </div>
  </div>
</div>
@else
<span class="fw-bold text-center d-block mt-3">Belum ada pesanan..</span>
@endif

<div class="d-flex m-auto justify-content-end mb-3 mt-4">
  {{-- order ada start --}}
  @if ($order != '')
  {{-- order process start --}}
  @if ($order->status == 'process')
  <button type="button" class="btn rounded-3 shadow-sm btn-danger ms-1 btn-order-done"
    data-order-id="{{ $order->offline_order_id }}">Tutup Pesanan</button>
  @else
  <button disabled type="button" class="btn rounded-3 shadow-sm btn-success ms-1">Pesanan selesai</button>
  {{-- payment pending start --}}
  @if ($order->payment)
  @if ($order->payment->payment_status == 'pending')
  <button type="button" class="btn rounded-3 shadow-sm btn-primary ms-1 btn-pay"
    data-snap-token="{{ $order->snap_token }}">Bayar</button>
  @elseif ($order->payment->payment_status == 'success')
  <button disabled type="button" class="btn rounded-3 shadow-sm btn-success ms-1">Sudah Bayar</button>
  @else
  <button disabled type="button" class="btn rounded-3 shadow-sm btn-danger ms-1">Gagal</button>
  @endif
  @endif
  {{-- payment pending end --}}
  @endif
  {{-- order process end --}}
  @endif
  {{-- order ada end --}}
</div>

<div id="loading2"
  class="d-none position-fixed z-9999 translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
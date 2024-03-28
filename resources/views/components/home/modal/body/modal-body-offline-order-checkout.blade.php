<form id="form-checkout">
  <div class="card">
    <div class="card-body">
      @foreach ($items as $item)
      <div class="row mb-2 item-row" data-cart-id="{{ $item->id }}">
        <div class="col-12">
          <span class="fw-bold">{{ $item->food->name }}</span>
        </div>
        <div class="col-12">
          <span>{{ $item->quantity }}x {{ ribu($item->price) }}</span>
        </div>
        <div class="col-12 d-flex justify-content-between">
          <span>Subtotal </span><span class="subtotal">{{ rupiah(($item->quantity * $item->price)) }}</span>
        </div>
      </div>
      <hr>
      @endforeach
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="col-12 d-flex justify-content-between fw-bold">
        <span>Total </span><span class="total">0</span>
      </div>
    </div>
  </div>

  <hr class="mt-4">
  @if ($order == '')
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label for="name" class="form-label fw-bold">Nama</label>
        <input required type="text" class="form-control" id="name">
      </div>
    </div>
  </div>
  @endif

  <div class="d-flex m-auto justify-content-end mb-3">
    <button type="button" class="btn rounded-2 shadow-sm btn-danger me-1" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn rounded-2 shadow-sm btn-primary ms-1">Pesan</button>
  </div>
</form>
<form id="form-checkout-order-reservation">
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
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label class="mb-2 fw-bold" for="select-method">Pembayaran</label>
        <select required id="select-method" class="form-select">
          <option value="">Pilih Pembayaran</option>
          <option value="cash">COD</option>
          <option value="virtual">Virtual</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label for="message" class="form-label fw-bold">Pesan</label>
        <textarea rows="3" class="form-control" id="message"></textarea>
      </div>
    </div>
  </div>

  <div class="d-flex m-auto justify-content-end mb-3">
    <button type="button" class="btn rounded-2 shadow-sm btn-danger me-1" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn rounded-2 shadow-sm btn-primary ms-1">Pesan</button>
  </div>
</form>
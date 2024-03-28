<form id="form_sale">
  {{-- ID --}}
  <div class="form-row">
    <div class="col mb-3">
      <label for="sale_id">Nomor Penjualan</label>
      <input type="text" class="form-control" id="sale_id" required>
    </div>
  </div>

  {{-- Total, and date --}}
  <div class="form-row">
    <div class="col-6 mb-3">
      <label for="total">Total</label>
      <input type="text" class="form-control" id="total" required>
    </div>
    <div class="col-6 mb-3">
      <label for="sale_date">Tanggal</label>
      <input type="text" class="form-control" id="sale_date" required>
    </div>
  </div>

  {{-- Item penjualan --}}
  <h6 class="mt-3 font-weight-bold">Item Penjualan</h6>
  <hr class="mt-0 mb-3 p-0">
  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="card-body pb-1 border rounded-lg" id="items"></div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <button type="submit" class="btn btn-success rounded">Simpan</button>
    </div>
  </div>
</form>
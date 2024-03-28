<form class="form-sale">

  <div class="form-row">
    <div class="col mb-3">
      <label for="sale_date">Tanggal Penjualan</label>
      <input type="date" class="form-control" id="date_sale" required>
    </div>
  </div>

  {{-- Item penjualan --}}
  <h6 class="mt-3 font-weight-bold">Item Penjualan</h6>
  <hr class="mt-0 mb-3 p-0">
  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="input-group mb-4">
        <select class="custom-select" id="selectItem">
          <option selected value="">Pilih item</option>
          @foreach ($selling as $item)
          <option value="{{ $item->selling_id }}" data-name="{{ $item->name }}">{{ $item->name }}</option>
          @endforeach
        </select>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="btn_select_item">Button</button>
        </div>
      </div>
      <div class="card-body pb-1 border rounded-lg" id="items_add"></div>
      <div class="card-footer border border-1 d-flex justify-content-between font-weight-bold">
        <span>Total</span><span id="sale_total">Rp. 0</span>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-4">SIMPAN</button>
      </div>
    </div>
  </div>
</form>
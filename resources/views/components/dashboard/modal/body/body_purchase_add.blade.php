<form class="form-purchase">
  <div class="col mb-3">
    <label for="purchase_date">Tanggal Pembelian</label>
    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
  </div>

  <div class="col mb-3">
    <div class="form-group">
      <label for="material_id">Bahan Baku</label>
      <select class="form-control" id="material_id" required>
        <option value="">Pilih bahan baku</option>
        @foreach ($material as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col mb-3">
    <label for="quantity">Jumlah</label>
    <input type="text" class="form-control" id="quantity" name="quantity" required>
  </div>
  <div class="col mb-3">
    <label for="unit_price">Harga</label>
    <input type="text" class="form-control" id="unit_price" name="unit_price" required>
  </div>
  <div class="col mb-3">
    <label for="total">Total</label>
    <input type="text" class="form-control" id="total" name="total" required>
  </div>

  <div class="col mb-3">
    <div class="form-group">
      <label for="supplier_id">Pemasok</label>
      <select class="form-control" id="supplier_id">
        <option value="">Pilih pemasok</option>
        @foreach ($supplier as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-4">SIMPAN</button>
      </div>
    </div>
  </div>
</form>
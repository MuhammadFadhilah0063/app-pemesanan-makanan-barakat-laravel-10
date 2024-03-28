<form class="form-purchase-edit">
  <div class="col mb-3">
    <label for="purchase_date">Tanggal Pembelian</label>
    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required
      value="{{ $purchase->purchase_date }}">
  </div>

  <div class="col mb-3">
    <div class="form-group">
      <label for="material_id">Bahan Baku</label>
      <select class="form-control" id="material_id" required>
        <option value="">Pilih bahan baku</option>
        @foreach ($material as $item)
        <option value="{{ $item->id }}" @selected($item->id == $purchase->raw_material_id)>{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col mb-3">
    <label for="quantity">Jumlah</label>
    <input type="text" class="form-control" id="quantity" name="quantity" required
      value="{{ ribu($purchase->quantity) }}">
  </div>
  <div class="col mb-3">
    <label for="unit_price">Harga</label>
    <input type="text" class="form-control" id="unit_price" name="unit_price" required
      value="{{ ribu($purchase->unit_price) }}">
  </div>
  <div class="col mb-3">
    <label for="total">Total</label>
    <input type="text" class="form-control" id="total" name="total" required value="{{ ribu($purchase->total) }}">
  </div>

  <div class="col mb-3">
    <div class="form-group">
      <label for="supplier_id">Pemasok</label>
      <select class="form-control" id="supplier_id">
        <option value="">Pilih pemasok</option>
        @foreach ($supplier as $item)
        <option value="{{ $item->id }}" @selected($item->id == $purchase->supplier_id)>{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <input type="hidden" name="purchase_id" value="{{ $purchase->purchase_id }}">

  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-4">UBAH</button>
      </div>
    </div>
  </div>
</form>
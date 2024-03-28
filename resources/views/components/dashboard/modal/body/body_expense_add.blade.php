<form class="form-expense">
  <div class="col mb-3">
    <label for="expense_date">Tanggal Pengeluaran</label>
    <input type="date" class="form-control" id="expense_date" name="expense_date" required>
  </div>

  <div class="col mb-3">
    <label for="total">Total</label>
    <input type="text" class="form-control" id="total" name="total" required>
  </div>

  <div class="col mb-3">
    <label for="description">Deskripsi</label>
    <textarea name="description" class="form-control" id="description_area" rows="2"></textarea>
  </div>

  {{-- Item penjualan --}}
  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-4">SIMPAN</button>
      </div>
    </div>
  </div>
</form>
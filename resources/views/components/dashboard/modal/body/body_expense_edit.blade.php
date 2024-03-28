<form class="form-expense-edit">
  <div class="col mb-3">
    <label for="expense_date">Tanggal Pengeluaran</label>
    <input type="date" class="form-control" id="expense_date" name="expense_date" required
      value="{{ $expense->expense_date }}">
  </div>

  <div class="col mb-3">
    <label for="total">Total</label>
    <input type="text" class="form-control" id="total" name="total" required value="{{ $expense->total }}">
  </div>

  <div class="col mb-3">
    <label for="description">Deskripsi</label>
    <textarea class="form-control" id="description_area" rows="2">{{ $expense->description }}</textarea>
  </div>

  <input type="hidden" id="expense_id" name="expense_id" value="{{ $expense->expense_id }}">

  <div class="form-row justify-content-center mb-3">
    <div class="col mb-3">
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-4">UBAH</button>
      </div>
    </div>
  </div>
</form>
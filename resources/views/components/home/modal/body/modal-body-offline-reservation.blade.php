<form id="form-reservation">
  @foreach ($tables as $table)
  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="check_table" id="check_table{{ $table->id }}"
      value="{{ $table->id }}">
    <label class="form-check-label" for="check_table{{ $table->id }}">
      Meja {{ $table->id }}
    </label>
    <img src="{{ $table->image }}" class="img-fluid my-2 rounded-1 shadow-sm" alt="">
  </div>
  @endforeach
  <input type="hidden" id="reservation_id" value="{{ $request->reservation_id }}">

  <div class="d-flex m-auto justify-content-end mb-3">
    <button type="submit" class="btn rounded-2 shadow-sm btn-primary ml-1">Reservasi</button>
  </div>
</form>
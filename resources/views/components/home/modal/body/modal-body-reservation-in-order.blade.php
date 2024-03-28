<form id="form-reservation" data-name="{{ $order->name }}" data-phone="{{ $order->phone }}"
  data-date="{{ $order->pick_up_date }}" data-time="{{ $order->pick_up_time }}"
  data-estimation="{{ $order->estimation_time }}" data-order-id="{{ $order->online_order_id }}">
  @foreach ($tables as $table)
  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="check_table" id="check_table{{ $table->id }}"
      value="{{ $table->id }}">
    <label class="form-check-label" for="check_table{{ $table->id }}">
      Meja {{ $table->id }}
    </label>
    <img src="{{ $table->image }}" class="img-fluid my-2 rounded-1 shadow-sm" alt="">
    <p>
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseExample{{ $table->id }}" aria-expanded="false"
        aria-controls="collapseExample{{ $table->id }}">
        Detail
      </button>
    </p>
    <div class="collapse" id="collapseExample{{ $table->id }}">
      <div class="card card-body">
        {{ $table->description }}
      </div>
    </div>
  </div>
  @endforeach

  <hr class="mt-4">

  <div class="d-flex m-auto justify-content-end mb-3">
    <button type="button" class="btn rounded-2 shadow-sm btn-danger me-1" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn rounded-2 shadow-sm btn-primary ms-1">Reservasi</button>
  </div>
</form>
<form id="form-reservation">
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
  <div class="row">
    <div class="col-12">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input readonly type="text" class="form-control" id="input_username" value="{{ $request->username }}">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-sm-7">
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input readonly type="text" class="form-control" id="input_name" value="{{ $request->name }}">
      </div>
    </div>
    <div class="col">
      <div class="mb-3">
        <label for="phone" class="form-label">No. Telp</label>
        <input readonly type="text" class="form-control" id="input_phone" value="{{ $request->phone }}">
      </div>
    </div>
  </div>

  {{-- Button --}}
  <div class="row mb-2">
    <div class="col-md-12 mb-0">
      <div class="form-check mb-0">
        <input class="form-check-input" type="checkbox" value="" id="btnChangeName">
        <label class="form-check-label" for="btnChangeName">
          Ubah nama dan nomor penerima reservasi
        </label>
      </div>
    </div>
  </div>

  {{-- Name and Phone New --}}
  <div class="row">
    <div class="d-none change col-md-7 mb-1">
      <label class="mb-1" for="recipient_name">Nama Penerima</label>
      <input type="text" class="form-control" id="recipient_name" placeholder="Nama" />
    </div>
    <div class="d-none change col-md-5 mb-1">
      <label class="mb-1" for="recipient_phone">No. Telp Penerima</label>
      <input type="text" class="form-control" id="recipient_phone" placeholder="No. Telp" />
    </div>
  </div>

  <div class="row mt-2">
    <div class="col col-md-6">
      <div class="mb-3">
        <label for="reservation_date" class="form-label">Tanggal</label>
        <input type="date" class="form-control datetimepicker-input" id="input_reservation_date"
          placeholder="Tanggal reservasi" value="{{ $request->reservation_date }}" />
      </div>
    </div>
    <div class="col col-md-6">
      <div class="mb-3">
        <label for="reservation_time" class="form-label">Jam</label>
        <input type="time" class="form-control" id="input_reservation_time" placeholder="Jam reservasi" value="{{
          $request->reservation_time }}" />
      </div>
    </div>
  </div>

  <div class="mb-3">
    <label for="selectEstimation" class="form-label">Waktu Estimasi</label>
    <select class="form-select" id="input_select_estimation">
      <option value="1" @if ($request->estimation_time == '1') selected @endif>1 Jam</option>
      <option value="2" @if ($request->estimation_time == '2') selected @endif>2 Jam</option>
      <option value="3" @if ($request->estimation_time == '3') selected @endif>3 Jam</option>
    </select>
  </div>

  <div class="d-flex m-auto justify-content-end mb-3">
    <button type="button" class="btn rounded-2 shadow-sm btn-danger me-1" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn rounded-2 shadow-sm btn-primary ms-1">Reservasi</button>
  </div>
</form>

<script>
  // Nama penerima
    $('body').on('click', '#btnChangeName', function() {
    var isChecked = $(this).is(':checked');

    if (isChecked) {
      $('.change').removeClass('d-none');
    } else {
      $('.change').addClass('d-none');
    }
  });
</script>
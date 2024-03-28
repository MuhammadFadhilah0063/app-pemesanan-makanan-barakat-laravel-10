@if ($table != '')
{{-- Hero Order --}}
<div class="container-xxl pt-1 pb-3 py-lg-5 bg-dark hero-header mb-5">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">
      <span id="table-id" data-table-id="{{ $table->id }}">Meja Nomor {{ $table->id }}</span>
    </h1>
    <h5 class="text-light animated slideInDown">
      Silahkan pilih menu dibawah!
    </h5>
    <button class="btn btn-primary mt-3 rounded-3 shadow animated slideInDown btn-my-order">Pesanan Saya</button>
  </div>
</div>
@else
{{-- Hero Reservation --}}
<div class="container-xxl pt-1 pb-3 py-lg-5 bg-dark hero-header">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">
      <span id="table-id">Reservasi</span>
    </h1>
    <h5 class="text-light animated slideInDown">
      Silahkan isi nama dibawah!
    </h5>
  </div>
</div>
@endif
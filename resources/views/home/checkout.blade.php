@extends('layouts.home', ['title' => 'Checkout'])

@section('content')
{{-- Divider --}}
<div class="container-xxl py-xl-5"></div>

{{-- Section Checkout Start --}}
<section class="container-xxl" style="margin-top: 20px">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h5 class="section-title ff-secondary text-center text-primary fw-normal mt-5">
        CheckOut
      </h5>
      <h1 class="mb-5">Pesanan Saya</h1>
    </div>

    @if (count($checkoutItems) != 0)
    <div class="row g-4 pt-2">
      {{-- Order list start --}}
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="text-center mb-3 wow fadeInUp">Daftar Pesanan</h4>
        <hr />

        <!-- Card start -->
        <div class="card p-2 shadow-sm wow fadeInUp mb-2">
          {{-- Items checkout start --}}
          @foreach ($checkoutItems as $item)
          <div class="row list-order wow fadeInUp checkout-item" data-id="{{ $item->id }}">
            {{-- Image --}}
            <div class="col-sm-5 col-md-4 wow fadeInUp d-flex m-auto justify-content-center">
              <img class="shadow-sm rounded-1 img-fluid" src="{{ $item->food->image }}" alt="" />
            </div>

            <div class="col-12 col-sm-7 col-md-8 mt-2 mt-sm-0 wow fadeInUp">
              <p class="fs-5 mb-0">{{ $item->food->name }}</p>
              <p>
                <span>{{ $item->quantity }}x </span>
                <span>{{ ribu($item->price) }}</span>
              </p>
              <div class="row d-flex">
                <div class="col">
                  <p class="fs-6 mb-1">Sub Total</p>
                </div>
                <div class="col text-end">
                  <p class="fs-6 mb-1 text-md-end pe-md-2 subtotal">{{ rupiah(($item->quantity *
                    $item->price))
                    }}</p>
                </div>
              </div>
            </div>
          </div>
          <hr />
          @endforeach
          {{-- Items checkout end --}}

          <!-- Biaya Pengantaran start -->
          <div class="d-none row biaya d-flex px-md-2 fs-6 mb-2 fw-bold">
            <div class="col">
              <span>Biaya Pengantaran</span>
            </div>
            <div class="col text-end">
              <span id="biaya">Rp. 5.000</span>
            </div>
          </div>
          <!-- Biaya Pengantaran end -->

          <!-- Total start -->
          <div class="row d-flex px-md-2 fs-6 mb-2 fw-bold">
            <div class="col">
              <span>Total</span>
            </div>
            <div class="col text-end">
              <span class="total">0</span>
            </div>
          </div>
          <!-- Total end -->
        </div>
        <!-- Card end -->
      </div>
      {{-- Order list end --}}

      <!-- Form order start -->
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="text-center mb-3 wow fadeInUp">Data Pesanan</h4>
        <hr />
        <div class="wow fadeInUp">
          <form id="form-order">
            <div class="row g-3">
              <div class="col-md-12 mb-1">
                <label class="mb-1" for="username">Username</label>
                <input readonly type="text" class="form-control" id="username" placeholder="Username"
                  value="{{ auth()->user()->username }}" />
              </div>
              <div class="col-md-7 mb-1">
                <label class="mb-1" for="name">Nama</label>
                <input readonly type="text" class="form-control" id="name" placeholder="Nama"
                  value="{{ auth()->user()->name }}" />
              </div>
              <div class="col-md-5 mb-3">
                <label class="mb-1" for="phone">No. Telp</label>
                <input readonly type="text" class="form-control" id="phone" placeholder="No. Telp"
                  value="{{ auth()->user()->phone }}" />
              </div>

              {{-- Button --}}
              <div class="col-md-12 mb-0">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" value="" id="btnChangeName">
                  <label class="form-check-label" for="btnChangeName">
                    Ubah nama dan nomor penerima
                  </label>
                </div>
              </div>

              {{-- Name and Phone New --}}
              <div class="d-none change col-md-7 mb-1">
                <label class="mb-1" for="recipient_name">Nama Penerima</label>
                <input type="text" class="form-control" id="recipient_name" placeholder="Nama Penerima" />
              </div>
              <div class="d-none change col-md-5 mb-1">
                <label class="mb-1" for="recipient_phone">No. Telp Penerima</label>
                <input type="text" class="form-control" id="recipient_phone" placeholder="No. Telp Penerima" />
              </div>

              <div class="col-12 mb-0">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="mb-2" for="pick_up_date">Tanggal</label>
                    <input required type="date" class="form-control" id="pick_up_date" placeholder="Tanggal" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="mb-2" for="select-method">Pembayaran</label>
                    <select required id="select-method" class="form-select">
                      <option value="">Pilih Pembayaran</option>
                      <option value="cash">COD</option>
                      <option value="virtual">Virtual</option>
                    </select>
                  </div>
                  <div class="mb-2 col">
                    <label class="mb-2" for="pick_up_time">Jam</label>
                    <input required type="time" class="form-control" id="pick_up_time" placeholder="Jam" />
                  </div>
                  <div class="mb-2 col">
                    <label class="mb-2" for="estimation">Estimasi</label>
                    <select required id="select-estimation" class="form-select">
                      <option value="">Pilih Jam</option>
                      <option value="1">1 Jam</option>
                      <option value="2">2 Jam</option>
                      <option value="3">3 Jam</option>
                      <option value="4">4 Jam</option>
                      <option value="5">5 Jam</option>
                    </select>
                  </div>
                </div>
              </div>

              {{-- Message --}}
              <div class="col-12 mt-0 mb-2 fst-italic fw-light d-none message">
                <small>
                  Estimasi keterlambatan pengambilan pesanan anda sampai jam <span class="fw-bold time">12.00</span>.
                  Maaf,
                  jika pesanan anda telah melewati batas waktu estimasi pengambilan yang ditentukan. Penjual tidak dapat
                  bertanggung jawab atas kesegaran dan kualitas pesanan. Mohon maaf atas ketidaknyamanan ini.
                </small>
              </div>

              {{-- Button --}}
              <div class="col-md-12 mb-0">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" value="" id="btnPengantaran">
                  <label class="form-check-label" for="btnPengantaran">
                    Pengantaran zona terdekat
                  </label>
                </div>
              </div>

              {{-- Alamat --}}
              <div class="d-none address col-12">
                <label class="mb-2" for="address">Alamat</label>
                <textarea class="form-control" placeholder="Alamat" id="address" rows="4"></textarea>
              </div>

              {{-- Message --}}
              <div class="col-12 mt-0 mb-2 fst-italic fw-light d-none address">
                <small>
                  Pengantaran hanya bisa disekitar kota Rantau saja atau radius 5 km dari warung. Untuk biaya dikenakan
                  Rp 5.000. Dan untuk pengantaran di luar radius 5 km dari warung, bisa menghubungi pemilik warung untuk
                  menghitung biaya pengantaran.
                </small>
              </div>

              <div class="col-12">
                <label class="mb-2" for="message">Pesan</label>
                <textarea class="form-control" placeholder="Pesan" id="message" rows="4"></textarea>
              </div>
              <div class="col-12 col-md-6">
                <button class="btn btn-danger w-100 py-3 fw-bold rounded-3" type="button" id="btn-cancel-order">
                  Batal
                </button>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <button class="btn btn-primary w-100 py-3 fw-bold rounded-3" type="submit" id="btn-order">
                  Pesan Sekarang
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Form order end -->
    </div>
    @endif

  </div>
</section>

<script>
  // Date
  document.getElementById('pick_up_date').valueAsDate = new Date();

  // Time
  const now = new Date();
  let hours = now.getHours();
  let minutes = now.getMinutes();

  // Menambahkan awalan 0 jika jam atau menit di bawah 10
  if (hours < 10) {
    hours = '0' + hours;
  }
  if (minutes < 10) {
    minutes = '0' + minutes;
  }

  const currentTime = hours + ':' + minutes;
  document.getElementById('pick_up_time').value = currentTime;

  // Nama penerima
  $('body').on('click', '#btnChangeName', function() {
    var isChecked = $(this).is(':checked');

    if (isChecked) {
      $('.change').removeClass('d-none');
    } else {
      $('.change').addClass('d-none');
    }
  });

  // message
  $('body').on('change', '#select-estimation, #pick_up_time', function() {
    if($('#select-estimation').val() != '') {
      var pick_up_time = $('#pick_up_time').val();
      var estimation_time = parseInt($('#select-estimation').val());

      // Memisahkan jam dan menit dari format waktu
      var timeParts = pick_up_time.split(":");
      var hours = parseInt(timeParts[0], 10);
      var minutes = parseInt(timeParts[1], 10);

      // Menambahkan angka 1 ke jam
      hours += estimation_time;

      // Mengonversi jam menjadi format dua digit
      var formattedHours = (hours < 10 ? "0" : "") + hours;

      // Mengonversi menit menjadi format dua digit
      var formattedMinutes = minutes.toString().padStart(2, "0");

      // Menggabungkan jam dan menit menjadi format waktu yang diinginkan
      var formattedTime = formattedHours + "." + formattedMinutes;

      $('.message').removeClass('d-none');
      $('.time').text(formattedTime);
    }else {
      $('.message').addClass('d-none');
    }
  });

  // address
  $('body').on('click', '#btnPengantaran', function() {
    var isChecked = $(this).is(':checked');

    if (isChecked) {
      $('.address').removeClass('d-none');
      $('#address').attr('required', 'required');
      $('.biaya').removeClass('d-none');

      // ubah total + biaya (5000)
      var total = parseInt($('.total').html().replace(/\D/g, "")) + 5000;
      $('.total').html('Rp. ' + formatRupiah(total));
    } else {
      $('.biaya').addClass('d-none');
      $('.address').addClass('d-none');
      $('#address').val("");
      $('#address').removeAttr('required');

      // ubah total - biaya (5000)
      var total = parseInt($('.total').html().replace(/\D/g, "")) - 5000;
      $('.total').html('Rp. ' + formatRupiah(total));
    }
  });

</script>
{{-- Section Checkout End --}}
@endsection
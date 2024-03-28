@extends('layouts.home', ['title' => 'Home'])

@section('content')
<!-- Divider About -->
<x-home.divider id="about" />

<!-- Section About Start -->
<section class="container-xxl">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6 text-start">
            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
              src="{{ asset('assets/img/warung3.jpg') }}" />
          </div>
          <div class="col-6 text-start">
            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
              src="{{ asset('assets/img/warung2.png') }}" style="margin-top: 25%" />
          </div>
          <div class="col-6 text-end">
            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
              src="{{ asset('assets/img/warung4.jpg') }}" />
          </div>
          <div class="col-6 text-start">
            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
              src="{{ asset('assets/img/warung.png') }}" />
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">
          Tentang Kami
        </h5>
        <h1 class="mb-4">Selamat datang di Warung Nasi Mandhi Barakat Tarim</h1>
        <p class="mb-4">
          Pemilik dari Warung Nasi Mandhi Barakat Tarim adalah H. Bajuri
          yang bertempat tinggal di Jl. Tambak Kupang, beliau merupakan lulusan
          dari Darul Musthofa Tarim Hadramaut
          Yaman.
        </p>
        <p class="mb-4">
          Warung Nasi Mandhi Barakat Tarim ini menjual makanan khas daerah Timur Tengah khususnya Kota Tarim.
        </p>
        <div class="row g-4 mb-4">
          <div class="col-sm-6">
            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
              <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">
                5
              </h1>
              <div class="ps-4">
                <p class="mb-0">Tahun</p>
                <h6 class="text-uppercase mb-0">Pengalaman</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section About End -->

<!-- Divider Menu -->
<x-home.divider id="menu" />

<!-- Section Menu Start -->
<section class="container-xxl">
  <div class="container px-lg-5">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h5 class="section-title ff-secondary text-center text-primary fw-normal">
        Menu
      </h5>
      <h2 class="mb-5">Kategori Menu</h2>
    </div>

    {{-- Tab start --}}
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
      {{-- Nav tab start --}}
      <div class="mb-4 pb-2 custom-scrollbar" style="overflow-y: scroll; max-height: 85px">
        <ul class="nav nav-pills d-inline-flex justify-content-center flex-nowrap">
          {{-- All tab start --}}
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-4 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-all">
              <i class="fa-solid fa-list-ul fa-2x text-primary"></i>
              <div class="ps-3">
                <h6 class="mt-n1 mb-0 text-capitalize">Semua</h6>
              </div>
            </a>
          </li>
          {{-- All tab end --}}

          {{-- Categories tab start --}}
          @foreach ($categories as $category)
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-4 ms-0 pb-3" data-bs-toggle="pill"
              href="#tab-{{ $category->name }}">
              <i class="{{ $category->icon }} fa-2x text-primary"></i>
              <div class="ps-3">
                <h6 class="mt-n1 mb-0 text-capitalize">{{ $category->name}}</h6>
              </div>
            </a>
          </li>
          @endforeach
          {{-- Categories tab end --}}
        </ul>
      </div>
      {{-- Nav tab end --}}

      {{-- Content tab start --}}
      <div class="tab-content">
        {{-- Tab all start --}}
        <div id="tab-all" class="tab-pane fade show p-0 active">
          <div class="row g-4 justify-content-between">
            @foreach ($food as $item)
            <div class="col-xl-6">
              <div class="row d-flex align-items-center align-items-stretch">
                <div class="col-12 col-md-5 col-lg-4 col-xl-4">
                  {{-- Image --}}
                  <img class="flex-shrink-0 img-fluid rounded-3 shadow-sm" src="{{ $item->image }}"
                    alt="Gambar makanan" />
                </div>
                <div class="col-12 col-md-7 col-lg-8 col-xl-8">
                  <div class="d-flex flex-column text-start px-1 pt-3 pt-md-0">
                    <div class="row d-flex justify-content-between">
                      <div class="col-10 pe-0">
                        <h5>{{ $item->name }}</h5>
                      </div>
                      {{-- Button add start --}}
                      @auth
                      <div class="col text-end">
                        <button class="btn btn-sm rounded-3 btn-success my-auto shadow-sm" id="btn_add_cart"
                          style="height: 30px; width: 30px" data-food-id="{{ $item->food_id }}"
                          data-user-id="{{ auth()->user()->id }}" data-price="{{ $item->price }}">
                          <i class="fa fa-plus fa-md text-white"></i>
                        </button>
                      </div>
                      @endauth
                      {{-- Button add end --}}
                    </div>
                    <span class="mb-2">{{ rupiah($item->price) }}</span>

                    <div class="d-flex">
                      <small class="fst-italic align-middle pe-3 pe-lg-2">
                        {{ $item->description}}
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        {{-- Tab all end --}}

        {{-- Tabs start --}}
        @foreach ($categories as $category)
        <div id="tab-{{ $category->name }}" class="tab-pane fade show p-0">
          <div class="row g-4 justify-content-between">
            @foreach ($food as $item)
            @if ($item->category_id == $category->id)
            <div class="col-xl-6">
              <div class="row d-flex align-items-center align-items-stretch">
                <div class="col-12 col-md-5 col-lg-4 col-xl-4">
                  {{-- Image --}}
                  <img class="flex-shrink-0 img-fluid rounded-3 shadow-sm" src="{{ $item->image }}"
                    alt="Gambar makanan" />
                </div>
                <div class="col-12 col-md-7 col-lg-8 col-xl-8">
                  <div class="d-flex flex-column text-start px-1 pt-3 pt-md-0">
                    <div class="row d-flex justify-content-between">
                      <div class="col-10 pe-0">
                        <h5>{{ $item->name }}</h5>
                      </div>
                      {{-- Button add start --}}
                      @auth
                      <div class="col text-end">
                        <button class="btn btn-sm rounded-3 btn-success my-auto shadow-sm" id="btn_add_cart"
                          style="height: 30px; width: 30px" data-food-id="{{ $item->food_id }}"
                          data-user-id="{{ auth()->user()->id }}" data-price="{{ $item->price }}">
                          <i class="fa fa-plus fa-md text-white"></i>
                        </button>
                      </div>
                      @endauth
                      {{-- Button add end --}}
                    </div>
                    <span class="mb-2">{{ rupiah($item->price) }}</span>

                    <div class="d-flex">
                      <small class="fst-italic align-middle pe-3 pe-lg-2">
                        {{ $item->description}}
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
        @endforeach
        {{-- Tabs end --}}
      </div>
      {{-- Content tab end --}}
    </div>
    {{-- Tab end --}}
  </div>
</section>
<!-- Section Menu End -->

<!-- Divider Reservation -->
<x-home.divider id="reservation" />

<!-- Section Reservation Start -->
<section class="container-xxl px-0">
  <div class="container-xxl pb-1 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
      {{-- Image start --}}
      <div class="col-lg-6 d-none d-lg-block">
        <img class="img-fluid d-block" style="height: 100%" src="{{ asset('assets/img/nasman-box.jpg') }}" alt="" />
      </div>
      {{-- Image end --}}

      {{-- Reservation form start --}}
      <div class="col-lg-6 bg-dark d-flex align-items-center" id="reservation">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
          <h5 class="section-title ff-secondary text-start text-primary fw-normal">
            Reservasi
          </h5>
          <h1 class="text-white mb-4">Isi reservasi online</h1>
          <form id="reservation_form">
            <input type="hidden" name="username" id="username"
              value="{{ (auth()->user()) ? auth()->user()->username : '' }}">
            <div class="row g-3">
              <div class="col-12">
                <div class="form-floating">
                  <input readonly name="name" type="text" class="form-control" id="name" placeholder="Nama"
                    value="{{ (auth()->user()) ? auth()->user()->name : '' }}" />
                  <label for="name">Nama</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input readonly name="phone" type="text" class="form-control" id="phone" placeholder="No. Telp"
                    value="{{ (auth()->user()) ? auth()->user()->phone : '' }}" />
                  <label for="phone">No. Telp</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <select name="estimation_time" class="form-select" id="selectEstimation">
                    <option value="1">1 Jam</option>
                    <option value="2">2 Jam</option>
                    <option value="3">3 Jam</option>
                  </select>
                  <label for="selectEstimation">Estimasi waktu</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating date">
                  <input name="reservation_date" type="date" class="form-control datetimepicker-input"
                    id="reservation_date" placeholder="Tanggal reservasi" />
                  <label for="reservation_date">Tanggal</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input name="reservation_time" type="time" class="form-control" id="reservation_time"
                    placeholder="Jam reservasi" />
                  <label for="reservation_time">Jam</label>
                </div>
              </div>
              <div class="col-12">
                @auth
                <button class="btn btn-primary w-100 fw-bold py-3" type="submit" id="btn_submit_reservation">
                  Reservasi sekarang
                </button>
                @endauth
                @guest
                <a href="/login" class="btn btn-primary w-100 fw-bold py-3">
                  Masuk ke akun
                </a>
                @endguest
              </div>
            </div>
          </form>
        </div>
      </div>
      {{-- Reservation form end --}}
    </div>
  </div>
</section>
<!-- Section Reservation End -->

{{-- Modal Reservation --}}
<x-home.modal.modal-reservation />

<script>
  // Date
  document.getElementById('reservation_date').valueAsDate = new Date();

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
  document.getElementById('reservation_time').value = currentTime;
</script>
@endsection
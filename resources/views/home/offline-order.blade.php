@extends('layouts.home', ['title' => 'Offline Order'])

@push('midtrans')
{{-- For development --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script>

{{-- For production --}}
{{-- <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
@endpush

@section('content')
<!-- Hero Start -->
<x-home.hero.offline-hero :table="$table" />
<!-- Hero End -->

<!-- Section Menu Start -->
<section class="container-xxl mb-5">
  <div class="container px-lg-5">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h5 class="section-title ff-secondary text-center text-primary fw-normal">
        Menu
      </h5>
      <h2 class="mb-5">Kategori Menu</h2>
    </div>

    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
      <div class="mb-4 pb-2 custom-scrollbar" style="overflow-y: scroll; max-height: 85px">
        <ul class="nav nav-pills d-inline-flex justify-content-center flex-nowrap">
          {{-- All --}}
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-4 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-all">
              <i class="fa-solid fa-list-ul fa-2x text-primary"></i>
              <div class="ps-3">
                <h6 class="mt-n1 mb-0 text-capitalize">Semua</h6>
              </div>
            </a>
          </li>

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

      <div class="tab-content">
        {{-- Tab all --}}
        <div id="tab-all" class="tab-pane fade show p-0 active">
          <div class="row g-4 justify-content-between">
            @foreach ($food as $item)
            <div class="col-xl-6">
              <div class="row d-flex align-items-center align-items-stretch">
                <div class="col-12 col-md-5 col-lg-4 col-xl-4">
                  <img class="flex-shrink-0 img-fluid rounded-3 shadow-sm" src="{{ $item->image }}"
                    alt="Gambar makanan" />
                </div>
                <div class="col-12 col-md-7 col-lg-8 col-xl-8">
                  <div class="d-flex flex-column text-start px-1 pt-3 pt-md-0">
                    <div class="row d-flex justify-content-between">
                      <div class="col-10 pe-0">
                        <h5>{{ $item->name }}</h5>
                      </div>

                      <div class="col text-end">
                        <button class="btn btn-sm rounded-3 btn-success my-auto shadow-sm" id="btn_add_cart"
                          style="height: 30px; width: 30px" data-name="{{ $item->name }}"
                          data-food-id=" {{ $item->food_id }}" data-user-id="{{ $table->user->id }}"
                          data-price="{{ $item->price }}">
                          <i class="fa fa-plus fa-md text-white"></i>
                        </button>
                      </div>

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
                          data-user-id="{{ $table->user->id }}" data-price="{{ $item->price }}">
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
    </div>
  </div>
  <!-- Menu End -->

  {{-- Modal checkout --}}
  <div class="modal fade" id="modalCheckout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCheckoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCheckoutLabel">Checkout Pesanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body body-checkout">
        </div>
      </div>
    </div>
  </div>
  {{-- Modal checkout --}}
</section>
<!-- Section Menu End -->

{{-- Modal order --}}
<x-home.modal.modal-order />
@endsection
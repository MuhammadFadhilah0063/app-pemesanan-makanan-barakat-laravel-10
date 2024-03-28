@extends('layouts/dashboard', ['title' => 'Dashboard - Offline Reservation'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Reservasi Offline</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Reservasi Offline</li>
  </ol>
</nav>

{{-- Content --}}
<div class="row">

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table align-items-center table-bordered table-flush table-striped table-hover display table-fixed align-bottom"
            width="100%" id="table_reservation">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Reservasi</th>
                <th>Status Reservasi</th>
                <th>Daftar Tunggu</th>
                <th>Nama</th>
                <th>Tanggal Reservasi</th>
                <th>Jam Reservasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalOfflineReservation" tabindex="-1" role="dialog"
  aria-labelledby="modalOfflineReservationTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Reservasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- ID and status --}}
        <div class="form-row">
          <div class="col-8 mb-3">
            <label for="id_reservation">Nomor Reservasi</label>
            <input type="text" class="form-control" id="id_reservation" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="status">Status Reservasi</label>
            <input type="text" class="form-control" id="status" readonly>
          </div>
        </div>

        {{-- Name --}}
        <h6 class="mt-3 font-weight-bold">Data Pemesan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" readonly>
          </div>
        </div>

        {{-- Date and Time --}}
        <h6 class="mt-3 font-weight-bold">Reservasi</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-6 mb-3">
            <label for="reservation_date">Tanggal</label>
            <input type="text" class="form-control" id="reservation_date" readonly>
          </div>
          <div class="col-6 mb-3">
            <label for="reservation_time">Jam</label>
            <input type="time" class="form-control" id="reservation_time" readonly>
          </div>
        </div>

        {{-- Reservation Items --}}
        <h6 class="mt-3 font-weight-bold">Item Reservasi</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row justify-content-center mb-3">
          <div class="col mb-3">
            <div class="card-body pb-1 border rounded-lg" id="card_reservation_items"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Checkout -->
<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="modalCheckoutTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Checkout Reservasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-checkout">
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@include('dashboard.transaction.offline_reservation.offline_reservation-script')
@endpush
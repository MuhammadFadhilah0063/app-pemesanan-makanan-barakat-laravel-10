@extends('layouts/dashboard', ['title' => 'Dashboard - Online Order'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pesanan Online</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pesanan Online</li>
  </ol>
</nav>

{{-- Content --}}
<div class="row">

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">

      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover display responsive align-bottom" width="100%"
            id="table_order">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Pesanan</th>
                <th>Nama Penerima</th>
                <th>No. Telp</th>
                <th>Keterangan</th>
                <th>Alamat Pengantaran</th>
                <th>Tanggal Pengambilan</th>
                <th>Jam Pengambilan</th>
                <th>Estimasi Waktu</th>
                <th>Status Pesanan</th>
                <th>Pembayaran</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
                <th>Reservasi</th>
                <th>Status Reservasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Center -->
<div class="modal fade" id="modalOnlineOrder" tabindex="-1" role="dialog" aria-labelledby="modalOnlineOrderTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- ID and status --}}
        <div class="form-row">
          <div class="col-8 mb-3">
            <label for="id_pesanan">Nomor Pesanan</label>
            <input type="text" class="form-control" id="id_pesanan" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="status">Status Pesanan</label>
            <input type="text" class="form-control" id="status" readonly>
          </div>
        </div>

        {{-- Name and Phone --}}
        <h6 class="mt-3 font-weight-bold">Data Penerima</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-7 mb-3">
            <label for="name">Nama Penerima</label>
            <input type="text" class="form-control" id="name" readonly>
          </div>
          <div class="col-5 mb-3">
            <label for="phone">No. Telp</label>
            <input type="text" class="form-control" id="phone" readonly>
          </div>
          <div class="col-12 mb-3">
            <label for="address">Alamat Pengantaran</label>
            <input type="text" class="form-control" id="address" readonly>
          </div>
        </div>

        {{-- Date, Time, and Estimation --}}
        <h6 class="mt-3 font-weight-bold">Pengambilan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-4 mb-3">
            <label for="pick_up_date">Tanggal</label>
            <input type="text" class="form-control" id="pick_up_date" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="pick_up_time">Jam</label>
            <input type="time" class="form-control" id="pick_up_time" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="estimation_time">Estimasi</label>
            <input type="time" class="form-control" id="estimation_time" readonly>
          </div>
        </div>

        {{-- Total, payment, and payment_status --}}
        <h6 class="mt-3 font-weight-bold">Pembayaran</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-6 mb-3">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" readonly>
          </div>
          <div class="col-3 mb-3">
            <label for="payment_method">Metode</label>
            <input type="text" class="form-control" id="payment_method" readonly>
          </div>
          <div class="col-3 mb-3">
            <label for="payment_status">Status</label>
            <input type="text" class="form-control" id="payment_status" readonly>
          </div>
        </div>

        {{-- Item pesanan --}}
        <h6 class="mt-3 font-weight-bold">Item Pesanan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row justify-content-center mb-3">
          <div class="col mb-3">
            <div class="card-body pb-1 border rounded-lg" id="list_item_order"></div>
          </div>
        </div>

        {{-- Reservation --}}
        <h6 class="mt-3 font-weight-bold">Data reservasi</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-7 mb-3">
            <label for="reservation_id">Nomor Reservasi</label>
            <input type="text" class="form-control" id="reservation_id" readonly>
          </div>
          <div class="col-5 mb-3">
            <label for="reservation_status">Status Reservasi</label>
            <input type="text" class="form-control" id="reservation_status" readonly>
          </div>
        </div>

        {{-- Item reservation --}}
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
@endsection

@push('script')
@include('dashboard.transaction.online_order.online_order-script')
@endpush
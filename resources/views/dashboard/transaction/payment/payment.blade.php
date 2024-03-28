@extends('layouts/dashboard', ['title' => 'Dashboard - Payments'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
            width="100%" id="table_payment">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Pembayaran</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>No. Pesanan</th>
                <th>Status Pesanan</th>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- ID and status --}}
        <h6 class="mt-3 font-weight-bold">Pembayaran</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-8 mb-3">
            <label for="payment_id">Nomor</label>
            <input type="text" class="form-control" id="payment_id" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="payment_status">Status</label>
            <input type="text" class="form-control" id="payment_status" readonly>
          </div>
        </div>

        {{-- Total, and payment_date --}}
        <div class="form-row">
          <div class="col-6 mb-3">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" readonly>
          </div>
          <div class="col-6 mb-3">
            <label for="payment_date">Tanggal</label>
            <input type="text" class="form-control" id="payment_date" readonly>
          </div>
        </div>

        {{-- Id and status order --}}
        <h6 class="mt-3 font-weight-bold">Pesanan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-8 mb-3">
            <label for="order_id">Nomor</label>
            <input type="text" class="form-control" id="order_id" readonly>
          </div>
          <div class="col-4 mb-3">
            <label for="order_status">Status</label>
            <input type="text" class="form-control" id="order_status" readonly>
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
@include('dashboard.transaction.payment.payment-script')
@endpush
@extends('layouts/dashboard', ['title' => 'Dashboard - Offline Order'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pesanan Offline</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pesanan Offline</li>
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
            width="100%" id="table_order">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Pesanan</th>
                <th>Nama</th>
                <th>Status Pesanan</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
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
<div class="modal fade" id="modalOfflineOrder" tabindex="-1" role="dialog" aria-labelledby="modalOfflineOrderTitle"
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

        {{-- Name --}}
        <h6 class="mt-3 font-weight-bold">Data Pemesan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" readonly>
          </div>
        </div>

        {{-- Total, and payment_status --}}
        <h6 class="mt-3 font-weight-bold">Pembayaran</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row">
          <div class="col-6 mb-3">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" readonly>
          </div>
          <div class="col-6 mb-3">
            <label for="payment_status">Status</label>
            <input type="text" class="form-control" id="payment_status" readonly>
          </div>
        </div>

        {{-- Item pesanan --}}
        <h6 class="mt-3 font-weight-bold">Item Pesanan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row justify-content-center mb-3">
          <div class="col mb-3">
            <div class="card-body pb-1 border rounded-lg" id="card_order_items"></div>
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
@include('dashboard.transaction.offline_order.offline_order-script')
@endpush
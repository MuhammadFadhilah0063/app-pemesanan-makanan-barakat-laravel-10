@extends('layouts/dashboard', ['title' => 'Dashboard - Purchase Of Materials'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pembelian Bahan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pembelian Bahan</li>
  </ol>
</nav>

{{-- Content --}}
<div class="row">

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <div class="row d-flex flex-row align-items-center justify-content-between">
          {{-- Button --}}
          <div class="col-12 col-lg-3 mb-3 mb-lg-0">
            <button id="btn-add" class="btn btn-primary">
              Tambah <i class="fas fa-plus fa-xs ml-1"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table align-items-center table-bordered table-flush table-striped table-hover display table-fixed align-bottom"
            width="100%" id="table_purchase">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Pembelian</th>
                <th>Bahan Baku</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Tanggal Pembelian</th>
                <th>Pemasok</th>
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
<div class="modal fade" id="modalPurchase" tabindex="-1" role="dialog" aria-labelledby="modalPurchaseTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pembelian Bahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- ID and date --}}
        <div class="form-row">
          <div class="col-12 col-sm-8 mb-3">
            <label for="purchase_id">Nomor Pembelian</label>
            <input type="text" class="form-control" id="purchase_id" readonly>
          </div>
          <div class="col-12 col-sm-4 mb-3">
            <label for="purchase_date">Tanggal</label>
            <input type="text" class="form-control" id="purchase_date" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-sm-6 mb-3">
            <label for="material">Bahan Baku</label>
            <input type="text" class="form-control" id="material" readonly>
          </div>
          <div class="col-12 col-sm-6 mb-3">
            <label for="supplier">Pemasok</label>
            <input type="text" class="form-control" id="supplier" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-sm-6 mb-3">
            <label for="quantity">Jumlah</label>
            <input type="text" class="form-control" id="quantity" readonly>
          </div>
          <div class="col-12 col-sm-6 mb-3">
            <label for="unit_price">Harga</label>
            <input type="text" class="form-control" id="unit_price" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="col mb-3">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" readonly>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Center -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddTitle">Tambah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-add">
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@include('dashboard.transaction.purchase.purchase-script')
@endpush
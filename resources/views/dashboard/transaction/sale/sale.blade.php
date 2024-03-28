@extends('layouts/dashboard', ['title' => 'Dashboard - Sales'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
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
            width="100%" id="table_sale">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Penjualan</th>
                <th>Total</th>
                <th>Tanggal Penjualan</th>
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-sale">

        {{-- ID --}}
        <div class="form-row">
          <div class="col mb-3">
            <label for="sale_id">Nomor Penjualan</label>
            <input type="text" class="form-control" id="sale_id" readonly>
          </div>
        </div>

        {{-- Total, and date --}}
        <div class="form-row">
          <div class="col-6 mb-3">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" readonly>
          </div>
          <div class="col-6 mb-3">
            <label for="sale_date">Tanggal</label>
            <input type="text" class="form-control" id="sale_date" readonly>
          </div>
        </div>

        {{-- Item penjualan --}}
        <h6 class="mt-3 font-weight-bold">Item Penjualan</h6>
        <hr class="mt-0 mb-3 p-0">
        <div class="form-row justify-content-center mb-3">
          <div class="col mb-3">
            <div class="card-body pb-1 border rounded-lg" id="items"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Modal Center -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddTitle">Tambah Penjualan</h5>
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
@include('dashboard.transaction.sale.sale-script')
@endpush
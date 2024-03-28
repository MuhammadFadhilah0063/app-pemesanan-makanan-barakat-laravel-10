@extends('layouts/dashboard', ['title' => 'Dashboard - Online Reservation Report'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Laporan Reservasi Online</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item text-primary">Laporan</li>
    <li class="breadcrumb-item active" aria-current="page">Reservasi Online</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <h5>Pilih Tahun dan Bulan Laporan Reservasi Online</h5>
        <hr class="m-0">
      </div>

      <form id="form_select">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6 mb-2 mb-sm-0">
              <label for="report_year">Tahun</label>
              <input type="text" name="report_year" id="report_year" maxlength="4" class="form-control"
                placeholder="Tahun" value="">
            </div>
            <div class="col-12 col-sm-6">
              <label for="report_month">Bulan</label>
              <select name="report_month" id="report_month" class="form-control">
                <option value="">--Pilih Bulan--</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary rounded-3 shadow-sm font-weight-bold">PILIH</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row d-none row-table">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <h5 id="row_table_title">title</h5>
        <hr class="m-0">
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table align-items-center table-bordered table-flush table-striped table-hover display table-fixed align-bottom"
            width="100%" id="table_">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>No. Reservasi</th>
                <th>Nama</th>
                <th>Tanggal Reservasi</th>
                <th>Status</th>
                <th>No. Pesanan</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-primary rounded-3 shadow-sm font-weight-bold btn-print">
          CETAK
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('script')
@include('dashboard.report.online-reservation.online_reservation_report-script')
@endpush
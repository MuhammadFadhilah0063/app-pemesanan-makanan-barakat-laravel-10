@extends('layouts/dashboard', ['title' => 'Dashboard', 'datatable' => false])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
  </ol>
</nav>

{{-- Content --}}
<h5 class="font-weight-bold mb-3">Pendapatan</h5>
<div class="row mb-3">
  <!-- Pendapatan Bulan Ini -->
  <div class="col-12 col-xl-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan Bulan Ini
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rupiah($revenue['revenueMonth']) }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-lg fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pendapatan Tahun Ini -->
  <div class="col-12 col-xl-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan Tahun Ini
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rupiah($revenue['revenueYear']) }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-lg fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jumlah Semua Pendapatan -->
  <div class="col-12 col-xl-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Semua Pendapatan
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rupiah($revenue['revenueAll']) }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-lg fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-3">
  {{-- Offline order start --}}
  <div class="col-12 col-sm-6">
    <h5 class="font-weight-bold mb-3">Pesanan Offline</h5>
    <div class="row">
      <!-- Pending -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pending
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineOrder['pending']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-circle-notch fa-2x fa-spin fa-lg text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Process -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Process
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineOrder['process']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-circle fa-2x fa-spin fa-lg text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Success
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineOrder['success']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-check-circle fa-2x text-success fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Failed -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Failed
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineOrder['failed']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-ban fa-lg fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Offline order end --}}

  {{-- Offline reservation start --}}
  <div class="col-12 col-sm-6">
    <h5 class="font-weight-bold mb-3">Reservasi Offline</h5>
    <div class="row">
      <!-- Pending -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pending
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineReservation['pending']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-circle-notch fa-2x fa-spin fa-lg text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Process -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Process
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineReservation['process']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-circle fa-2x fa-spin fa-lg text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Success
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineReservation['success']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-check-circle fa-2x text-success fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Failed -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Failed
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($offlineReservation['failed']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-ban fa-lg fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Offline reservation end --}}
</div>

<div class="row mb-3">
  {{-- Online order start --}}
  <div class="col-12 col-sm-6">
    <h5 class="font-weight-bold mb-3">Pesanan Online</h5>
    <div class="row">
      <!-- Pending -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pending
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineOrder['pending']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-circle-notch fa-2x fa-spin fa-lg text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Process -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Process
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineOrder['process']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-circle fa-2x fa-spin fa-lg text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Success
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineOrder['success']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-check-circle fa-2x text-success fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Failed -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Failed
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineOrder['failed']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-ban fa-lg fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Online order end --}}

  {{-- Online reservation start --}}
  <div class="col-12 col-sm-6">
    <h5 class="font-weight-bold mb-3">Reservasi Online</h5>
    <div class="row">
      <!-- Pending -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pending
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineReservation['pending']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-circle-notch fa-2x fa-spin fa-lg text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Process -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Process
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineReservation['process']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-circle fa-2x fa-spin fa-lg text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Success
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineReservation['success']) }}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-check-circle fa-2x text-success fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Failed -->
      <div class="col-12 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Failed
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ribu($onlineReservation['failed']) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-ban fa-lg fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Online reservation end --}}
</div>

{{-- Waiting list start --}}
<div class="row mb-3">
  <div class="col">
    <h5 class="font-weight-bold mb-3">Daftar Tunggu Hari Ini</h5>
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
                <th>Nama</th>
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
{{-- Waiting list end --}}

{{-- Grafik pemesanan makanan online start --}}
<div class="row mb-3">
  <div class="col">
    <h5 class="font-weight-bold mb-3">Grafik pesanan online</h5>
    <div class="card mb-4">
      <div class="card-body">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- Grafik pemesanan makanan online end --}}

{{-- Grafik pemesanan makanan offline start --}}
<div class="row mb-3">
  <div class="col">
    <h5 class="font-weight-bold mb-3">Grafik pesanan offline</h5>
    <div class="card mb-4">
      <div class="card-body">
        <canvas id="myChart2"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- Grafik pemesanan makanan offline end --}}

{{-- Grafik reservasi online start --}}
<div class="row mb-3">
  <div class="col">
    <h5 class="font-weight-bold mb-3">Grafik reservasi online</h5>
    <div class="card mb-4">
      <div class="card-body">
        <canvas id="myChart3"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- Grafik reservasi online end --}}

{{-- Grafik reservasi offline start --}}
<div class="row mb-3">
  <div class="col">
    <h5 class="font-weight-bold mb-3">Grafik reservasi offline</h5>
    <div class="card mb-4">
      <div class="card-body">
        <canvas id="myChart4"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- Grafik reservasi offline end --}}

@endsection

@push('script')
{{-- chart js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('dashboard.home-script')
@endpush
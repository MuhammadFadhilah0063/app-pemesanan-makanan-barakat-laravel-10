<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('assets/img/logo/Warung2-rm.png') }}">
    </div>
    <div class="sidebar-brand-text mx-2 text-nowrap">Barakat Tarim</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dasbor</span></a>
  </li>
  <hr class="sidebar-divider">

  {{-- Data Master --}}
  <div class="sidebar-heading">Data</div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMaster" aria-expanded="true"
      aria-controls="collapseDataMaster">
      <i class="fas fa-database"></i>
      <span>Data Master</span>
    </a>
    <div id="collapseDataMaster" class="collapse {{ Request::is('admin/dashboard/data/*') ? 'show' : '' }}"
      aria-labelledby="headingDataMaster" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Data Master</h6>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/user*') ? 'active' : '' }}"
          href="{{ route('user.index') }}">Pengguna</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/category*') ? 'active' : '' }}"
          href="{{ route('category.index') }}">Kategori</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/menu*') ? 'active' : '' }}"
          href="{{ route('food.index') }}">Menu</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/table*') ? 'active' : '' }}"
          href="{{ route('table.index') }}">Meja</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/material*') ? 'active' : '' }}"
          href="{{ route('material.index') }}">Bahan Baku</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/supplier*') ? 'active' : '' }}"
          href="{{ route('supplier.index') }}">Pemasok</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/cash*') ? 'active' : '' }}"
          href="{{ route('cash.index') }}">Kas</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/data/selling*') ? 'active' : '' }}"
          href="{{ route('selling.index') }}">Jualan</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">

  {{-- Transaksi --}}
  <div class="sidebar-heading">Transaksi</div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true"
      aria-controls="collapseTransaksi">
      <i class="fas fa-coins"></i>
      <span>Transaksi</span>
    </a>
    <div id="collapseTransaksi" class="collapse {{ Request::is('admin/dashboard/transaction/*') ? 'show' : '' }}"
      aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Transaksi</h6>
        <a class="collapse-item position-relative {{ Request::is('admin/dashboard/transaction/online-order*') ? 'active' : '' }}"
          href="{{ route('admin.online-order') }}">
          Pesanan Online
          @if ($transaction['onlineOrderPending'] != 0)
          <span class="badge badge-danger shadow-lg rounded ml-2 p-1 font-weight-bold">{{
            $transaction['onlineOrderPending'] }}</span>
          @endif
        </a>
        <a class="collapse-item position-relative {{ Request::is('admin/dashboard/transaction/offline-order*') ? 'active' : '' }}"
          href="{{ route('admin.offline-order') }}">
          Pesanan Offline
          @if ($transaction['offlineOrderProcess'] != 0)
          <span class="badge badge-danger shadow-lg rounded ml-2 p-1 font-weight-bold">{{
            $transaction['offlineOrderProcess'] }}</span>
          @endif
        </a>
        <a class="collapse-item position-relative {{ Request::is('admin/dashboard/transaction/online-reservation*') ? 'active' : '' }}"
          href="{{ route('admin.online-reservation') }}">
          Reservasi Online
          @if ($transaction['onlineReservationPending'] != 0)
          <span class="badge badge-danger shadow-lg rounded ml-2 p-1 font-weight-bold">{{
            $transaction['onlineReservationPending'] }}</span>
          @endif
        </a>
        <a class="collapse-item position-relative {{ Request::is('admin/dashboard/transaction/offline-reservation*') ? 'active' : '' }}"
          href="{{ route('admin.offline-reservation') }}">
          Reservasi Offline
          @if ($transaction['offlineReservationPending'] != 0)
          <span class="badge badge-danger shadow-lg rounded ml-2 p-1 font-weight-bold">{{
            $transaction['offlineReservationPending'] }}</span>
          @endif
        </a>
        <a class="collapse-item {{ Request::is('admin/dashboard/transaction/payment*') ? 'active' : '' }}"
          href="{{ route('admin.payment') }}">Pembayaran</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/transaction/sale*') ? 'active' : '' }}"
          href="{{ route('admin.sale') }}">Penjualan</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/transaction/expense*') ? 'active' : '' }}"
          href="{{ route('admin.expense') }}">Pengeluaran</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/transaction/purchase*') ? 'active' : '' }}"
          href="{{ route('admin.purchase') }}">Pembelian Bahan</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">

  {{-- Laporan --}}
  <div class="sidebar-heading">Laporan</div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true"
      aria-controls="collapseLaporan">
      <i class="fas fa-folder-open"></i>
      <span>Laporan</span>
    </a>
    <div id="collapseLaporan" class="collapse {{ Request::is('admin/dashboard/report/*') ? 'show' : '' }}"
      aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Laporan</h6>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/online-order*') ? 'active' : '' }}"
          href="{{ route('admin.online-order.report') }}">Pesanan Online</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/offline-order*') ? 'active' : '' }}"
          href="{{ route('admin.offline-order.report') }}">Pesanan Offline</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/online-reservation*') ? 'active' : '' }}"
          href="{{ route('admin.online-reservation.report') }}">Reservasi Online</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/offline-reservation*') ? 'active' : '' }}"
          href="{{ route('admin.offline-reservation.report') }}">Reservasi Offline</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/payment*') ? 'active' : '' }}"
          href="{{ route('admin.payment.report') }}">Pembayaran</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/sale*') ? 'active' : '' }}"
          href="{{ route('admin.sale.report') }}">Penjualan</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/expense*') ? 'active' : '' }}"
          href="{{ route('admin.expense.report') }}">Pengeluaran</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/purchase*') ? 'active' : '' }}"
          href="{{ route('admin.purchase.report') }}">Pembelian Bahan</a>
        <a class="collapse-item {{ Request::is('admin/dashboard/report/profit-and-loss*') ? 'active' : '' }}"
          href="{{ route('admin.profit-and-loss.report') }}">Laba dan Rugi</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>
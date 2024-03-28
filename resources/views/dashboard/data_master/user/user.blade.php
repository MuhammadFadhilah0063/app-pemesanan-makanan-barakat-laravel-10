@extends('layouts/dashboard', ['title' => 'Dashboard - User'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
  </ol>
</nav>

{{-- Content --}}
<div class="row">

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <div class="row d-flex flex-row align-items-center justify-content-end">
          <div class="col-12 col-lg-3 pl-lg-5">
            <div class="row">
              {{-- Status --}}
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="status">Status</label>
                  </div>
                  <select class="form-control" id="status">
                    <option value="select">Pilih status</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover display responsive align-bottom" width="100%"
            id="table_user">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No. Hp</th>
                <th>Status</th>
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
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUserTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Status Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <div class="input-group-prepend">
            <label class="input-group-text" for="status">Status</label>
          </div>
          <input type="hidden" id="inputId">
          <select class="form-control" id="changeStatus">
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="submit">Ubah</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@include('dashboard.data_master.user.user-script')
@endpush
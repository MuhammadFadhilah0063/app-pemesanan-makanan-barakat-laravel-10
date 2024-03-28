@extends('layouts/dashboard', ['title' => 'Dashboard - Category'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
  </ol>
</nav>

{{-- Content --}}
<div class="row">

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header pb-0 pt-3">
        <div class="row d-flex flex-row align-items-center justify-content-start">
          {{-- Button --}}
          <div class="col-12 col-lg-3 mb-3 mb-lg-0">
            <button id="btn-add" class="btn btn-primary">Tambah <i class="fas fa-plus fa-xs ml-1"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover display responsive align-bottom" width="100%"
            id="table_category">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>Kategori</th>
                <th>Slug</th>
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
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="modalCategoryTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputCategory">Kategori</label>
          <input type="hidden" class="form-control" id="inputId">
          <input required autofocus type="text" class="form-control" id="inputCategory">
          <div id="inputCategoryError" class="invalid-feedback d-none"></div>
        </div>
        <div class="form-group">
          <label for="inputSlug">Slug</label>
          <input required readonly type="text" class="form-control" id="inputSlug">
          <div id="inputSlugError" class="invalid-feedback d-none"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="submit">Ubah</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@include('dashboard.data_master.category.category-script')
@endpush
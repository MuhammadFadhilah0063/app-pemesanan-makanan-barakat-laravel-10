@extends('layouts/dashboard', ['title' => 'Dashboard - Supplier'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pemasok</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pemasok</li>
    </ol>
</nav>

{{-- Content --}}
<div class="row">

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0 pt-3">
                <div class="row d-flex flex-row align-items-center justify-content-left">
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
                    <table class="table align-items-center table-flush table-hover display responsive align-bottom"
                        width="100%" id="table_supplier">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
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
<div class="modal fade" id="modalSupplier" tabindex="-1" role="dialog" aria-labelledby="modalSupplierTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pemasok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData">

                    {{-- Input Nama --}}
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="inputName">Nama</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama"
                                required autofocus>
                            <div id="inputNameError" class="invalid-feedback d-none"></div>
                        </div>
                    </div>

                    {{-- Input No. Telp --}}
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="inputPhone">No. Telp</label>
                            <input name="phone" type="text" class="form-control" id="inputPhone" placeholder="No. Telp"
                                required autofocus>
                            <div id="inputPhoneError" class="invalid-feedback d-none"></div>
                        </div>
                    </div>

                    {{-- Input Alamat --}}
                    <div class="form-group">
                        <label for="textareaAddress">Alamat</label>
                        <textarea name="address" class="form-control" id="textareaAddress" rows="4"></textarea>
                        <div id="inputNameError" class="invalid-feedback d-none"></div>
                    </div>

                    {{-- Input Description --}}
                    <div class="form-group mt-3">
                        <label for="textareaDescription">Deskripsi</label>
                        <textarea name="description" class="form-control" id="textareaDescription" rows="2"></textarea>
                        <div id="inputDescriptionError" class="invalid-feedback d-none"></div>
                    </div>

                    {{-- Input Id --}}
                    <input name="id" type="hidden" id="inputId">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submit">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
@include('dashboard.data_master.supplier.supplier-script')
@endpush
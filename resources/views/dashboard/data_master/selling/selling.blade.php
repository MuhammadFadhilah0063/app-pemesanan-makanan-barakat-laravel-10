@extends('layouts/dashboard', ['title' => 'Dashboard - Selling'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jualan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jualan</li>
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
                        width="100%" id="table_selling">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th class="text-capitalize">Unit</th>
                                <th>Harga</th>
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
<div class="modal fade" id="modalSelling" tabindex="-1" role="dialog" aria-labelledby="modalSellingTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Jualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData">

                    {{-- Input Nama dan unit --}}
                    <div class="form-row">
                        <div class="col-8 mb-3">
                            <label for="inputName">Nama</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama"
                                required autofocus>
                            <div id="inputNameError" class="invalid-feedback d-none"></div>
                        </div>
                        <div class="col mb-3">
                            <label for="selectUnit">Unit</label>
                            <select class="form-control" name="unit" id="selectUnit" required>
                                <option value="">Pilih unit</option>
                                <option value="buah">buah</option>
                                <option value="bungkus">bungkus</option>
                                <option value="mika">mika</option>
                            </select>
                            <div id="selectUnitError" class="invalid-feedback d-none"></div>
                        </div>
                    </div>

                    {{-- Input Harga dan Stok --}}
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="inputStok">Stok</label>
                            <input name="stok" type="text" class="form-control" id="inputStok" placeholder="Stok"
                                required>
                            <div id="inputStokError" class="invalid-feedback d-none"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputPrice">Harga</label>
                            <input name="price" type="text" class="form-control" id="inputPrice" placeholder="Harga"
                                required>
                            <div id="inputPriceError" class="invalid-feedback d-none"></div>
                        </div>
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
@include('dashboard.data_master.selling.selling-script')
@endpush
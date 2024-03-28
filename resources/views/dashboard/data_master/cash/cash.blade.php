@extends('layouts/dashboard', ['title' => 'Dashboard - Cash'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kas</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kas</li>
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
                        width="100%" id="table_cash">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Kas</th>
                                <th>Total</th>
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
<div class="modal fade" id="modalCash" tabindex="-1" role="dialog" aria-labelledby="modalCashTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData">

                    {{-- Input Cash --}}
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="inputCash">Kas</label>
                            <input name="cash" type="text" class="form-control" id="inputCash" placeholder="Kas"
                                required autofocus>
                            <div id="inputCashError" class="invalid-feedback d-none"></div>
                        </div>
                    </div>

                    {{-- Input Total --}}
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="inputPhone">Total</label>
                            <input name="total" type="number" class="form-control" id="inputTotal" placeholder="Total"
                                required>
                            <div id="inputTotalError" class="invalid-feedback d-none"></div>
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
@include('dashboard.data_master.cash.cash-script')
@endpush
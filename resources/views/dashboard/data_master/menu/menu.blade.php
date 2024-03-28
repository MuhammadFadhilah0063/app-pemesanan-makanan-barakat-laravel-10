@extends('layouts/dashboard', ['title' => 'Dashboard - Menu'])

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
        <li class="breadcrumb-item active" aria-current="page">Menu</li>
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

                    {{-- Filter --}}
                    <div class="col-12 col-lg-3 pl-lg-5">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-prepend">
                                            <select id="filter"
                                                class="form-control bg-primary text-white fw-semibold shadow-sm">
                                                <option value="select">Pilih filter</option>
                                                <option value="status">Status</option>
                                                <option value="category">Kategori</option>
                                            </select>
                                        </div>
                                    </div>
                                    <select class="form-control shadow-sm filter-select" id="category"
                                        disabled></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover display responsive align-bottom"
                        width="100%" id="table_menu">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Gambar</th>
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
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenuTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data">

                    {{-- Input Nama dan Slug --}}
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="inputName">Nama</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama"
                                required autofocus>
                            <div id="inputNameError" class="invalid-feedback d-none"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputSlug">Slug</label>
                            <input name="slug" type="text" readonly class="form-control" id="inputSlug"
                                placeholder="Slug" required>
                            <div id="inputSlugError" class="invalid-feedback d-none"></div>
                        </div>
                    </div>

                    {{-- Input Kategori dan harga --}}
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="selectKategori">Kategori</label>
                            <select name="category_id" class="form-control" id="selectCategory" required>
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputPrice">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputPrice">Rp.</label>
                                </div>
                                <input name="price" required type="text" class="form-control" id="inputPrice">
                                <div id="inputPriceError" class="invalid-feedback d-none"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Input Gambar --}}
                    <label for="inputFile">Gambar</label>
                    <div class="custom-file shadow-none">
                        <input name="image" type="file" class="custom-file-input form-control" id="inputFile">
                        <label class="custom-file-label shadow-none" for="inputFile">Pilih file</label>
                        <div id="inputFileError" class="invalid-feedback d-none"></div>
                    </div>

                    {{-- Image Prewiew --}}
                    <img id="previewImage" src="{{ asset('storage/image/app/img.png')}}" alt="img.png"
                        class="img-thumbnail d-block mx-auto rounded mt-4 shadow-sm"
                        style="display: none; max-width: 100%; max-height: 200px;">

                    {{-- Input Deskripsi --}}
                    <div class="form-group mt-3">
                        <label for="textareaDescription">Deskripsi</label>
                        <textarea name="description" class="form-control" id="textareaDescription" rows="4"></textarea>
                        <div id="inputNameError" class="invalid-feedback d-none"></div>
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
@include('dashboard.data_master.menu.menu-script')
@endpush
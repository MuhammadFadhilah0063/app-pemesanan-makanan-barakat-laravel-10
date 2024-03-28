@extends('layouts.home', ['title' => 'Offline Order'])

@section('content')
<!-- Hero Start -->
<x-home.hero.offline-hero :table="''" />
<!-- Hero End -->

<!-- Section Form Name Start -->
<section class="container-xxl position-relative p-4">
  <div class="card">
    <div class="card-body">
      <form id="off-reservation-form">
        <div class="row justify-content-center">
          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name" required>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col col-lg-6">
            <div class="d-grid">
              <button type="submit" class="btn btn-primary fw-bold rounded-3 shadow-sm">Reservasi</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Section Form Name End -->
@endsection
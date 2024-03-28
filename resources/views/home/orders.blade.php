@extends('layouts.home', ['title' => 'Orders'])

@push('midtrans')
{{-- For development --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script>

{{-- For production --}}
{{-- <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
@endpush

@section('content')
<section class="container-xxl pb-4">
  <div class="container container-items">
    {{-- Items --}}
    <x-home.orders.orders :orders="$orders ?? ''" />

    {{-- <div class="row mt-4">
      <div class="col-12 text-center">
        <button type="button" class="btn btn-primary btn-sm rounded-3 shadow text-capitalize font-weight-bold btn-next">
          selanjutnya...
        </button>
      </div>
    </div> --}}
  </div>
</section>

{{-- Modal Reservation --}}
<x-home.modal.modal-reservation />

{{-- <script>
  $('body').on('click', '.btn-next', function () { 
    $.ajax('')
  });
</script> --}}
@endsection
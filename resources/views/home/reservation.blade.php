@extends('layouts.home', ['title' => 'Reservation'])

@push('midtrans')
{{-- For development --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script>

{{-- For production --}}
{{-- <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
  data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
@endpush

@section('content')
<div class="container-xxl pb-4">
  <div class="container container-items">
    {{-- Items --}}
    <x-home.reservation.reservation :reservations="$reservations ?? ''" />
  </div>
</div>
@endsection
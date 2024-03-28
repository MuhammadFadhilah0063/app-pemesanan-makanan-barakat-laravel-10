@if (Str::startsWith(request()->path(), 'reservation/online/order'))
{{-- Navbar order in reservation start --}}
<div class="container-xxl position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 d-flex justify-content-between">
    <span class="navbar-brand p-0">
      <h1 class="text-primary m-0">
        <i class="fa fa-utensils me-3"></i>Barakat Tarim
      </h1>
    </span>

    <!-- Cart start -->
    <x-home.navbar.cart :dropdownLayout="'dropdown-menu-end'" :carts="$carts" />
    {{-- Cart end --}}
  </nav>
</div>
{{-- Navbar order in reservation end --}}

@else
<div class="container-xxl position-relative p-0">
  <nav class="navbar navbar-expand-xl navbar-dark bg-dark px-4 px-xl-5 py-3 py-xl-0">
    {{-- Brand start --}}
    <a href="{{ Request::is('/') ? '#' : '/' }}" class="navbar-brand p-0">
      <h1 class="text-primary m-0">
        <i class="fa fa-utensils me-3"></i>Barakat Tarim
      </h1>
    </a>
    {{-- Brand end --}}

    {{-- Collapse start --}}
    <x-home.navbar.collapse :carts="$carts" />
    {{-- Collapse end --}}
  </nav>
</div>
@endif
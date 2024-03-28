<div class="container-xxl position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 d-flex justify-content-between">
    <span class="navbar-brand p-0">
      <h1 class="text-primary m-0">
        <i class="fa fa-utensils me-3"></i>Barakat Tarim
      </h1>
    </span>

    <!-- Cart start -->
    @if (Str::startsWith(request()->path(), 'order/offline'))
    <x-home.navbar.cart :dropdownLayout="'dropdown-menu-end'" :carts="$carts" />
    @endif
    {{-- Cart end --}}
  </nav>
</div>
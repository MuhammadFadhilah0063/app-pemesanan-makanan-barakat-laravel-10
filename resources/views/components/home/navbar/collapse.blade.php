{{-- Button toggle start --}}
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
  <span class="fa fa-bars"></span>
</button>
{{-- Button toggle end --}}

{{-- Collapse start --}}
<div class="collapse navbar-collapse" id="navbarCollapse">
  {{-- Navigation item start --}}
  <div class="navbar-nav ms-auto py-0 pe-4" id="navbar">
    <a href="{{ Request::is('/') ? '#' : '/' }}" id="home_link" class="nav-item nav-link">Beranda</a>
    <a href="{{ Request::is('/') ? '#about' : '/#about' }}" id="about_link" class="nav-item nav-link">Tentang</a>
    <a href="{{ Request::is('/') ? '#menu' : '/#menu' }}" id="menu_link" class="nav-item nav-link">Menu</a>
    <a href="{{ Request::is('/') ? '#reservation' : '/#reservation' }}" id="reservation_link"
      class="nav-item nav-link">Reservasi</a>
    <a href="#contact" id="contact_link" class="nav-item nav-link">Kontak</a>
  </div>
  {{-- Navigation item end --}}

  {{-- Script active link for home.index start --}}
  @if (Request::is('/'))
  <x-home.navbar.script.active-link />
  @endif
  {{-- Script active link end --}}

  <!-- User start -->
  @auth
  <x-home.navbar.user />
  @endauth
  <!-- User end -->

  {{-- Button login and registration start --}}
  @guest
  <x-home.navbar.login-registration-button />
  @endguest
  {{-- Button login and registration end --}}

  <!-- Cart start -->
  @auth
  <x-home.navbar.cart :dropdownLayout="'dropdown-menu-xl-end'" :carts="$carts" />
  @endauth
  {{-- Cart end --}}
</div>
{{-- Collapse end --}}
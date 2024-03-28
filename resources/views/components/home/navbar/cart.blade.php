<div class="btn-group" id="btn_cart">
  {{-- Button toggle start --}}
  <button type="button" class="btn btn-primary p-1 px-2 rounded-3 position-relative dropdown-toggle"
    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" id="dropDownMenuCart">
    {{-- Icon --}}
    <i class="fa fa-shopping-cart"></i>

    {{-- Badge start --}}
    @if (sizeof($carts) != 0)
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      {{-- Number cart --}}
      {{ count($carts) }}

      {{-- Hidden --}}
      <span class="visually-hidden">Item keranjang</span>
    </span>
    @endif
    {{-- Badge end --}}
  </button>
  {{-- Button toggle end --}}

  {{-- Dropdown start --}}
  <ul class="dropdown-menu rounded-3 py-0 {{ $dropdownLayout }}" aria-labelledby="dropDownMenuCart">
    <li>
      <div class="card rounded-3 border-0" style="width: 320px">
        <div class="card-header">Daftar keranjang saya</div>
        <ul class="list-group list-group-flush" id="ul-cart">
          {{-- Cart items start --}}
          @if (sizeof($carts) == 0)
          <span class="d-flex justify-content-center py-4">Daftar masih kosong...</span>
          @else
          <x-home.navbar.cart-item :carts="$carts" />
          @endif
          {{-- Cart items end --}}

          {{-- Button order start --}}
          @if (sizeof($carts) != 0)
          <button class="btn btn-sm text-white btn-success py-2 fw-bold border-top-0" id="btn-checkout">
            Pesan
          </button>
          @endif
          {{-- Button order end --}}
        </ul>
      </div>
    </li>
  </ul>
  {{-- Dropdown end --}}
</div>
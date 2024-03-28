<div class="btn-group me-xl-2 d-block mb-3 mb-xl-0">
  {{-- Button toggle start --}}
  <button type="button" class="btn btn-primary p-1 px-2 rounded-3 dropdown-toggle overflow-hidden"
    data-bs-toggle="dropdown" aria-expanded="false" style="max-width: 250px; text-overflow: ellipsis">
    <i class="fa fa-user"></i>
    <span class="ms-1 text-lowercase">{{ Auth::user()->username }}</span>
  </button>
  {{-- Button toggle end --}}

  {{-- Dropdown start --}}
  <ul class="dropdown-menu rounded-3 dropdown-menu-xl-end py-0">
    <li>
      <div class="card rounded-3 border-0" style="width: 18rem">
        <div class="card-header text-capitalize">
          {{ Auth::user()->name }}
        </div>
        <ul class="list-group list-group-flush">
          <a href="/profile">
            <li class="list-group-item list-group-item-action">
              Profil
            </li>
          </a>
          <a href="/orders">
            <li class="list-group-item list-group-item-action">
              Pesanan
            </li>
          </a>
          <a href="/reservation">
            <li class="list-group-item list-group-item-action">
              Reservasi
            </li>
          </a>
          @if (auth()->user()->role == 'admin')
          <a href="/admin/dashboard">
            <li class="list-group-item list-group-item-action">
              Dashboard
            </li>
          </a>
          @endif
          <button type="button" class="btn btn-sm text-white btn-danger py-2 fw-bold border-top-0" id="btn-logout"
            data-id="{{ Auth::user()->id }}">
            Keluar
          </button>
        </ul>
      </div>
    </li>
  </ul>
  {{-- Dropdown end --}}
</div>
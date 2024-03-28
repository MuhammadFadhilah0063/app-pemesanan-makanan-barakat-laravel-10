<div class="row g-3 justify-content-center">
  <div class="col-12 mb-1">
    <label class="mb-1" for="username">Username</label>
    <input readonly type="text" class="form-control" id="username" value="{{ $user->username }}" />
  </div>

  <div class="col-md-7 mb-1">
    <label class="mb-1" for="name">Nama</label>
    <input required type="text" class="form-control" id="name" placeholder="Nama" value="{{ $user->name }}" />
  </div>
  <div class="col-md-5 mb-1">
    <label class="mb-1" for="phone">No. Telp</label>
    <input required type="text" class="form-control" id="phone" placeholder="No. Telp" value="{{ $user->phone }}" />
  </div>

  <div class="col-12 col-md-6 mb-5">
    <button class="btn btn-sm btn-primary w-100 py-2 fw-bold rounded-3" type="submit" id="btn-update-profile">
      UBAH
    </button>
  </div>
</div>
@extends('layouts.home', ['title' => 'Profile'])

@section('content')
{{-- Divider --}}
<div class="container-xxl py-xl-5"></div>

{{-- Section Profile Start --}}
<section class="container-xxl" style="margin-top: 20px">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h5 class="section-title ff-secondary text-center text-primary fw-normal mt-5">
        Profil
      </h5>
      <h1 class="mb-5">Profil</h1>
    </div>

    <div class="row g-4 pt-2 justify-content-center">
      <!-- Form password start -->
      <div class="col-12 col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="text-center mb-3 wow fadeInUp">Ubah Password</h4>
        <hr />

        <div class="wow fadeInUp">
          <form id="form-update-password">
            <div class="row g-3 justify-content-center">
              <div class="col-12 mb-1">
                <label class="mb-1" for="old_password">Password Lama</label>
                <input required type="text" class="form-control" id="old_password" />
              </div>
              <div class="col-12 mb-1">
                <label class="mb-1" for="new_password">Password Baru</label>
                <input required type="text" class="form-control" id="new_password" />
              </div>
              <div class="col-12 mb-1">
                <label class="mb-1" for="confirm_password">Konfirmasi Password</label>
                <input required type="text" class="form-control" id="confirm_password" />
              </div>

              <div class="col-12 col-md-6 mb-5">
                <button class="btn btn-sm btn-primary w-100 py-2 fw-bold rounded-3" type="submit"
                  id="btn-update-password">
                  UBAH
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Form password end -->

      <!-- Form profile start -->
      <div class="col-12 col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="text-center mb-3 wow fadeInUp">Data Saya</h4>
        <hr />

        <div class="wow fadeInUp">
          <form id="form-update-profile">
            <x-home.profile.body_form_profile :user="auth()->user()" />
          </form>
        </div>
      </div>
      <!-- Form profile end -->
    </div>

  </div>
</section>
{{-- Section Profile End --}}

<script>
  // update profile
  $('body').on('submit', '#form-update-profile', function (e) {
    e.preventDefault();

    loadingTrue();  
    $.ajax({
      url: myApp + '/profile',
      method: 'PUT',
      data: {
        username: $('#username').val(),
        name: $('#name').val(),
        phone: $('#phone').val(),
      },
      success: function (res) {
        loadingFalse();

        // Update form
        $('#form-update-profile').html(res.html);

        alertSuccess(res.message);
      },
      error: function () {
        showError();
      }
    });
  });

  // update password
  $('body').on('submit', '#form-update-password', function (e) {
    e.preventDefault();

    loadingTrue();  
    $.ajax({
      url: myApp + '/update-password',
      method: 'PUT',
      data: {
        old_password: $('#old_password').val(),
        new_password: $('#new_password').val(),
        confirm_password: $('#confirm_password').val(),
        username: $('#username').val(),
      },
      success: function (res) {
        loadingFalse();
        alertSuccess(res.message);
      },
      error: function () {
        showError();
      }
    });
  });
</script>
@endsection
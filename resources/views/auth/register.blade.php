@extends('layouts.auth', ['title' => 'Register'])

@section('content')
<div class="login-form">
    <div class="text-center">
        <div class="form-group">
            <span class="h4 text-gray-900 mb-4 font-weight-bold" style="font-size: 32px">DAFTAR</span>
        </div>
        <div class="form-group mb-4">
            <span>Masukkan data-data dibawah ini, untuk mendaftar akun baru.</span>
        </div>
    </div>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <input required autofocus type="text" name="name" value="{{ old('name') }}" class="form-control"
                placeholder="Nama">
        </div>
        <div class="form-group">
            <input required type="text" name="username" value="{{ old('username') }}"
                class="form-control @error('username') is-invalid @enderror" placeholder="Username">
            @error('username')
            <div class="alert alert-danger mt-2">
                Username sudah ada
            </div>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-group mb-3">
                <input required type="password" name="password" id="password" value="{{ old('password') }}"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                <div class="input-group-append d-grid bg-light">
                    <span class="input-group-text" id="showPasswordToggle" onclick="togglePasswordVisibility()">
                        <i class="far fa-eye-slash"></i>
                    </span>
                </div>
            </div>
            @error('password')
            @if ($message == 'validation.confirmed')
            <div class="alert alert-danger mt-2">
                Konfirmasi password salah
            </div>
            @else
            <div class="alert alert-danger mt-2">
                Password minimal 8 karakter
            </div>
            @endif
            @enderror
        </div>
        <div class="input-group mb-3">
            <input required type="password" name="password_confirmation" id="password_confirmation"
                value="{{ old('password_confirmation') }}" class="form-control @error('password') is-invalid @enderror"
                placeholder="Konfirmasi Password">
            <div class="input-group-append d-grid bg-light">
                <span class="input-group-text" id="showConfirmPasswordToggle"
                    onclick="toggleConfirmPasswordVisibility()">
                    <i class="far fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>
    <hr>
    <div class="text-center">
        <a class="font-weight-bold small" href="{{ route('login') }}" style="font-size: 15px">Sudah memiliki akun?</a>
    </div>
    <div class="text-center">
    </div>
</div>

{{-- Script toggle password hidden --}}
<script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var toggleButton = document.getElementById("showPasswordToggle");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.innerHTML = '<i class="far fa-eye"></i>';
      } else {
        passwordInput.type = "password";
        toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
      }
    }

    function toggleConfirmPasswordVisibility() {
        var confirmPasswordInput = document.getElementById("password_confirmation");
        var toggleButton = document.getElementById("showConfirmPasswordToggle");

        if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleButton.innerHTML = '<i class="far fa-eye"></i>';
      } else {
        confirmPasswordInput.type = "password";
        toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
      }
    }
</script>
@endsection
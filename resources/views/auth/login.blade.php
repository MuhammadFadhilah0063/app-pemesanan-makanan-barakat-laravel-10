@extends('layouts.auth', ['title' => 'Login'])

@section('content')
<div class="login-form">
    <div class="text-center">
        <div class="form-group">
            <span class="h4 text-gray-900 mb-4 font-weight-bold" style="font-size: 32px">MASUK</span>
        </div>
        <div class="form-group mb-4">
            <span>Masukkan username dan password Anda untuk mengakses aplikasi.</span>
        </div>
    </div>
    <form class="user" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input required autofocus type="text" name="username" value="{{ old('username') }}"
                class="form-control @if ($errors->any()) is-invalid @endif" placeholder="Username">
            @if ($errors->any())
            <div class="alert alert-danger mt-2">
                Username atau password salah
            </div>
            @endif
        </div>
        <div class="input-group mb-3">
            <input required type="password" name="password" id="password" value="{{ old('password') }}"
                class="form-control @if ($errors->any()) is-invalid @endif" placeholder="Password">
            <div class="input-group-append d-grid bg-light">
                <span class="input-group-text" id="showPasswordToggle" onclick="togglePasswordVisibility()">
                    <i class="far fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Masuk</button>
    </form>
    <hr>
    <div class="text-center">
        <a class="font-weight-bold small" href="{{ route('register') }}" style="font-size: 15px">Belum memiliki
            akun?</a>
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
</script>
@endsection
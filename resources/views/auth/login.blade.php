@extends('layouts.guest')

@section('title', 'Masuk - Obatku')

@section('content')

<style>
  .icon-wrapper-login {
    width: 80px;
    height: 80px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 202, 240, 0.1) 100%);
    transform: rotate(-5deg);
    margin-bottom: 1.5rem;
  }

  .icon-wrapper-login i {
    transform: rotate(5deg);
  }

  .btn-gradient {
    background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 .5rem 1rem rgba(13, 110, 253, .25) !important;
  }

  .form-floating>.form-control:focus~label::after,
  .form-floating>.form-control:not(:placeholder-shown)~label::after {
    background-color: transparent !important;
  }

</style>

<div class="card shadow-lg border-0 rounded-4 overflow-hidden position-relative">
  <div style="height: 6px; background: linear-gradient(90deg, #0d6efd, #0dcaf0);"></div>

  <div class="card-body p-4 p-md-5">

    <div class="text-center mb-4">
      <div class="icon-wrapper-login">
        <i class="bi bi-capsule fs-1 text-primary"></i>
      </div>
      <h4 class="fw-bolder text-dark mb-1">Selamat Datang Kembali</h4>
      <p class="text-muted small">Masuk ke sistem <a href="{{ route('index') }}" class="fw-bold text-primary text-decoration-none">Obatku</a> untuk mengelola layanan Anda.</p>
    </div>

    @if ($errors->any())
    <div class="alert border-0 bg-danger bg-opacity-10 text-danger rounded-3 small fw-medium d-flex align-items-start mb-4" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-3 fs-5 mt-1"></i>
      <div>
        @foreach ($errors->all() as $error)
        <div class="mb-1">{{ $error }}</div>
        @endforeach
      </div>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-floating mb-3">
        <input id="email" type="email" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="email" required autofocus placeholder="nama@email.com">
        <label for="email" class="text-muted small"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
      </div>

      <div class="form-floating mb-4">
        <input id="password" type="password" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="password" required placeholder="Kata Sandi">
        <label for="password" class="text-muted small"><i class="bi bi-shield-lock me-2"></i>Kata Sandi</label>
      </div>

      {{-- <div class="d-flex justify-content-between align-items-center mb-4 px-1">
        <div class="form-check">
          <input class="form-check-input border-secondary-subtle shadow-none" type="checkbox" name="remember" id="remember">
          <label class="form-check-label text-muted small user-select-none" for="remember" style="cursor: pointer;">
            Ingat Saya
          </label>
        </div>
        <a href="#" class="text-decoration-none small fw-medium text-primary">Lupa Sandi?</a>
      </div> --}}

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-gradient btn-lg fw-bold rounded-pill text-white shadow-sm py-2">
          Masuk ke Sistem <i class="bi bi-arrow-right-circle ms-1"></i>
        </button>
      </div>

      <div class="text-center mt-4">
        <div class="mb-4">
          <span class="text-muted small">Belum memiliki akun?</span>
          <a href="{{ route('register') }}" class="text-decoration-none small fw-bolder text-primary ms-1">Daftar sekarang</a>
        </div>
        <a href="{{ route('index') }}" class="text-decoration-none small fw-bolder text-muted ms-1">
          <- Kembali ke Landing Page</a>
      </div>

    </form>

  </div>
</div>

@endsection

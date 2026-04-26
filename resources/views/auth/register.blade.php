@extends('layouts.guest')

@section('title', 'Daftar - Obatku')

@section('content')

<style>
  .icon-wrapper-register {
    width: 80px;
    height: 80px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 202, 240, 0.1) 100%);
    transform: rotate(5deg);
    margin-bottom: 1rem;
  }

  .icon-wrapper-register i {
    transform: rotate(-5deg);
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
  .form-floating>.form-control:not(:placeholder-shown)~label::after,
  .form-floating>.form-select~label::after {
    background-color: transparent !important;
  }

</style>

<div class="card shadow-lg border-0 rounded-4 overflow-hidden position-relative">
  <div style="height: 6px; background: linear-gradient(90deg, #0d6efd, #0dcaf0);"></div>

  <div class="card-body p-4 p-md-5">

    <div class="text-center mb-4">
      <div class="icon-wrapper-register">
        <i class="bi bi-person-plus fs-1 text-primary"></i>
      </div>
      <h4 class="fw-bolder text-dark mb-1">Buat Akun Baru</h4>
      <p class="text-muted small">Langkah pertama menuju manajemen pengobatan yang cerdas.</p>
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

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="form-floating">
            <input id="name" type="text" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="name" required autofocus placeholder="Nama Lengkap">
            <label for="name" class="text-muted small"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input id="email" type="email" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="email" required placeholder="nama@email.com">
            <label for="email" class="text-muted small"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="form-floating">
            <input id="role" type="text" class="form-control bg-secondary bg-opacity-10 border-light-subtle fw-bold text-primary" style="border-radius: 12px;" name="role" required value="Pasien" readonly>
            <label for="role" class="text-muted small"><i class="bi bi-person-badge me-2"></i>Mendaftar Sebagai</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input id="nik" type="text" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="nik" required placeholder="35092...">
            <label for="nik" class="text-muted small"><i class="bi bi-credit-card me-2"></i>NIK (16 Digit)</label>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="form-floating">
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" required>
              <option value="" selected disabled>Pilih...</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <label for="jenis_kelamin" class="text-muted small"><i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input id="tanggal_lahir" type="date" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="tanggal_lahir" required>
            <label for="tanggal_lahir" class="text-muted small"><i class="bi bi-calendar-date me-2"></i>Tanggal Lahir</label>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <div class="form-floating">
            <input id="password" type="password" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="password" required placeholder="Kata Sandi">
            <label for="password" class="text-muted small"><i class="bi bi-shield-lock me-2"></i>Kata Sandi</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input id="password_confirmation" type="password" class="form-control bg-light border-light-subtle fw-medium text-dark" style="border-radius: 12px;" name="password_confirmation" required placeholder="Konfirmasi Sandi">
            <label for="password_confirmation" class="text-muted small"><i class="bi bi-shield-check me-2"></i>Ulangi Sandi</label>
          </div>
        </div>
      </div>

      <div class="d-grid gap-2 mt-2">
        <button type="submit" class="btn btn-gradient btn-lg fw-bold rounded-pill text-white shadow-sm py-2">
          Daftar Sekarang <i class="bi bi-person-plus-fill ms-1"></i>
        </button>
      </div>

      <div class="text-center mt-4">
        <span class="text-muted small">Sudah memiliki akun?</span>
        <a href="{{ route('login') }}" class="text-decoration-none small fw-bolder text-primary ms-1">Masuk di sini</a>
      </div>

    </form>
  </div>
</div>

@endsection

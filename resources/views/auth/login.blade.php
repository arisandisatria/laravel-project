@extends('layouts.guest')

@section('title', 'Masuk - Obatku')

@section('content')

<div class="card shadow border-0 rounded-4">
  <div class="card-body p-4 p-md-5">

    <div class="text-center mb-5">
      <a href="{{route('index')}}" class="text-decoration-none text-primary fw-bold fs-3 d-flex align-items-center justify-content-center gap-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
          <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z" />
        </svg>
        Obatku
      </a>
      <h4 class="fw-bold text-dark">Selamat Datang Kembali</h4>
      <p class="text-muted small">Masuk ke sistem Obatku untuk mengelola resep dan jadwal Anda.</p>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger mb-4 text-center small fw-medium" role="alert">
      @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
      @endforeach
    </div>
    @endif

    <form method="POST" action="#">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
        <input id="email" type="email" class="form-control bg-light border-0 py-2" name="email" required autofocus placeholder="nama@email.com">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold text-secondary">Kata Sandi</label>
        <input id="password" type="password" class="form-control bg-light border-0 py-2" name="password" required placeholder="••••••••">
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill shadow-sm">
          Masuk ke Sistem
        </button>
      </div>

      <div class="text-center mt-4">
        <span class="text-muted small">Belum punya akun?</span>
        <a href="{{route('register')}}" class="text-decoration-none small fw-bold text-primary">Daftar di sini</a>
      </div>
    </form>

  </div>
</div>

@endsection

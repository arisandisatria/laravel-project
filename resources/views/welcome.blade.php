<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Obatku - Sistem Manajemen Farmasi & Resep Digital</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .transition-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .transition-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .bg-primary-subtle-custom {
      background-color: rgba(13, 110, 253, 0.1);
    }

  </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2" href="{{route('index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
          <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z" />
        </svg>
        Obatku
      </a>
      <div class="d-flex gap-2">
        @guest
        <a href="{{route('login')}}" class="btn btn-outline-primary px-4">Masuk</a>
        <a href="{{route('register')}}" class="btn btn-primary px-4 shadow-sm">Daftar</a>
        @endguest

        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 shadow-sm">Ke Dashboard</a>
        <a href="{{ route('logout') }}" class="btn btn-outline-danger px-4">Keluar</a>
        @endauth
      </div>
    </div>
  </nav>

  <section class="container d-flex flex-column justify-content-center align-items-center text-center flex-grow-1" style="padding-top: 180px; padding-bottom: 120px;">
    <span class="badge bg-primary-subtle-custom text-primary px-3 py-2 rounded-pill mb-3 fw-medium border border-primary border-opacity-10">Platform Kesehatan Digital Terpadu</span>
    <h1 class="display-4 fw-bold text-dark mb-3" style="line-height: 1.2;">
      Manajemen Obat & Resep <br> <span class="text-primary">Secara Real-Time</span>
    </h1>
    <p class="lead text-muted mb-5" style="max-width: 650px;">
      Optimalkan alur kerja fasilitas kesehatan anda dengan sistem pencatatan obat terpusat, pembuatan resep elektronik, dan pengingat otomatis.
    </p>
    <div class="d-flex gap-3">
      @guest

      <a href="{{route('login')}}" class="btn btn-primary btn-lg px-5 shadow-sm">Mulai Sekarang</a>
      <a href="#fitur" class="btn btn-outline-secondary btn-lg px-4">Pelajari Fitur</a>
      @endguest

      @auth
      <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 shadow-sm">Buka Dashboard</a>
      @endauth
    </div>
  </section>

  <section id="fitur" class="bg-white py-5 border-top">
    <div class="container py-5">
      <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Fitur Unggulan Sistem Obatku</h2>
        <p class="text-muted">Infrastruktur lengkap untuk memastikan efisiensi dan ketepatan penanganan.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border border-light shadow-sm text-center p-4 transition-hover">
            <div class="display-5 mb-3 text-primary">📦</div>
            <h5 class="fw-bold">Manajemen Inventaris</h5>
            <p class="text-muted small mb-0">Pencatatan data obat secara menyeluruh. Pantau detail stok, ketersediaan, dan histori pemakaian dalam satu dashboard terpusat.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border border-light shadow-sm text-center p-4 transition-hover">
            <div class="display-5 mb-3 text-primary">📝</div>
            <h5 class="fw-bold">E-Resep Pintar</h5>
            <p class="text-muted small mb-0">Digitalisasi pembuatan resep dengan tingkat akurasi tinggi. Terintegrasi langsung dengan bagian farmasi untuk proses penyiapan yang cepat.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border border-light shadow-sm text-center p-4 transition-hover">
            <div class="display-5 mb-3 text-primary">⏰</div>
            <h5 class="fw-bold">Jadwal & Notifikasi</h5>
            <p class="text-muted small mb-0">Sistem penjadwalan otomatis yang mengirimkan pengingat minum obat secara tepat waktu, memastikan kepatuhan program pengobatan.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border border-light shadow-sm text-center p-4 transition-hover">
            <div class="display-5 mb-3 text-primary">🔄</div>
            <h5 class="fw-bold">Sinkronisasi Real-Time</h5>
            <p class="text-muted small mb-0">Alur informasi tanpa jeda mulai dari penentuan resep, penyiapan obat, hingga jadwal konsumsi, seluruhnya terhubung secara real-time.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-light py-5">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <div class="col-lg-5">
          <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3 fw-medium">Alur Sistem Terintegrasi</span>
          <h2 class="fw-bold text-dark mb-4">Satu Alur Presisi, <br>Menghilangkan Risiko Salah Resep</h2>
          <p class="text-muted mb-4">
            Obatku merampingkan proses yang dulunya manual menjadi otomatis. Dari diagnosa hingga jadwal minum obat, semua terekam rapi secara digital untuk menghindari kesalahan manusia.
          </p>
          <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-start mb-3">
              <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 32px; height: 32px; min-width: 32px;">1</div>
              <div>
                <h6 class="fw-bold mb-1">Dokter Membuat E-Resep</h6>
                <p class="text-muted small mb-0">Pemilihan obat dari database master terpusat dengan dosis spesifik.</p>
              </div>
            </li>
            <li class="d-flex align-items-start mb-3">
              <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 32px; height: 32px; min-width: 32px;">2</div>
              <div>
                <h6 class="fw-bold mb-1">Apoteker Memvalidasi & Menyiapkan</h6>
                <p class="text-muted small mb-0">Notifikasi instan di apotek untuk mempercepat penyiapan obat.</p>
              </div>
            </li>
            <li class="d-flex align-items-start">
              <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 32px; height: 32px; min-width: 32px;">3</div>
              <div>
                <h6 class="fw-bold mb-1">Pasien Menerima Obat & Jadwal</h6>
                <p class="text-muted small mb-0">Aplikasi pasien otomatis mengatur alarm pengingat minum obat secara berkala.</p>
              </div>
            </li>
          </ul>
        </div>

        <div class="col-lg-7">
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="bg-primary p-4 text-white text-center">
              <h5 class="fw-bold mb-0">Dashboard Preview</h5>
            </div>
            <div class="card-body p-0 bg-white" style="height: 350px; display: flex; align-items: center; justify-content: center;">
              <img class="object-fit-contain" style="height: 350px;" src="{{asset('img/dashboard-preview.png')}}" alt="Dashboard Preview">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-primary text-white py-5 text-center">
    <div class="container py-4">
      <h2 class="fw-bold mb-3">Siap Mengoptimalkan Pelayanan Kesehatan Anda?</h2>
      <p class="lead mb-4 text-white-50" style="max-width: 600px; margin: 0 auto;">
        Bergabunglah dan rasakan kemudahan manajemen obat dan resep digital dengan keamanan dan kecepatan maksimal.
      </p>
      @guest

      <a href="{{route('register')}}" class="btn btn-light btn-lg px-5 text-primary fw-bold rounded-pill">Buat Akun Sekarang</a>
      @endguest

      @auth
      <a href="{{route('dashboard')}}" class="btn btn-light btn-lg px-5 text-primary fw-bold rounded-pill">Buka Dashboard Saya</a>

      @endauth
    </div>
  </section>

  <footer class="bg-white py-4 border-top mt-auto">
    <div class="container text-center text-muted small">
      &copy; <?= date('Y') ?> Obatku. Membangun Ekosistem Kesehatan Digital.
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

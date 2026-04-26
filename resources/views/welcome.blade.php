<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Obatku - Sistem Manajemen Farmasi & Resep Digital</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .navbar-glass {
      background-color: rgba(255, 255, 255, 0.9) !important;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .hero-bg {
      background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
      position: relative;
      overflow: hidden;
    }

    .text-gradient {
      background: linear-gradient(to right, #0d6efd, #0dcaf0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .card-feature {
      border: 1px solid rgba(13, 110, 253, 0.1);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .card-feature:hover {
      transform: translateY(-10px);
      box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
      border-color: rgba(13, 110, 253, 0.3);
    }

    .icon-wrapper {
      width: 70px;
      height: 70px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 20px;
      background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 202, 240, 0.1) 100%);
      margin-bottom: 1.5rem;
      transition: transform 0.3s ease;
    }

    .card-feature:hover .icon-wrapper {
      transform: scale(1.1) rotate(5deg);
    }

    .floating-img {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .blob-1 {
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(13, 202, 240, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
      top: -200px;
      right: -100px;
      z-index: 0;
    }

    .blob-2 {
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(13, 110, 253, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
      bottom: -100px;
      left: -100px;
      z-index: 0;
    }

  </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-light navbar-glass border-bottom shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2" href="{{route('index')}}">
        <i class="bi bi-capsule fs-3"></i> Obatku
      </a>
      <div class="d-flex gap-2">
        @guest
        <a href="{{route('login')}}" class="btn btn-outline-primary px-4 rounded-pill fw-medium">Masuk</a>
        <a href="{{route('register')}}" class="btn btn-primary px-4 shadow-sm rounded-pill fw-medium">Daftar</a>
        @endguest

        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 shadow-sm rounded-pill fw-medium">Ke Dashboard</a>
        <a href="{{ route('logout') }}" class="btn btn-outline-danger px-4 rounded-pill fw-medium">Keluar</a>
        @endauth
      </div>
    </div>
  </nav>

  <section class="hero-bg flex-grow-1 position-relative" style="padding-top: 160px; padding-bottom: 120px;">
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <div class="container position-relative z-1 d-flex flex-column justify-content-center align-items-center text-center">
      <div data-aos="fade-down" data-aos-duration="1000">
        <span class="badge bg-white text-primary px-4 py-2 rounded-pill mb-4 fw-medium border shadow-sm">
          <i class="bi bi-stars me-1 text-warning"></i> Platform Kesehatan Digital Terpadu
        </span>
      </div>

      <h1 class="display-4 fw-bolder text-dark mb-4" style="line-height: 1.2; letter-spacing: -1px;" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
        Manajemen Obat & Resep <br> <span class="text-gradient">Secara Real-Time</span>
      </h1>

      <p class="lead text-secondary mb-5" style="max-width: 650px;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        Optimalkan alur kerja fasilitas kesehatan Anda dengan sistem pencatatan obat terpusat, pembuatan resep elektronik yang presisi, dan pengingat otomatis.
      </p>

      <div class="d-flex gap-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        @guest
        <a href="{{route('login')}}" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill fw-bold">Mulai Sekarang</a>
        <a href="#fitur" class="btn btn-white btn-lg px-4 border rounded-pill text-dark fw-medium shadow-sm hover-bg-light">Pelajari Fitur</a>
        @endguest

        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill fw-bold">Buka Dashboard Saya</a>
        @endauth
      </div>
    </div>
  </section>

  <section id="fitur" class="bg-white py-5">
    <div class="container py-5">
      <div class="text-center mb-5" data-aos="fade-up">
        <h6 class="text-primary fw-bold text-uppercase tracking-wider mb-2">Mengapa Obatku?</h6>
        <h2 class="fw-bolder text-dark">Fitur Unggulan Sistem Kami</h2>
        <p class="text-muted">Infrastruktur lengkap untuk memastikan efisiensi dan ketepatan penanganan medis.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <div class="card h-100 bg-white rounded-4 card-feature p-4 text-center">
            <div class="icon-wrapper text-primary fs-1 mx-auto">
              <i class="bi bi-box-seam"></i>
            </div>
            <h5 class="fw-bold text-dark">Manajemen Inventaris</h5>
            <p class="text-muted small mb-0">Pencatatan data obat menyeluruh. Pantau detail stok dan ketersediaan dalam satu dashboard terpusat.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
          <div class="card h-100 bg-white rounded-4 card-feature p-4 text-center">
            <div class="icon-wrapper text-info fs-1 mx-auto">
              <i class="bi bi-file-earmark-medical"></i>
            </div>
            <h5 class="fw-bold text-dark">E-Resep Pintar</h5>
            <p class="text-muted small mb-0">Digitalisasi resep dengan akurasi tinggi. Terintegrasi langsung dengan apotek untuk penyiapan super cepat.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
          <div class="card h-100 bg-white rounded-4 card-feature p-4 text-center">
            <div class="icon-wrapper text-warning fs-1 mx-auto">
              <i class="bi bi-alarm"></i>
            </div>
            <h5 class="fw-bold text-dark">Jadwal & Notifikasi</h5>
            <p class="text-muted small mb-0">Sistem penjadwalan otomatis mengirimkan pengingat minum obat, memastikan kepatuhan pasien terjaga.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
          <div class="card h-100 bg-white rounded-4 card-feature p-4 text-center">
            <div class="icon-wrapper text-success fs-1 mx-auto">
              <i class="bi bi-arrow-repeat"></i>
            </div>
            <h5 class="fw-bold text-dark">Sinkronisasi Real-Time</h5>
            <p class="text-muted small mb-0">Alur informasi tanpa jeda dari penentuan resep hingga jadwal konsumsi, seluruhnya terhubung seketika.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-light py-5">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <div class="col-lg-5" data-aos="fade-right">
          <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3 fw-bold">Alur Sistem Terintegrasi</span>
          <h2 class="fw-bolder text-dark mb-4" style="line-height: 1.3;">Satu Alur Presisi, <br>Menghilangkan Risiko.</h2>
          <p class="text-muted mb-4">
            Sistem ini merampingkan proses manual menjadi otomatis. Dari ruang periksa dokter hingga jadwal alarm pasien, semua direkam digital demi keamanan ekstra.
          </p>

          <ul class="list-unstyled mb-0 mt-4">
            <li class="d-flex align-items-start mb-4">
              <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                <i class="bi bi-1-circle-fill fs-3"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1 text-dark">Dokter Membuat E-Resep</h6>
                <p class="text-muted small mb-0">Pemilihan obat dari database master terpusat dengan instruksi dosis spesifik.</p>
              </div>
            </li>
            <li class="d-flex align-items-start mb-4">
              <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                <i class="bi bi-2-circle-fill fs-3"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1 text-dark">Apoteker Memvalidasi Obat</h6>
                <p class="text-muted small mb-0">Notifikasi instan di panel apotek untuk mempercepat validasi dan penyiapan.</p>
              </div>
            </li>
            <li class="d-flex align-items-start">
              <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                <i class="bi bi-3-circle-fill fs-3"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1 text-dark">Pasien Terjadwal Otomatis</h6>
                <p class="text-muted small mb-0">Dashboard pasien langsung mengatur alarm jadwal minum obat harian.</p>
              </div>
            </li>
          </ul>
        </div>

        <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden floating-img">
            <div class="bg-dark p-3 d-flex align-items-center gap-2">
              <div class="rounded-circle bg-danger" style="width: 12px; height: 12px;"></div>
              <div class="rounded-circle bg-warning" style="width: 12px; height: 12px;"></div>
              <div class="rounded-circle bg-success" style="width: 12px; height: 12px;"></div>
              <span class="text-white-50 small ms-2 fw-medium">Dashboard Preview</span>
            </div>
            <div class="card-body p-0 bg-white" style="height: 400px; display: flex; align-items: center; justify-content: center;">
              <img class="object-fit-contain w-100 h-100" src="{{asset('img/dashboard-preview.png')}}" alt="Dashboard Preview" onerror="this.style.display='none'">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="position-relative py-5 text-center overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container py-5 position-relative z-1" data-aos="zoom-in">
      <h2 class="fw-bolder mb-3 text-white">Siap Mengoptimalkan Pelayanan?</h2>
      <p class="lead mb-5 text-white-50 fw-normal" style="max-width: 600px; margin: 0 auto;">
        Bergabunglah sekarang dan rasakan kemudahan manajemen farmasi dan resep digital dengan tingkat keamanan maksimal.
      </p>

      @guest
      <a href="{{route('register')}}" class="btn btn-light btn-lg px-5 text-primary fw-bold rounded-pill shadow">Buat Akun Sekarang <i class="bi bi-arrow-right ms-2"></i></a>
      @endguest

      @auth
      <a href="{{route('dashboard')}}" class="btn btn-light btn-lg px-5 text-primary fw-bold rounded-pill shadow">Buka Dashboard Utama <i class="bi bi-arrow-right ms-2"></i></a>
      @endauth
    </div>

    <i class="bi bi-capsule position-absolute text-white opacity-10" style="font-size: 15rem; top: -50px; left: -50px; transform: rotate(-30deg);"></i>
    <i class="bi bi-heart-pulse position-absolute text-white opacity-10" style="font-size: 12rem; bottom: -50px; right: 50px;"></i>
  </section>

  <footer class="bg-white py-4 mt-auto">
    <div class="container text-center">
      <p class="text-muted small fw-medium mb-0">
        &copy; <?= date('Y') ?> Obatku. Membangun Ekosistem Kesehatan Digital Indonesia.
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Inisialisasi animasi AOS
    AOS.init({
      once: true, // Animasi hanya berjalan sekali saat di-scroll ke bawah
      offset: 50, // Muncul sedikit lebih cepat sebelum elemen masuk layar
    });

  </script>
</body>
</html>

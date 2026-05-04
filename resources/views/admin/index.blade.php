<x-app-layout>
  <style>
    .btn-custom-indigo {
      color: #6610f2;
      border: 1px solid #6610f2;
      transition: all 0.3s ease;
    }

    .btn-custom-indigo .icon-box {
      background-color: #6610f2;
      transition: all 0.3s ease;
    }

    .btn-custom-indigo:hover {
      background-color: #6610f2;
      color: #ffffff !important;
    }

    .btn-custom-indigo:hover .description-text {
      color: rgba(255, 255, 255, 0.8) !important;
    }

    .btn-custom-indigo:hover .icon-box {
      background-color: rgba(255, 255, 255, 0.2);
      color: #ffffff;
    }

    .extra-small {
      font-size: 0.75rem;
    }

    .border-dashed {
      border-style: dashed !important;
    }

  </style>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Admin Panel</h2>
      <p class="text-muted small mb-0">Manajemen infrastruktur data dan hak akses pengguna.</p>
    </div>
  </div>

  <div class="card shadow-sm border-0 rounded-4 mb-4 text-white overflow-hidden" style="background: linear-gradient(45deg, #4e085f, #6610f2);">
    <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
      <div style="z-index: 1;">
        <h4 class="fw-bold mb-1">Pusat Kendali Admin 🛡️</h4>
        <p class="mb-0 text-white-50 small">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Seluruh sistem berjalan dengan normal.</p>
      </div>
      <div class="d-none d-md-block opacity-25">
        <i class="bi bi-shield-lock" style="font-size: 5rem;"></i>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-sm-start">
          <div class="bg-indigo bg-opacity-10 rounded-3 p-3 text-center mb-3 d-inline-block" style="color: #6610f2; background-color: rgba(102, 16, 242, 0.1);">
            <i class="bi bi-person-badge fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Total Dokter</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $totalDokter }} <span class="fs-6 text-muted fw-normal">User</span></h3>
        </div>
      </div>
    </div>

    <div class="col-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-sm-start">
          <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-mortarboard fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Total Apoteker</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $totalApoteker }} <span class="fs-6 text-muted fw-normal">User</span></h3>
        </div>
      </div>
    </div>

    <div class="col-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-sm-start">
          <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-people fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Total Pasien</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $totalPasien }} <span class="fs-6 text-muted fw-normal">User</span></h3>
        </div>
      </div>
    </div>

    <div class="col-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100 bg-light border-4">
        <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
          <h6 class="text-muted fw-semibold mb-1 small">Total Akun Aktif</h6>
          <h3 class="fw-bold mb-0" style="color: #6610f2;">{{ $totalPengguna }}</h3>
          <hr class="my-2">
          <a href="{{ url('/manajemen-user') }}" class="small fw-bold link-underline link-underline-opacity-0 link-underline-opacity-100-hover link-offset-2" style="color: #6610f2;">Kelola Semua User &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4">Aktivitas Login Terakhir</h6>

          <div class="d-flex flex-column gap-3">
            @forelse ($aktivitasLogin as $user)
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center border-bottom pb-3 gap-2">
              <div class="d-flex align-items-center">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3 fw-bold flex-shrink-0" style="width: 40px; height: 40px; background-color: #6610f2;">
                  {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                  <h6 class="mb-0 fw-bold text-dark small">{{ $user->name }} <span class="text-muted fw-normal">({{ ucfirst($user->role) }})</span></h6>
                  <small class="text-muted" style="font-size: 0.75rem;">Melakukan login ke sistem</small>
                </div>
              </div>
              <span class="text-muted text-sm-end" style="font-size: 0.75rem;">{{ $user->last_login_at->diffForHumans() }}</span>
            </div>
            @empty
            <div class="text-center text-muted small py-3">
              Belum ada aktivitas login yang tercatat.
            </div>
            @endforelse
          </div>

        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
          <h5 class="fw-bold text-dark mb-0">Manajemen Sistem</h5>
        </div>
        <div class="card-body p-4">
          <div class="d-grid gap-3">
            <a href="{{ url('/manajemen-user/create') }}" class="btn btn-custom-indigo text-start p-3 rounded-4 d-flex align-items-center text-decoration-none transition-hover">
              <div class="icon-box text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                <i class="bi bi-person-plus"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-0">Tambah User Baru</h6>
                <span class="small opacity-75 description-text">Input Dokter/Apoteker/Pasien</span>
              </div>
            </a>
            <a href="{{ route('admin.backup') }}" class="btn btn-outline-dark text-start p-3 rounded-4 d-flex align-items-center text-decoration-none border-dashed">
              <div class="bg-dark text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;"><i class="bi bi-database"></i></div>
              <div>
                <h6 class="fw-bold mb-0">Backup Database</h6>
                <span class="small opacity-75">Ekspor data ke format .sql</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<style>
  :root {
    --sidebar-width: 260px;
    --primary-color: #0d6efd;
    --bg-light: #f8f9fa;
  }

  /* Sidebar Styling */
  #sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #fff;
    border-right: 1px solid #e9ecef;
    z-index: 1000;
    transition: all 0.3s;
  }

  .sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #f8f9fa;
  }

  .nav-link {
    padding: 12px 20px;
    color: #6c757d;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.2s;
  }

  .nav-link:hover,
  .nav-link.active {
    background-color: rgba(13, 110, 253, 0.05);
    color: var(--primary-color);
  }

  .nav-link.active {
    border-right: 4px solid var(--primary-color);
  }

  /* Topbar Adjustments */
  .topbar {
    height: 70px;
    background: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 999;
  }

  @media (max-width: 992px) {
    #sidebar {
      margin-left: calc(-1 * var(--sidebar-width));
    }

    #main-content {
      margin-left: 0;
    }

    #sidebar.active {
      margin-left: 0;
    }
  }

</style>

<nav id="sidebar">
  <div class="sidebar-header">
    <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
        <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z" />
      </svg>
      Obatku
    </a>
  </div>

  <div class="nav flex-column mt-3">
    <small class="text-uppercase text-muted fw-bold px-4 mb-2" style="font-size: 0.7rem;">Menu Utama</small>

    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard', 'apoteker.dashboard', 'dokter.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    @if (Auth::user()->role === 'pasien')
    <a href="{{ url('/jadwal-minum-obat') }}" class="nav-link {{ request()->is('jadwal-minum*') ? 'active' : '' }}">
      <i class="bi bi-calendar2-check"></i> Jadwal Minum Obat
    </a>
    @endif

    @if (Auth::user()->role === 'dokter')
    <a href="{{ url('/kelola-resep') }}" class="nav-link {{ request()->is('kelola-resep*') ? 'active' : '' }}">
      <i class="bi bi-file-earmark-medical"></i> Kelola Resep
    </a>
    <a href="{{ url('/manajemen-pasien') }}" class="nav-link {{ request()->is('manajemen-pasien*') ? 'active' : '' }}">
      <i class="bi bi-people"></i> Manajemen Pasien
    </a>
    @endif

    @if (Auth::user()->role === 'apoteker')
    <a href="{{ url('/permintaan-resep') }}" class="nav-link {{ request()->is('permintaan-resep*') ? 'active' : '' }}">
      <i class="bi bi-list-columns"></i> Permintaan Resep
    </a>
    <a href="{{ url('/stok-obat') }}" class="nav-link {{ request()->is('stok-obat*') ? 'active' : '' }}">
      <i class="bi bi-box-seam"></i> Stok Obat
    </a>
    @endif

    @if (Auth::user()->role === 'admin')
    <a href="{{ url('/manajemen-user') }}" class="nav-link {{ request()->is('manajemen-user*') ? 'active' : '' }}">
      <i class="bi bi-person-gear"></i> Manajemen User
    </a>
    @endif

    <small class="text-uppercase text-muted fw-bold px-4 mt-4 mb-2" style="font-size: 0.7rem;">Pengaturan</small>


    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
      <i class="bi bi-person-circle"></i> Profil Saya
    </a>

    <div class="mt-auto border-top p-3">
      <form method="POST" action="{{ route('logout') }}" class="w-100">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
          <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
      </form>
    </div>
  </div>
</nav>

<header class="topbar sticky-top shadow-sm">
  <button class="btn d-lg-none" id="sidebarCollapse">
    <i class="bi bi-list fs-3"></i>
  </button>

  <div class="ms-auto d-flex align-items-center gap-3">
    <div class="text-end d-none d-sm-block">
      <p class="fw-bold text-dark mb-0 small">{{ Auth::user()->name }}</p>
      <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-10" style="font-size: 0.65rem;">
        {{ strtoupper(Auth::user()->role) }}
      </span>
    </div>
    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm fw-bold" style="width: 45px; height: 45px;">
      {{ substr(Auth::user()->name, 0, 1) }}
    </div>
  </div>
</header>

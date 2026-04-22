<x-app-layout>
  <style>
    .pagination .page-item.active .page-link {
      background-color: #6610f2;
      border-color: #6610f2;
      color: white;
    }

    .pagination .page-link {
      color: #6610f2;
    }

  </style>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Manajemen Pengguna</h2>
      <p class="text-muted small mb-0">Kelola akun staf medis dan data dasar pasien di dalam sistem.</p>
    </div>
    <a href="{{ url('/manajemen-user/create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" style="background-color: #6610f2; border-color: #6610f2;">
      <i class="bi bi-person-plus-fill me-2"></i>Tambah User Baru
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <form action="{{ route('manajemen-user.index') }}" method="GET" class="row g-2 align-items-center">

        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0">
              <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari nama pengguna atau email..." value="{{ request('search') }}">
          </div>
        </div>

        <div class="col-md-4">
          <select name="role" class="form-select border-0 bg-light rounded-3 shadow-none small">
            <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="dokter" {{ request('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
            <option value="apoteker" {{ request('role') == 'apoteker' ? 'selected' : '' }}>Apoteker</option>
            <option value="pasien" {{ request('role') == 'pasien' ? 'selected' : '' }}>Pasien</option>
          </select>
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-dark w-100 rounded-3">Cari</button>
        </div>

        @if(request('search') || (request('role') && request('role') != 'all'))
        <a href="{{ route('manajemen-user.index') }}" class="btn btn-outline-danger px-3 rounded-3" title="Hapus Filter">
          <i class="bi bi-x-lg"></i>
        </a>
        @endif
      </form>
    </div>
  </div>


  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">Pengguna</th>
            <th class="border-0 text-muted small text-uppercase">Kontak</th>
            <th class="border-0 text-muted small text-uppercase">Role</th>
            <th class="border-0 text-muted small text-uppercase">Terdaftar</th>
            <th class="border-0 text-muted small text-uppercase">Info Spesifik</th>
            <th class="border-0 text-muted small text-uppercase">Login Terakhir</th>
            <th class="border-0 text-muted small text-uppercase text-end pe-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr>
            <td class="ps-4 py-3">
              <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff" class="rounded-circle me-3" width="40">
                <div>
                  <h6 class="mb-0 fw-bold text-dark">{{ $user->name }}</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="small fw-medium text-dark">{{ $user->email }}</div>
            </td>
            <td>
              @php
              $badgeColor = match($user->role) {
              'admin' => 'bg-indigo bg-opacity-10',
              'dokter' => 'bg-primary bg-opacity-10 text-primary',
              'apoteker' => 'bg-info bg-opacity-10 text-info',
              'pasien' => 'bg-success bg-opacity-10 text-success',
              default => 'bg-secondary bg-opacity-10 text-secondary'
              };
              $badgeIcon = match($user->role) {
              'admin' => 'bi-shield-lock',
              'dokter' => 'bi-mortarboard',
              'apoteker' => 'bi-capsule',
              'pasien' => 'bi-people',
              default => 'bi-person'
              };
              $isAdmin = $user->role === "admin";
              @endphp

              <span class="badge {{ $badgeColor }} px-3 py-2 rounded-pill small text-capitalize" @if($user->role === 'admin') style="color: #6610f2; background-color: rgba(102, 16, 242, 0.1);" @endif>
                <i class="bi {{ $badgeIcon }} me-1"></i> {{ $user->role }}
              </span>
            </td>
            <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
            <td>
              @if ($user->role === 'dokter' && $user->dokter)
              <span class="text-muted d-block small">{{ $user->dokter->poli }}</span>
              @elseif ($user->role === 'pasien' && $user->pasien)
              <div class="small">
                <span class="text-muted d-block">NIK: {{ $user->pasien->nik }}</span>
                <span class="text-muted d-block">
                  L/P: {{ $user->pasien->jenis_kelamin }} | Lahir: {{ \Carbon\Carbon::parse($user->pasien->tanggal_lahir)->format('d M Y') }}
                </span>
              </div>
              @else
              <span class="text-muted fst-italic">-</span>
              @endif
            </td>
            <td class="small text-muted">
              {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum ada aktivitas login' }}
            </td>
            <td class="text-start pe-4">
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ url('/manajemen-user/'.$user->id.'/edit') }}" class="btn btn-sm btn-light rounded-circle shadow-sm border" title="Edit Akun">
                  <i class="bi bi-pencil-square text-warning"></i>
                </a>
                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalHapusUser{{ $user->id }}" title="Hapus Akun">
                  <i class="bi bi-trash text-danger"></i>
                </button>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalHapusUser{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
              <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-body p-4 text-center">
                  <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
                  </div>
                  <h5 class="fw-bold text-dark">Hapus Akun Pengguna?</h5>
                  <p class="text-muted small">Tindakan ini akan menghapus akses pengguna <strong>{{ $user->name }}</strong> ke dalam sistem secara permanen. Data rekam medis atau resep yang terkait mungkin akan tetap tersimpan sebagai arsip.</p>

                  <div class="d-flex flex-column gap-2 align-items-center mt-4">
                    <form action="{{ route('manajemen-user.destroy', $user->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">
                        Ya, Hapus Akun
                      </button>
                    </form>
                    <button type="button" class="btn btn-link btn-sm text-muted" style="width: fit-content;" data-bs-dismiss="modal">Batal</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white border-top-0 py-3">
      {{ $users->links('pagination::bootstrap-5') }}
    </div>
  </div>

</x-app-layout>

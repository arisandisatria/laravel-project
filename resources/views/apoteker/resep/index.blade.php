<x-app-layout>
  <div class="d-flex justify-content-between align-items-start mb-2">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Permintaan Resep</h2>
      <p class="text-muted small">Kelola antrean dan pantau riwayat penyerahan obat.</p>
    </div>
    <div class="bg-white p-2 rounded-pill shadow-sm px-3 border">
      <small class="fw-bold text-primary"><i class="bi bi-clock-history me-1"></i> Antrean: {{ $totalAntrean }} Resep</small>
    </div>
  </div>

  <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border">
    <li class="nav-item">
      <a class="nav-link {{ $tab === 'aktif' ? 'active' : '' }} rounded-pill px-4" href="{{ route('permintaan-resep.index', ['tab' => 'aktif']) }}">
        <i class="bi bi-hourglass-split me-1"></i>Antrean Aktif
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $tab === 'selesai' ? 'active' : '' }} rounded-pill px-4" href="{{ route('permintaan-resep.index', ['tab' => 'selesai']) }}">
        <i class="bi bi-check-all me-1"></i>Riwayat Selesai
      </a>
    </li>
  </ul>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <form action="{{ route('permintaan-resep.index') }}" method="GET" class="row g-2 align-items-center justify-content-between">
        <input type="hidden" name="tab" value="{{ $tab }}">

        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari nama pasien atau kode resep..." value="{{ request('search') }}">
          </div>
        </div>
        <div class="col-md-4">
          <select name="urgensi" class="form-select border-0 bg-light rounded-3 shadow-none small">
            <option value="Semua Urgensi" {{ request('urgensi') == 'Semua Urgensi' ? 'selected' : '' }}>Semua Urgensi</option>
            <option value="Segera (Cito)" {{ request('urgensi') == 'Segera (Cito)' ? 'selected' : '' }}>Segera (Cito)</option>
            <option value="Normal" {{ request('urgensi') == 'Normal' ? 'selected' : '' }}>Normal</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-dark w-100 rounded-3">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">Waktu Masuk</th>
            <th class="border-0 text-muted small text-uppercase">Kode Resep</th>
            <th class="border-0 text-muted small text-uppercase">Pasien</th>
            <th class="border-0 text-muted small text-uppercase">Dokter</th>
            <th class="border-0 text-muted small text-uppercase">Status</th>
            <th class="border-0 text-muted small text-uppercase text-end pe-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reseps as $resep)
          <tr>
            <td class="ps-4 py-3">
              <div class="fw-bold text-dark">{{ $resep->created_at->format('H:i') }}</div>
              <div class="small text-muted">
                {{ $resep->created_at->isToday() ? 'Hari Ini' : $resep->created_at->format('d M Y') }}
              </div>
            </td>

            <td>
              <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-2 py-1">
                {{ $resep->kode_resep }}
              </span>
              @if($resep->urgensi === 'Segera (Cito)')
              <span class="badge bg-danger ms-1">CITO</span>
              @endif
            </td>

            <td>
              <div class="fw-bold text-dark">{{ $resep->rekamMedis->pasien->user->name ?? 'Data Kosong' }}</div>
              <div class="small text-muted">
                Umur: {{ $resep->rekamMedis->pasien ? \Carbon\Carbon::parse($resep->rekamMedis->pasien->tanggal_lahir)->age : '-' }} Thn
              </div>
            </td>

            <td>
              <div class="fw-medium text-dark">{{ $resep->rekamMedis->dokter->user->name ?? 'Data Kosong' }}</div>
            </td>

            <td>
              @if ($resep->status === 'Menunggu')
              <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill small">
                <i class="bi bi-hourglass-split me-1"></i> Menunggu
              </span>
              @elseif ($resep->status === 'Diproses' || $resep->status === 'Disiapkan')
              <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill small">
                <i class="bi bi-box-seam me-1"></i> {{ $resep->status }}
              </span>
              @elseif ($resep->status === 'Selesai')
              <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill small">
                <i class="bi bi-check-circle me-1"></i> Selesai
              </span>
              @endif
            </td>

            <td class="text-end pe-4">
              @if ($resep->status === 'Menunggu')
              <a href="{{ url('/permintaan-resep/proses/'.$resep->id) }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm">
                Proses Obat
              </a>
              @elseif ($resep->status === 'Diproses' || $resep->status === 'Disiapkan')
              <a href="{{ url('/permintaan-resep/proses/'.$resep->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                Lanjutkan
              </a>
              @elseif ($resep->status === 'Selesai')
              <a href="{{ url('/permintaan-resep/proses/'.$resep->id) }}" class="btn btn-light border btn-sm rounded-pill px-3 fw-bold text-muted">
                Lihat Detail
              </a>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-5 text-muted">
              <i class="bi bi-inbox fs-2 d-block text-muted"></i>
              Belum ada data resep.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($reseps->hasPages())
    <div class="card-footer bg-white border-top py-3">
      {{ $reseps->links('pagination::bootstrap-5') }}
    </div>
    @endif
  </div>
</x-app-layout>

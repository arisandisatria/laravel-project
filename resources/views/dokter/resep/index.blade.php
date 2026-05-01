<x-app-layout>
  <style>
    .table tbody tr {
      transition: all 0.2s;
    }

    .table tbody tr:hover {
      background-color: rgba(13, 110, 253, 0.02);
    }

  </style>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Kelola Resep</h2>
      <p class="text-muted small mb-0">Kelola dan pantau status resep yang telah Anda terbitkan.</p>
    </div>
    <a href="{{ url('/kelola-resep/create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
      <i class="bi bi-plus-lg me-2"></i>Buat Resep Baru
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <form action="{{ route('dokter.resep.index') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-md-4">
          <div class="input-group gap-2">
            <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 rounded-3 shadow-none" placeholder="Cari nama pasien atau ID resep...">
          </div>
        </div>
        <div class="col-md-3">
          <select name="status" class="form-select border-0 bg-light rounded-3 shadow-none small">
            <option {{ request('status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
            <option {{ request('status') == 'Menunggu Obat' ? 'selected' : '' }}>Menunggu Obat</option>
            <option {{ request('status') == 'Siap Diambil' ? 'selected' : '' }}>Siap Diambil</option>
            <option {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control border-0 bg-light rounded-3 shadow-none small">
        </div>
        <div class="col-md-2 d-flex gap-2">
          <button type="submit" class="btn btn-dark w-100 rounded-3 small">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">ID Resep</th>
            <th class="border-0 text-muted small text-uppercase">Pasien</th>
            <th class="border-0 text-muted small text-uppercase">Tanggal & Waktu</th>
            <th class="border-0 text-muted small text-uppercase">Status</th>
            <th class="border-0 text-muted small text-uppercase text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rekamMedis as $rm)
          @php
          $firstResep = $rm->reseps->first();
          @endphp
          <tr>
            <td class="ps-4">
              <span class="fw-bold text-primary">{{ $firstResep->kode_resep ?? '#RSP-'.$rm->id }}</span>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" class="rounded-circle me-2" width="32">
                <div>
                  <h6 class="mb-0 fw-bold small">{{ $rm->pasien->user->name }}</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">{{ $rm->pasien->jenis_kelamin }}, {{ \Carbon\Carbon::parse($rm->pasien->tanggal_lahir)->age }} Thn</small>
                </div>
              </div>
            </td>
            <td>
              <div class="small fw-medium text-dark">{{ $rm->created_at->format('d F Y') }}</div>
              <small class="text-muted">{{ $rm->created_at->format('H:i') }} WIB</small>
            </td>
            <td>
              @if($firstResep->status === 'Menunggu')
              <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill small"><i class="bi bi-hourglass-split me-1"></i> Menunggu Obat</span>
              @elseif($firstResep->status === 'Diproses')
              <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill small"><i class="bi bi-gear-fill me-1"></i> Sedang Diramu</span>
              @elseif($firstResep->status === 'Disiapkan')
              <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small"><i class="bi bi-bag-check me-1"></i> Siap Diambil</span>
              @else
              <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill small"><i class="bi bi-check-circle me-1"></i> Selesai</span>
              @endif
            </td>
            <td class="text-center">
              @if($firstResep->status === 'Selesai')
              <div class="text-muted small"><em>Tidak ada aksi</em></div>
              @else
              <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalLihatResep-{{ $rm->id }}" title="Lihat Detail">
                  <i class="bi bi-eye text-primary"></i>
                </button>
                <a href="{{ route('dokter.resep.edit', $rm->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm border" title="Edit Resep">
                  <i class="bi bi-pencil-square text-warning"></i>
                </a>
                <button class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalHapusResep-{{ $rm->id }}" title="Hapus">
                  <i class="bi bi-trash text-danger"></i>
                </button>
              </div>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-5 text-muted">Belum ada resep yang diterbitkan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white border-top-0 py-3">
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $rekamMedis->firstItem() ?? 0 }} - {{ $rekamMedis->lastItem() ?? 0 }} dari {{ $rekamMedis->total() }} resep</small>
        <nav>
          {{ $rekamMedis->links('pagination::bootstrap-5') }}
        </nav>
      </div>
    </div>
  </div>

  @foreach($rekamMedis as $rm)
  <div class="modal fade" id="modalLihatResep-{{ $rm->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-0 pt-4 px-4">
          <h5 class="fw-bold mb-0">Detail Resep {{ $rm->reseps->first()->kode_resep ?? '' }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4">
          <div class="mb-3">
            <small class="text-muted d-block">Pasien:</small>
            <span class="fw-bold">{{ $rm->pasien->user->name }} ({{ $rm->pasien->jenis_kelamin }}, {{ \Carbon\Carbon::parse($rm->pasien->tanggal_lahir)->age }} Thn)</span>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Diagnosa:</small>
            <p class="small bg-light p-2 rounded">{{ $rm->diagnosa }}</p>
          </div>
          <h6 class="fw-bold small mb-2 text-uppercase text-muted">Daftar Obat</h6>
          <ul class="list-group list-group-flush border rounded-3 mb-4">
            @foreach($rm->reseps as $resep)
            <li class="list-group-item d-flex justify-content-between align-items-center small p-3">
              <div>
                <strong>{{ $resep->obat->nama_obat ?? 'Obat Dihapus' }}</strong>
                <div class="text-muted">{{ $resep->aturan }}</div>
              </div>
              <span class="badge bg-primary rounded-pill">{{ $resep->jumlah }} {{ $resep->obat->satuan ?? 'Item' }}</span>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHapusResep-{{ $rm->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4 text-center">
        <div class="modal-body p-4">
          <div class="text-danger mb-3">
            <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
          </div>
          <h5 class="fw-bold">Hapus Resep?</h5>
          <p class="text-muted small">Data resep ini akan dihapus permanen dari sistem.</p>
          <form action="{{ route('dokter.resep.destroy', $rm->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column gap-2 align-items-center mt-4">
              <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">Ya, Hapus Resep</button>
              <button type="button" class="btn btn-link btn-sm text-muted" style="width: fit-content;" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</x-app-layout>

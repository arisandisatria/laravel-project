<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengobatan</h2>
    <p class="text-muted">Kelola jadwal konsumsi obat harian dan pantau progress pemulihan Anda.</p>
  </div>

  <div class="d-flex gap-2 mb-4 bg-white p-2 rounded-pill shadow-sm" style="width: fit-content;">
    <a href="{{ route('pasien.jadwal') }}" class="btn btn-light bg-transparent border-0 rounded-pill px-4 text-muted fw-medium hover-bg-light">
      <i class="bi bi-calendar2-check me-2"></i>Jadwal
    </a>
    <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm">
      <i class="bi bi-clock-history me-2"></i>Riwayat Resep
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-9">
      <form action="{{ route('pasien.riwayat-resep') }}" method="GET" class="mb-4">
        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border border-light-subtle">
          <span class="input-group-text bg-transparent border-0 text-muted ps-4"><i class="bi bi-search"></i></span>
          <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 shadow-none py-2" placeholder="Cari nama obat, diagnosa, atau nama dokter...">
          <button class="btn btn-primary px-4 fw-bold" type="submit">Cari Riwayat</button>

          @if(request('search'))
          <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-light px-3 border-start text-danger" title="Reset Pencarian">
            <i class="bi bi-x-lg"></i>
          </a>
          @endif
        </div>
      </form>


      @forelse($riwayatRekamMedis as $rm)
      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom border-light pt-4 pb-3 px-4 d-flex justify-content-between align-items-center rounded-top-4">
          <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
              <i class="bi bi-file-medical fs-5"></i>
            </div>
            <div>
              <h6 class="fw-bold mb-0 text-dark">{{ $rm->created_at->format('d F Y') }}</h6>
              <small class="text-muted">ID: #RM-{{ str_pad($rm->id, 4, '0', STR_PAD_LEFT) }}</small>
            </div>
          </div>
          <button type="button" class="btn btn-sm btn-light rounded-pill px-4 fw-medium border shadow-sm text-primary" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $rm->id }}">
            Lihat E-Resep
          </button>
        </div>

        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-5 border-end border-light">
              <span class="small text-muted d-block mb-1">Tenaga Medis:</span>
              <div class="fw-bold text-dark small mb-3"><i class="bi bi-person-badge text-primary me-1"></i> {{ $rm->dokter->user->name }}</div>

              <span class="small text-muted d-block mb-1">Diagnosa Utama:</span>
              <p class="mb-0 text-dark small fw-medium">{{ $rm->diagnosa ?? $rm->keluhan_utama }}</p>
            </div>
            <div class="col-md-7 ps-md-4 mt-3 mt-md-0">
              <span class="small text-muted d-block mb-2">Obat yang Diresepkan:</span>
              <div class="d-flex flex-wrap gap-2">
                @foreach($rm->reseps as $resep)
                <div class="bg-light p-2 rounded-3 border border-light-subtle d-flex flex-column flex-fill" style="min-width: 150px;">
                  <span class="fw-bold text-dark small mb-1">{{ optional($resep->obat)->nama_obat ?? 'Obat Dihapus' }}</span>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="text-muted" style="font-size: 0.65rem;">{{ $resep->aturan }}</span>
                    <span class="badge bg-white text-dark border border-secondary-subtle" style="font-size: 0.65rem;">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="card border-0 shadow-sm rounded-4 text-center py-5">
        <i class="bi bi-inbox fs-1 text-muted d-block mb-2 opacity-50"></i>
        <h6 class="fw-bold text-dark mb-1">Arsip Kosong</h6>
        <p class="small text-muted mb-0">Anda belum memiliki riwayat pemeriksaan atau resep medis.</p>
      </div>
      @endforelse

      @if($riwayatRekamMedis->hasPages())
      <div class="mt-4">
        {{ $riwayatRekamMedis->links('pagination::bootstrap-5') }}
      </div>
      @endif
    </div>

    <div class="col-lg-3">
      <div class="card shadow-sm border-0 rounded-4 bg-primary text-white mb-4 position-relative overflow-hidden">
        <div class="position-absolute end-0 bottom-0 opacity-25 p-3">
          <i class="bi bi-shield-lock opacity-5" style="font-size: 5rem;"></i>
        </div>
        <div class="card-body p-4 position-relative z-1">
          <h6 class="fw-bold mb-3"><i class="bi bi-shield-check me-2"></i>Privasi Data</h6>
          <p class="small text-white-50 mb-0" style="line-height: 1.6;">Seluruh riwayat medis dan resep obat Anda disimpan menggunakan enkripsi tingkat lanjut (IITEA Standard) dan hanya dapat diakses oleh Anda dan tenaga medis yang menangani Anda.</p>
        </div>
      </div>
    </div>
  </div>

  @foreach($riwayatRekamMedis as $rm)
  <div class="modal fade" id="modalDetail-{{ $rm->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg rounded-4">
        <div class="modal-body p-5">
          <div class="text-center mb-4">
            <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-heart-pulse-fill me-2"></i>KLINIK OBATKU</h5>
            <p class="small text-muted mb-0">Jl. Teknologi Medis No. 12, Jember</p>
            <hr class="border-2 opacity-50 mt-3">
          </div>

          <div class="d-flex justify-content-between mb-3 small">
            <div>
              <span class="text-muted d-block">Dokter:</span>
              <span class="fw-bold text-dark">{{ $rm->dokter->user->name }}</span>
            </div>
            <div class="text-end">
              <span class="text-muted d-block">Tanggal:</span>
              <span class="fw-bold text-dark">{{ $rm->created_at->format('d F Y') }}</span>
            </div>
          </div>

          <div class="mb-4 small">
            <span class="text-muted d-block">Diagnosa:</span>
            <span class="fw-bold text-dark">{{ $rm->diagnosa ?? $rm->keluhan_utama }}</span>
          </div>

          <div class="bg-light p-3 rounded-4 mb-4 border border-light-subtle">
            <h6 class="small fw-bold border-bottom pb-2 mb-3 text-uppercase text-muted" style="letter-spacing: 0.5px;">Daftar Obat</h6>
            <ul class="list-unstyled mb-0">
              @foreach($rm->reseps as $resep)
              <li class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                <div>
                  <span class="small fw-bold text-dark d-block">{{ optional($resep->obat)->nama_obat }}</span>
                  <span class="text-muted" style="font-size: 0.7rem;">{{ $resep->aturan }}</span>
                </div>
                <span class="badge bg-primary rounded-pill">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="d-flex flex-column justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="window.print()">
              <i class="bi bi-printer me-2"></i>Cetak PDF
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

</x-app-layout>

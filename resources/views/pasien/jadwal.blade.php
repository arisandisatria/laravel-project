<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengobatan</h2>
    <p class="text-muted">Kelola jadwal konsumsi obat harian dan pantau progress pemulihan Anda.</p>
  </div>

  <div class="d-flex gap-2 mb-4 bg-white p-2 rounded-pill shadow-sm" style="width: fit-content;">
    <a href="{{ route('pasien.jadwal') }}" class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm">
      <i class="bi bi-calendar2-check me-2"></i>Jadwal
    </a>
    <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-light bg-transparent border-0 rounded-pill px-4 text-muted fw-medium hover-bg-light">
      <i class="bi bi-clock-history me-2"></i>Riwayat Resep
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between align-items-end mb-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-alarm me-2 text-primary"></i>Perlu Diminum Hari Ini</h6>
        <span class="text-muted small">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</span>
      </div>

      @forelse($resepAktif as $resep)
      @php
      preg_match('/(\d+)\s*[xX]\s*\d+/', $resep->aturan, $matches);
      $dosisHarian = isset($matches[1]) && (int)$matches[1] > 0 ? (int)$matches[1] : 1;

      $tampilPagi = in_array($dosisHarian, [1, 2, 3]);
      $tampilSiang = in_array($dosisHarian, [3]);
      $tampilMalam = in_array($dosisHarian, [2, 3]);

      $sudahPagi = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Pagi')->isNotEmpty();
      $sudahSiang = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Siang')->isNotEmpty();
      $sudahMalam = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Malam')->isNotEmpty();

      $jumlahObat = $resep->jumlah > 0 ? $resep->jumlah : 1;
      $durasiHari = ceil($jumlahObat / $dosisHarian);


      $hariKe = \Carbon\Carbon::parse($resep->created_at)->startOfDay()->diffInDays(\Carbon\Carbon::today()) + 1;
      $persenProgress = min(100, ($hariKe / $durasiHari) * 100);
      $sisaHari = max(0, $durasiHari - $hariKe);
      @endphp

      <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4">

          <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
              <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-2 py-1 small mb-2">
                <i class="bi bi-capsule me-1"></i> {{ $resep->aturan }}
              </span>
              <h5 class="fw-bold mb-1 text-dark">{{ optional($resep->obat)->nama_obat ?? 'Obat' }}</h5>
              <p class="small text-muted mb-0">Total: {{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</p>
            </div>
            <div class="text-end">
              <span class="small text-muted d-block">Sisa Durasi</span>
              @if($sisaHari > 0)
              <span class="fw-bold text-primary">{{ $sisaHari }} Hari Lagi</span>
              @else
              <span class="badge bg-danger">Hari Terakhir!</span>
              @endif
            </div>
          </div>

          <div class="mb-4">
            <div class="d-flex justify-content-between mb-1">
              <span class="small text-muted" style="font-size: 0.75rem;">Progress Pengobatan (Hari {{ $hariKe }} dari {{ $durasiHari }})</span>
              <span class="small fw-bold text-dark" style="font-size: 0.75rem;">{{ round($persenProgress) }}%</span>
            </div>
            <div class="progress rounded-pill" style="height: 8px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: {{ $persenProgress }}%"></div>
            </div>
          </div>

          <div class="row g-3">
            @if($tampilPagi)
            <div class="col-md-{{ 12 / $dosisHarian }}">
              @if($sudahPagi)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 p-3 text-center h-100 d-flex flex-column justify-content-center">
                <i class="bi bi-check-circle-fill fs-4 mb-1"></i>
                <h6 class="fw-bold mb-0 small">Pagi (07:00)</h6>
                <small style="font-size: 0.7rem;">Sudah Diminum</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Pagi">
                <button type="submit" class="btn btn-outline-success border-success-subtle w-100 p-3 rounded-4 text-center h-100 transition-hover">
                  <i class="bi bi-brightness-alt-high fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0 small">Pagi (07:00)</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

            @if($tampilSiang)
            <div class="col-md-{{ 12 / $dosisHarian }}">
              @if($sudahSiang)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 p-3 text-center h-100 d-flex flex-column justify-content-center">
                <i class="bi bi-check-circle-fill fs-4 mb-1"></i>
                <h6 class="fw-bold mb-0 small">Siang (13:00)</h6>
                <small style="font-size: 0.7rem;">Sudah Diminum</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Siang">
                <button type="submit" class="btn btn-outline-success border-success-subtle w-100 p-3 rounded-4 text-center h-100 transition-hover">
                  <i class="bi bi-sun fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0 small">Siang (13:00)</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

            @if($tampilMalam)
            <div class="col-md-{{ 12 / $dosisHarian }}">
              @if($sudahMalam)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 p-3 text-center h-100 d-flex flex-column justify-content-center">
                <i class="bi bi-check-circle-fill fs-4 mb-1"></i>
                <h6 class="fw-bold mb-0 small">Malam (20:00)</h6>
                <small style="font-size: 0.7rem;">Sudah Diminum</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Malam">
                <button type="submit" class="btn btn-outline-success border-success-subtle w-100 p-3 rounded-4 text-center h-100 transition-hover">
                  <i class="bi bi-moon-stars fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0 small">Malam (20:00)</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

          </div>
        </div>
      </div>
      @empty
      <div class="card border-0 shadow-sm rounded-4 text-center py-5">
        <div class="mb-3"><i class="bi bi-emoji-smile fs-1 text-primary opacity-50"></i></div>
        <h6 class="fw-bold text-dark">Tidak Ada Jadwal</h6>
        <p class="text-muted small mb-0">Anda tidak memiliki resep obat yang harus diminum hari ini.</p>
      </div>
      @endforelse
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h6 class="fw-bold mb-0"><i class="bi bi-clipboard2-pulse me-2 text-primary"></i>Log Harian Anda</h6>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush mt-2">
            @forelse($logRiwayat as $log)
            <li class="list-group-item border-0 px-4 py-3 border-bottom border-light">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="fw-bold mb-1 text-dark small">{{ optional($log->resep->obat)->nama_obat }}</h6>
                  <span class="text-muted" style="font-size: 0.7rem;">
                    <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($log->tanggal)->format('d M') }} •
                    <span class="fw-medium text-primary">{{ $log->waktu }}</span>
                  </span>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.7rem;">
                  <i class="bi bi-check2"></i> Selesai
                </span>
              </div>
            </li>
            @empty
            <li class="list-group-item border-0 text-center py-5">
              <p class="text-muted small mb-0">Belum ada catatan.</p>
            </li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>

  <style>
    .transition-hover {
      transition: all 0.2s ease;
    }

    .transition-hover:hover {
      background-color: rgba(25, 135, 84, 0.05);
      transform: translateY(-2px);
    }

  </style>
</x-app-layout>

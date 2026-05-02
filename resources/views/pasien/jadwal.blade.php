<x-app-layout>

  <style>
    .transition-hover {
      transition: all 0.2s ease;
    }

    .transition-hover:hover {
      transform: translateY(-2px);
    }

    .btn-outline-danger.transition-hover:hover {
      background-color: rgba(220, 53, 69, 0.1) !important;
      color: #dc3545 !important;
    }

    .btn-outline-primary.transition-hover:hover {
      background-color: rgba(13, 110, 253, 0.1) !important;
      color: #0d6efd !important;
    }

  </style>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengobatan</h2>
    <p class="text-muted">Kelola jadwal konsumsi obat harian dan pantau progress pemulihan Anda.</p>
  </div>

  <div class="d-flex flex-wrap mx-auto mx-md-0 gap-2 mb-4 bg-white p-2 rounded-4 shadow-sm" style="width: fit-content;">
    <a href="{{ route('pasien.jadwal') }}" class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm flex-grow-1 text-center">
      <i class="bi bi-calendar2-check me-2"></i>Jadwal
    </a>
    <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-light bg-transparent border-0 rounded-pill px-4 text-muted fw-medium hover-bg-light flex-grow-1 text-center">
      <i class="bi bi-clock-history me-2"></i>Riwayat Resep
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-end mb-3 gap-1">
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

      $jamSekarang = \Carbon\Carbon::now()->hour;
      @endphp

      <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-3 p-md-4">

          <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-3 gap-2">
            <div>
              <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-2 py-1 small mb-2">
                <i class="bi bi-capsule me-1"></i> {{ $resep->aturan }}
              </span>
              <h5 class="fw-bold mb-1 text-dark">{{ optional($resep->obat)->nama_obat ?? 'Obat' }}</h5>
              <p class="small text-muted mb-0">Total: {{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</p>
            </div>
            <div class="text-start text-sm-end mt-2 mt-sm-0">
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

          <div class="row g-2">

            @if($tampilPagi)
            <div class="col-{{ 12 / $dosisHarian }}">
              @if($sudahPagi)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1">
                <i class="bi bi-check-circle-fill fs-4 mb-0"></i>
                <div>
                  <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Pagi</h6>
                  <small style="font-size: 0.65rem;">Selesai</small>
                </div>
              </div>
              @elseif($jamSekarang < 6) <div class="border border-secondary bg-light text-secondary rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1" style="opacity: 0.6; cursor: not-allowed;">
                <i class="bi bi-lock-fill fs-4 mb-0"></i>
                <div>
                  <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Pagi</h6>
                  <small style="font-size: 0.65rem;">Belum Waktunya</small>
                </div>
            </div>
            @elseif($jamSekarang > 10)
            <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
              @csrf
              <input type="hidden" name="resep_id" value="{{ $resep->id }}">
              <input type="hidden" name="waktu" value="Pagi">
              <button type="submit" class="btn btn-outline-danger border-danger-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover d-flex flex-column justify-content-center align-items-center text-center gap-1">
                <i class="bi bi-exclamation-triangle fs-4 mb-0"></i>
                <div>
                  <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Pagi</h6>
                  <small style="font-size: 0.65rem; line-height: 1.1;" class="d-block mt-1">Terlewati<br>(Tetap Minum)</small>
                </div>
              </button>
            </form>
            @else
            <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
              @csrf
              <input type="hidden" name="resep_id" value="{{ $resep->id }}">
              <input type="hidden" name="waktu" value="Pagi">
              <button type="submit" class="btn btn-outline-primary border-primary-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover pulse-alert d-flex flex-column justify-content-center align-items-center text-center gap-1">
                <i class="bi bi-brightness-alt-high fs-4 mb-0"></i>
                <div>
                  <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Pagi</h6>
                  <small class="fw-bold" style="font-size: 0.65rem;">Minum!</small>
                </div>
              </button>
            </form>
            @endif
          </div>
          @endif

          @if($tampilSiang)
          <div class="col-{{ 12 / $dosisHarian }}">
            @if($sudahSiang)
            <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1">
              <i class="bi bi-check-circle-fill fs-4 mb-0"></i>
              <div>
                <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Siang</h6>
                <small style="font-size: 0.65rem;">Selesai</small>
              </div>
            </div>
            @elseif($jamSekarang < 11) <div class="border border-secondary bg-light text-secondary rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1" style="opacity: 0.6; cursor: not-allowed;">
              <i class="bi bi-lock-fill fs-4 mb-0"></i>
              <div>
                <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Siang</h6>
                <small style="font-size: 0.65rem;">Belum Waktunya</small>
              </div>
          </div>
          @elseif($jamSekarang > 15)
          <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
            @csrf
            <input type="hidden" name="resep_id" value="{{ $resep->id }}">
            <input type="hidden" name="waktu" value="Siang">
            <button type="submit" class="btn btn-outline-danger border-danger-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover d-flex flex-column justify-content-center align-items-center text-center gap-1">
              <i class="bi bi-exclamation-triangle fs-4 mb-0"></i>
              <div>
                <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Siang</h6>
                <small style="font-size: 0.65rem; line-height: 1.1;" class="d-block mt-1">Terlewati<br>(Tetap Minum)</small>
              </div>
            </button>
          </form>
          @else
          <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
            @csrf
            <input type="hidden" name="resep_id" value="{{ $resep->id }}">
            <input type="hidden" name="waktu" value="Siang">
            <button type="submit" class="btn btn-outline-primary border-primary-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover pulse-alert d-flex flex-column justify-content-center align-items-center text-center gap-1">
              <i class="bi bi-sun fs-4 mb-0"></i>
              <div>
                <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Siang</h6>
                <small class="fw-bold" style="font-size: 0.65rem;">Minum!</small>
              </div>
            </button>
          </form>
          @endif
        </div>
        @endif

        @if($tampilMalam)
        <div class="col-{{ 12 / $dosisHarian }}">
          @if($sudahMalam)
          <div class="border border-success bg-success bg-opacity-10 text-success rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1">
            <i class="bi bi-check-circle-fill fs-4 mb-0"></i>
            <div>
              <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Malam</h6>
              <small style="font-size: 0.65rem;">Selesai</small>
            </div>
          </div>
          @elseif($jamSekarang < 18) <div class="border border-secondary bg-light text-secondary rounded-4 px-1 py-2 p-md-3 h-100 d-flex flex-column justify-content-center align-items-center text-center gap-1" style="opacity: 0.6; cursor: not-allowed;">
            <i class="bi bi-lock-fill fs-4 mb-0"></i>
            <div>
              <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Malam</h6>
              <small style="font-size: 0.65rem;">Belum Waktunya</small>
            </div>
        </div>
        @elseif($jamSekarang > 23)
        <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
          @csrf
          <input type="hidden" name="resep_id" value="{{ $resep->id }}">
          <input type="hidden" name="waktu" value="Malam">
          <button type="submit" class="btn btn-outline-danger border-danger-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover d-flex flex-column justify-content-center align-items-center text-center gap-1">
            <i class="bi bi-exclamation-triangle fs-4 mb-0"></i>
            <div>
              <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Malam</h6>
              <small style="font-size: 0.65rem; line-height: 1.1;" class="d-block mt-1">Terlewati<br>(Tetap Minum)</small>
            </div>
          </button>
        </form>
        @else
        <form action="{{ route('pasien.jadwal.tandai') }}" method="POST" class="h-100">
          @csrf
          <input type="hidden" name="resep_id" value="{{ $resep->id }}">
          <input type="hidden" name="waktu" value="Malam">
          <button type="submit" class="btn btn-outline-primary border-primary-subtle w-100 px-1 py-2 p-md-3 rounded-4 h-100 transition-hover pulse-alert d-flex flex-column justify-content-center align-items-center text-center gap-1">
            <i class="bi bi-moon-stars fs-4 mb-0"></i>
            <div>
              <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Malam</h6>
              <small class="fw-bold" style="font-size: 0.65rem;">Minum!</small>
            </div>
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
        <ul class="list-group list-group-flush mt-3">
          @forelse($logRiwayat as $log)
          @php
          $jamKonsumsi = \Carbon\Carbon::parse($log->created_at)->hour;
          $isTerlewati = false;

          if ($log->waktu === 'Pagi' && $jamKonsumsi > 10) {
          $isTerlewati = true;
          } elseif ($log->waktu === 'Siang' && $jamKonsumsi > 15) {
          $isTerlewati = true;
          } elseif ($log->waktu === 'Malam' && $jamKonsumsi > 23) {
          $isTerlewati = true;
          }
          @endphp

          <li class="list-group-item border-0 px-4 py-2 border-bottom border-light">
            <div class="d-flex flex-row justify-content-between align-items-start align-items-sm-center gap-md-2">
              <div>
                <h6 class="fw-bold mb-1 text-dark small">{{ optional($log->resep->obat)->nama_obat }}</h6>
                <span class="text-muted" style="font-size: 0.7rem;">
                  <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($log->tanggal)->format('d M') }} •
                  <span class="fw-medium text-primary">{{ $log->waktu }}</span>
                </span>
              </div>

              @if($isTerlewati)
              <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2" style="font-size: 0.7rem;">
                <i class="bi bi-exclamation-triangle"></i> Terlewati
              </span>
              @else
              <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.7rem;">
                <i class="bi bi-check2"></i> Tepat Waktu
              </span>
              @endif
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

</x-app-layout>

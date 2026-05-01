<x-app-layout>

  @php
  $jadwalPagi = []; $jadwalSiang = []; $jadwalMalam = [];
  $targetMingguan = 15;
  $logsThisWeek = 0;
  $tepatWaktu = 0; $terlambat = 0; $terlewati = 0;

  if($rmTerakhir && $rmTerakhir->reseps->isNotEmpty()) {
  foreach($rmTerakhir->reseps as $resep) {
  preg_match('/(\d+)\s*[xX]\s*\d+/', $resep->aturan, $matches);
  $dosis = isset($matches[1]) && (int)$matches[1] > 0 ? (int)$matches[1] : 1;

  if($dosis >= 1) $jadwalPagi[] = $resep;
  if($dosis >= 3) $jadwalSiang[] = $resep;
  if($dosis >= 2) $jadwalMalam[] = $resep;
  }

  $logHariIni = \App\Models\LogKonsumsi::where('pasien_id', $rmTerakhir->pasien_id)
  ->where('tanggal', \Carbon\Carbon::today()->toDateString())
  ->get();

  $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->toDateString();
  $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->toDateString();
  $logMingguan = \App\Models\LogKonsumsi::where('pasien_id', $rmTerakhir->pasien_id)
  ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
  ->get();

  $logsThisWeek = $logMingguan->count();
  $targetMingguan = (count($jadwalPagi) + count($jadwalSiang) + count($jadwalMalam)) * 7;

  $tepatWaktu = $logsThisWeek > 0 ? $logsThisWeek - 1 : 0;
  $terlambat = $logsThisWeek > 0 ? 1 : 0;
  $terlewati = max(0, ( \Carbon\Carbon::now()->dayOfWeekIso * (count($jadwalPagi) + count($jadwalSiang) + count($jadwalMalam)) ) - $logsThisWeek);
  }

  $jamSekarang = \Carbon\Carbon::now()->hour;
  @endphp

  <style>
    .extra-small {
      font-size: 0.75rem;
    }

    .timeline {
      border-left: 2px dashed #dee2e6;
      margin-left: 35px;
      padding-left: 0;
    }

    .timeline .d-flex {
      position: relative;
    }

    .pulse-alert {
      animation: pulse-animation 2s infinite ease-in-out;
    }

    @keyframes pulse-animation {
      0% {
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
        transform: scale(1);
      }

      50% {
        box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
        transform: scale(1.05);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
        transform: scale(1);
      }
    }

    @media (max-width: 575.98px) {
      .timeline {
        margin-left: 15px;
      }

      .timeline-time {
        width: 60px !important;
      }

      .timeline-time span.badge {
        font-size: 0.7rem;
        padding: 0.3rem !important;
      }
    }

  </style>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Halo, {{ Auth::user()->name }}! 👋</h2>
    <p class="text-muted">Pantau jadwal pengobatan dan resep Anda di sini.</p>
  </div>



  <div class="row g-4">
    <div class="col-lg-8">

      <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-3 px-md-4 d-flex flex-md-row justify-content-between align-items-center gap-3">
          <h5 class="fw-bold text-primary mb-0"><i class="bi bi-alarm me-2"></i>Jadwal Hari Ini</h5>
          @if($rmTerakhir)
          <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalEResep">
            Lihat E-Resep
          </button>
          @endif
        </div>

        <div class="card-body p-3 p-md-4">
          @if($rmTerakhir && $rmTerakhir->reseps->isNotEmpty())
          <div class="timeline">

            <!-- ================= PAGI ================= -->
            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center timeline-time" style="width: 80px;">
                <span class="badge bg-info bg-opacity-10 text-info p-2 rounded-3 w-100">PAGI</span>
                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">06:00 - 10:00</small>
              </div>
              <div class="ms-2 ms-md-4 p-2 p-md-3 bg-light rounded-4 flex-grow-1 border-start border-info border-4 shadow-sm" style="min-width: 0;">
                @forelse($jadwalPagi as $resep)
                @php
                $sudah = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Pagi')->isNotEmpty();
                @endphp
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2 pb-2 gap-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                  <div>
                    <h6 class="fw-bold mb-1 text-wrap">{{ optional($resep->obat)->nama_obat }}</h6>
                    <p class="small text-muted mb-0">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }} • {{ $resep->aturan }}</p>
                  </div>
                  @if($sudah)
                  <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Sudah Diminum</span>
                  @elseif($jamSekarang > 10)
                  <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Terlewati</span>
                  @elseif($jamSekarang >= 6 && $jamSekarang <= 10) <span class="badge bg-primary text-white rounded-pill px-3 py-2 shadow-sm pulse-alert d-inline-block"><i class="bi bi-capsule me-1"></i> Waktunya Minum Obat</span>
                    @else
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i> Belum Waktunya</span>
                    @endif
                </div>
                @empty
                <p class="small text-muted mb-0">Tidak ada jadwal pagi.</p>
                @endforelse
              </div>
            </div>

            <!-- ================= SIANG ================= -->
            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center timeline-time" style="width: 80px;">
                <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-3 w-100">SIANG</span>
                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">11:00 - 15:00</small>
              </div>
              <div class="ms-2 ms-md-4 p-2 p-md-3 bg-light rounded-4 flex-grow-1 border-start border-warning border-4 shadow-sm" style="min-width: 0;">
                @forelse($jadwalSiang as $resep)
                @php
                $sudah = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Siang')->isNotEmpty();
                @endphp
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2 pb-2 gap-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                  <div>
                    <h6 class="fw-bold mb-1 text-wrap">{{ optional($resep->obat)->nama_obat }}</h6>
                    <p class="small text-muted mb-0">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }} • {{ $resep->aturan }}</p>
                  </div>
                  @if($sudah)
                  <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Sudah Diminum</span>
                  @elseif($jamSekarang > 15)
                  <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Terlewati</span>
                  @elseif($jamSekarang >= 11 && $jamSekarang <= 15) <span class="badge bg-primary text-white rounded-pill px-3 py-2 shadow-sm pulse-alert d-inline-block"><i class="bi bi-capsule me-1"></i> Waktunya Minum Obat</span>
                    @else
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i> Belum Waktunya</span>
                    @endif
                </div>
                @empty
                <p class="small text-muted mb-0">Tidak ada jadwal siang.</p>
                @endforelse
              </div>
            </div>

            <!-- ================= MALAM ================= -->
            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center timeline-time" style="width: 80px;">
                <span class="badge bg-dark bg-opacity-10 text-dark p-2 rounded-3 w-100">MALAM</span>
                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">18:00 - 23:59</small>
              </div>
              <div class="ms-2 ms-md-4 p-2 p-md-3 bg-light bg-opacity-25 rounded-4 flex-grow-1 border-start border-success border-4 shadow-sm" style="min-width: 0;">
                @forelse($jadwalMalam as $resep)
                @php
                $sudah = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Malam')->isNotEmpty();
                @endphp
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2 pb-2 gap-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                  <div>
                    <h6 class="fw-bold mb-1 text-wrap">{{ optional($resep->obat)->nama_obat }}</h6>
                    <p class="small text-muted mb-0">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }} • {{ $resep->aturan }}</p>
                  </div>
                  @if($sudah)
                  <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Sudah Diminum</span>
                  @elseif($jamSekarang > 23)
                  <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Terlewati</span>
                  @elseif($jamSekarang >= 18 && $jamSekarang <= 23) <span class="badge bg-primary text-white rounded-pill px-3 py-2 shadow-sm pulse-alert d-inline-block"><i class="bi bi-capsule me-1"></i> Waktunya Minum Obat</span>
                    @else
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i> Belum Waktunya</span>
                    @endif
                </div>
                @empty
                <p class="small text-muted mb-0">Tidak ada jadwal malam.</p>
                @endforelse
              </div>
            </div>

          </div>
          @else
          <div class="text-center py-5">
            <p class="text-muted mb-0">Anda tidak memiliki jadwal minum obat hari ini.</p>
          </div>
          @endif
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3">Progress Kepatuhan Mingguan</h6>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Senin - Minggu ini</span>
            <span class="small fw-bold text-primary">{{ $logsThisWeek }}/{{ $targetMingguan }} Selesai</span>
          </div>
          <div class="progress rounded-pill" style="height: 12px;">
            @php $persenKepatuhan = $targetMingguan > 0 ? min(100, ($logsThisWeek / $targetMingguan) * 100) : 0; @endphp
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $persenKepatuhan }}%"></div>
          </div>

          <div class="row g-2 mt-3">
            <div class="col-4">
              <div class="bg-light rounded-3 p-2 text-center border h-100">
                <small class="text-muted d-block">Tepat Waktu</small>
                <span class="fw-bold text-success">{{ $tepatWaktu }}</span>
              </div>
            </div>
            <div class="col-4">
              <div class="bg-light rounded-3 p-2 text-center border h-100">
                <small class="text-muted d-block">Terlambat</small>
                <span class="fw-bold text-warning">{{ $terlambat }}</span>
              </div>
            </div>
            <div class="col-4">
              <div class="bg-light rounded-3 p-2 text-center border h-100">
                <small class="text-muted d-block">Terlewati</small>
                <span class="fw-bold text-danger">{{ $terlewati }}</span>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 bg-primary text-white mb-4">
        <div class="card-body p-4">
          <h6 class="fw-bold">Ingin Bertanya?</h6>
          <p class="small text-white-50">Hubungi apotek kami jika Anda memiliki keraguan tentang dosis obat.</p>
          <a href="https://wa.me/628123456789" target="_blank" class="btn btn-light btn-sm w-100 fw-bold rounded-pill py-2 text-primary">
            <i class="bi bi-whatsapp me-2"></i>Hubungi Apoteker
          </a>
        </div>
      </div>

      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h5 class="fw-bold text-dark mb-0">Tips Kesehatan</h5>
        </div>
        <div class="card-body p-4 pt-2">
          <div class="d-flex align-items-start mb-3">
            <div class="text-primary me-3 fs-3"><i class="bi bi-droplet"></i></div>
            <div>
              <h6 class="fw-bold mb-1 small">Minum Air Putih</h6>
              <p class="text-muted extra-small mb-0">Pastikan minum minimal 2 liter air sehari selama masa pengobatan.</p>
            </div>
          </div>
          <div class="d-flex align-items-start">
            <div class="text-warning me-3 fs-3"><i class="bi bi-moon-stars"></i></div>
            <div>
              <h6 class="fw-bold mb-1 small">Istirahat Cukup</h6>
              <p class="text-muted extra-small mb-0">Tidur 7-8 jam membantu mempercepat proses pemulihan tubuh.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if($rmTerakhir)
  <div class="modal fade" id="modalEResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-body p-4 p-md-5">
          <div class="text-center mb-4">
            <h5 class="fw-bold mb-0">KLINIK OBATKU DIGITAL</h5>
            <p class="small text-muted">Jl. Sehat Selalu No. 123, Indonesia</p>
            <hr class="border-2 opacity-50">
          </div>

          <div class="d-flex flex-column flex-sm-row justify-content-between mb-3 small gap-2">
            <div>
              <span class="text-muted d-block">Dokter:</span>
              <span class="fw-bold">{{ $rmTerakhir->dokter->user->name }}</span>
            </div>
            <div class="text-start text-sm-end">
              <span class="text-muted d-block">Tanggal:</span>
              <span class="fw-bold">{{ $rmTerakhir->created_at->format('d F Y') }}</span>
            </div>
          </div>

          <div class="mb-4">
            <span class="text-muted small d-block">Nama Pasien:</span>
            <span class="fw-bold">{{ Auth::user()->name }}</span>
          </div>

          <div class="bg-light p-3 rounded-3 mb-4">
            <h6 class="small fw-bold border-bottom pb-2 mb-3">Daftar Obat:</h6>
            @foreach($rmTerakhir->reseps as $resep)
            <div class="d-flex flex-column flex-sm-row justify-content-between mb-2 border-bottom border-sm-0 pb-2 pb-sm-0">
              <span class="small">{{ optional($resep->obat)->nama_obat }}</span>
              <span class="fw-bold small">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
            </div>
            @endforeach
          </div>

          <div class="d-flex flex-column justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4 w-100" onclick="window.print()">
              <i class="bi bi-printer me-2"></i>Cetak PDF
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</x-app-layout>

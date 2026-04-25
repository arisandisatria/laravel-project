<x-app-layout>

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

  </style>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Halo, {{ Auth::user()->name }}! 👋</h2>
    <p class="text-muted">Pantau resep aktif dan riwayat pengobatan Anda di sini.</p>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">

      <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
          <h5 class="fw-bold text-primary mb-0"><i class="bi bi-capsule me-2"></i>Daftar Obat Saat Ini</h5>
          @if($rmTerakhir)
          <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalEResep">
            Lihat E-Resep
          </button>
          @endif
        </div>
        <div class="card-body p-4">
          @if($rmTerakhir && $rmTerakhir->reseps->isNotEmpty())
          <div class="alert alert-info bg-opacity-10 border-0 border-start border-info border-4 mb-4 small">
            Resep dari pemeriksaan tanggal <strong>{{ $rmTerakhir->created_at->format('d F Y') }}</strong> oleh <strong>{{ $rmTerakhir->dokter->user->name }}</strong>.
          </div>

          <div class="timeline">
            @php
            // Array warna agar UI tetap cantik seperti desain aslimu
            $colors = ['info', 'warning', 'success', 'primary'];
            @endphp

            @foreach($rmTerakhir->reseps as $index => $resep)
            @php $color = $colors[$index % 4]; @endphp
            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center" style="width: 70px;">
                <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} p-2 rounded-3 w-100">OBAT</span>
                <small class="text-muted d-block mt-1">Aktif</small>
              </div>
              <div class="ms-4 p-3 bg-light rounded-4 flex-grow-1 border-start border-{{ $color }} border-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="fw-bold mb-1">{{ optional($resep->obat)->nama_obat ?? 'Obat Dihapus' }}</h6>
                    <p class="small text-muted mb-0">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }} • {{ $resep->aturan }}</p>
                  </div>
                  <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                    Ikuti Aturan
                  </span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @else
          <div class="text-center py-5">
            <i class="bi bi-emoji-smile fs-1 text-muted mb-3 d-block"></i>
            <h6 class="fw-bold text-muted">Tidak Ada Resep Aktif</h6>
            <p class="small text-muted mb-0">Anda tidak memiliki obat yang sedang dalam masa konsumsi saat ini.</p>
          </div>
          @endif
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3">Statistik Layanan Resep Anda</h6>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Total Keseluruhan Resep</span>
            <span class="small fw-bold text-primary">{{ $resepSelesai }}/{{ $totalResep }} Selesai Ditebus</span>
          </div>
          <div class="progress rounded-pill" style="height: 12px;">
            @php $persen = $totalResep > 0 ? ($resepSelesai / $totalResep) * 100 : 0; @endphp
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $persen }}%"></div>
          </div>
          <div class="mt-3 d-flex gap-2">
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Selesai (Diambil)</small>
              <span class="fw-bold text-success">{{ $resepSelesai }}</span>
            </div>
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Sedang Diproses</small>
              <span class="fw-bold text-warning">{{ $resepMenunggu }}</span>
            </div>
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Total Resep</small>
              <span class="fw-bold text-primary">{{ $totalResep }}</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 bg-primary text-white mb-4">
        <div class="card-body p-4">
          <h6 class="fw-bold">Ingin Bertanya?</h6>
          <p class="small text-white-50">Hubungi apoteker kami jika Anda memiliki keraguan tentang dosis obat.</p>
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
        <div class="modal-body p-5">
          <div class="text-center mb-4">
            <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-heart-pulse-fill me-2"></i>KLINIK OBATKU</h5>
            <p class="small text-muted mb-0">Jl. Teknologi Medis No. 12, Jember</p>
            <hr class="border-2 opacity-50">
          </div>

          <div class="d-flex justify-content-between mb-3 small">
            <div>
              <span class="text-muted d-block">Dokter:</span>
              <span class="fw-bold">{{ $rmTerakhir->dokter->user->name }}</span>
            </div>
            <div class="text-end">
              <span class="text-muted d-block">Tanggal:</span>
              <span class="fw-bold">{{ $rmTerakhir->created_at->format('d F Y') }}</span>
            </div>
          </div>

          <div class="mb-4">
            <span class="text-muted small d-block">Nama Pasien:</span>
            <span class="fw-bold">{{ Auth::user()->name }} (PAS-{{ str_pad($pasien->id, 3, '0', STR_PAD_LEFT) }})</span>
          </div>

          <div class="bg-light p-3 rounded-3 mb-4">
            <h6 class="small fw-bold border-bottom pb-2 mb-3">Daftar Obat:</h6>
            @foreach($rmTerakhir->reseps as $resep)
            <div class="d-flex justify-content-between mb-2">
              <span class="small">{{ optional($resep->obat)->nama_obat }}</span>
              <span class="fw-bold small">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
            </div>
            @endforeach
          </div>

          <div class="d-flex flex-column justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="window.print()">
              <i class="bi bi-printer me-2"></i>Cetak PDF
            </button>
            <button type="button" class="btn btn-link btn-sm text-muted text-decoration-none" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

</x-app-layout>

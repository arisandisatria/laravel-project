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
    <p class="text-muted">Pantau jadwal pengobatan dan resep Anda di sini.</p>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
          <h5 class="fw-bold text-primary mb-0"><i class="bi bi-alarm me-2"></i>Jadwal Minum Obat Hari Ini</h5>
          <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalEResep">
            Lihat E-Resep
          </button>
        </div>
        <div class="card-body p-4">
          <div class="timeline">
            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center" style="width: 70px;">
                <span class="badge bg-info bg-opacity-10 text-info p-2 rounded-3 w-100">PAGI</span>
                <small class="text-muted d-block mt-1">07:00</small>
              </div>
              <div class="ms-4 p-3 bg-light rounded-4 flex-grow-1 border-start border-info border-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="fw-bold mb-1">Paracetamol 500mg</h6>
                    <p class="small text-muted mb-0">1 Tablet • Sesudah Makan</p>
                  </div>
                  <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                    <i class="bi bi-x-circle me-1"></i> Terlewati
                  </span>
                </div>
              </div>
            </div>

            <div class="d-flex mb-4">
              <div class="flex-shrink-0 text-center" style="width: 70px;">
                <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-3 w-100">SIANG</span>
                <small class="text-muted d-block mt-1">13:00</small>
              </div>
              <div class="ms-4 p-3 bg-light rounded-4 flex-grow-1 border-start border-warning border-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="fw-bold mb-1">Vitamin C (Cevit)</h6>
                    <p class="small text-muted mb-0">1 Tablet • Sebelum Makan</p>
                  </div>
                  <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                    <i class="bi bi-check-circle me-1"></i> Sudah Diminum
                  </span>
                </div>
              </div>
            </div>

            <div class="d-flex">
              <div class="flex-shrink-0 text-center" style="width: 70px;">
                <span class="badge bg-dark bg-opacity-10 text-dark p-2 rounded-3 w-100">MALAM</span>
                <small class="text-muted d-block mt-1">20:00</small>
              </div>
              <div class="ms-4 p-3 bg-light bg-opacity-25 rounded-4 flex-grow-1 border-start border-success border-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="fw-bold mb-1">Amoxicillin</h6>
                    <p class="small mb-0">1 Tablet • Sesudah Makan (Habiskan!)</p>
                  </div>
                  <span class="text-muted small">Belum Waktunya</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3">Progress Kepatuhan Mingguan</h6>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Senin - Minggu ini</span>
            <span class="small fw-bold text-primary">12/15 Sesi Selesai</span>
          </div>
          <div class="progress rounded-pill" style="height: 12px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%"></div>
          </div>
          <div class="mt-3 d-flex gap-2">
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Tepat Waktu</small>
              <span class="fw-bold text-success">10</span>
            </div>
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Terlambat</small>
              <span class="fw-bold text-warning">2</span>
            </div>
            <div class="bg-light rounded-3 p-2 flex-fill text-center border">
              <small class="text-muted d-block">Terlewati</small>
              <span class="fw-bold text-danger">3</span>
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

  <div class="modal fade" id="modalEResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-body p-5">
          <div class="text-center mb-4">
            <h5 class="fw-bold mb-0">KLINIK OBATKU DIGITAL</h5>
            <p class="small text-muted">Jl. Sehat Selalu No. 123, Indonesia</p>
            <hr class="border-2 opacity-50">
          </div>

          <div class="d-flex justify-content-between mb-3 small">
            <div>
              <span class="text-muted d-block">Dokter:</span>
              <span class="fw-bold">dr. Andi Hermawan</span>
            </div>
            <div class="text-end">
              <span class="text-muted d-block">Tanggal:</span>
              <span class="fw-bold">{{ date('d F Y') }}</span>
            </div>
          </div>

          <div class="mb-4">
            <span class="text-muted small d-block">Nama Pasien:</span>
            <span class="fw-bold">{{ Auth::user()->name }}</span>
          </div>

          <div class="bg-light p-3 rounded-3 mb-4">
            <div class="d-flex justify-content-between mb-2">
              <span>Paracetamol 500mg</span>
              <span class="fw-bold">10 Tab</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Amoxicillin 500mg</span>
              <span class="fw-bold">15 Tab</span>
            </div>
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
</x-app-layout>

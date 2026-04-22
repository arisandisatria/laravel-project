<x-app-layout>

  <style>
    .extra-small {
      font-size: 0.75rem;
    }

    .nav-pills .nav-link {
      color: #6c757d;
      font-weight: 500;
      font-size: 0.9rem;
    }

    .nav-pills .nav-link.active {
      background-color: #0d6efd;
      color: white;
    }

    .italic {
      font-style: italic;
    }

    .modal-content {
      border: none;
    }

    .bg-light {
      background-color: #f8f9fa !important;
    }

  </style>

  <div class="container-fluid py-4">
    <div class="mb-4">
      <h2 class="h4 fw-bold text-dark">Manajemen Pengobatan</h2>
      <p class="text-muted small">Kelola jadwal konsumsi obat harian dan arsip resep medis Anda.</p>
    </div>

    <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill px-4" id="pills-jadwal-tab" data-bs-toggle="pill" data-bs-target="#pills-jadwal" type="button" role="tab">
          <i class="bi bi-calendar-check"></i>Jadwal
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4" id="pills-resep-tab" data-bs-toggle="pill" data-bs-target="#pills-resep" type="button" role="tab">
          <i class="bi bi-file-earmark-medical"></i>Semua Resep
        </button>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-jadwal" role="tabpanel">
        <div class="row g-4">
          <div class="col-lg-7">
            <h6 class="fw-bold mb-3"><i class="bi bi-alarm me-2 text-primary"></i>Perlu Diminum Hari Ini</h6>
            <div class="col-12">
              <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <span class="badge bg-primary mb-2">Pagi & Malam</span>
                      <h5 class="fw-bold mb-1">Amoxicillin 500mg</h5>
                      <p class="small text-muted mb-0">Aturan: 2 x 1 Hari (Sesudah Makan)</p>
                    </div>
                    <div class="text-end">
                      <small class="text-muted d-block">Sisa Durasi</small>
                      <span class="fw-bold text-primary">2 Hari Lagi</span>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                      <span>Progress Pengobatan</span>
                      <span>60%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 60%"></div>
                    </div>
                    <small class="text-muted mt-1 d-block" style="font-size: 0.7rem;">*Obat akan otomatis hilang dari jadwal jika durasi habis.</small>
                  </div>

                  <div class="row g-2">
                    <div class="col-4">
                      <button class="btn btn-outline-success w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1">
                        <i class="bi bi-sun fs-4"></i>
                        <span class="small fw-bold">Pagi (07:00)</span>
                        <span class="extra-small">Klik Jika Sudah</span>
                      </button>
                    </div>
                    <div class="col-4">
                      <button class="btn btn-outline-success w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1">
                        <i class="bi bi-sun fs-4"></i>
                        <span class="small fw-bold">Siang (12:00)</span>
                        <span class="extra-small">Klik Jika Sudah</span>
                      </button>
                    </div>
                    <div class="col-4">
                      <button class="btn btn-success disabled w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1 shadow-sm">
                        <i class="bi bi-moon-stars fs-4"></i>
                        <span class="small fw-bold">Malam (20:00)</span>
                        <span class="extra-small text-white-50">Selesai (19:30)</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <span class="badge bg-warning text-dark mb-2">Siang</span>
                      <h5 class="fw-bold mb-1">Antasida Doen</h5>
                      <p class="small text-muted mb-0">Aturan: 1 x 1 Hari (Sebelum Makan)</p>
                    </div>
                    <div class="text-end">
                      <small class="text-muted d-block text-danger fw-bold">Terakhir Hari Ini!</small>
                      <span class="badge bg-danger">Final Day</span>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                    </div>
                  </div>

                  <div class="row g-2">
                    <div class="col-4">
                      <button class="btn btn-outline-success w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1">
                        <i class="bi bi-sun fs-4"></i>
                        <span class="small fw-bold">Pagi (07:00)</span>
                        <span class="extra-small">Klik Jika Sudah</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2 text-primary"></i>Log Konsumsi</h6>
            <div class="card border-0 shadow-sm rounded-4 h-100">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table align-middle mb-0 small">
                    <thead class="bg-light">
                      <tr>
                        <th class="ps-4 py-3 border-0">Obat</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0">Waktu</th>
                        <th class="border-0 text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="ps-4 fw-bold">Paracetamol</td>
                        <td>12 Januari 2026</td>
                        <td>06:45</td>
                        <td class="text-center"><span class="badge bg-success rounded-pill">Sudah Diminum</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="pills-resep" role="tabpanel">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="bg-light">
                <tr>
                  <th class="ps-4 py-3 border-0 small text-muted">ID RESEP</th>
                  <th class="border-0 small text-muted">DOKTER</th>
                  <th class="border-0 small text-muted">STATUS</th>
                  <th class="border-0 small text-muted text-center">AKSI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="ps-4">
                    <span class="fw-bold d-block text-primary">#OBT-1029</span>
                    <small class="text-muted">Diterbitkan: 10 Apr 2026</small>
                  </td>
                  <td>
                    <div class="fw-bold small">dr. Andi Hermawan</div>
                    <small class="text-muted">Poli Umum</small>
                  </td>
                  <td>
                    <span class="badge bg-primary">Aktif</span>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalDetailResep">
                      Detail
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="ps-4">
                    <span class="fw-bold d-block text-primary">#RSP-195</span>
                    <small class="text-muted">Diterbitkan: 10 Apr 2026</small>
                  </td>
                  <td>
                    <div class="fw-bold small">dr. Sarah</div>
                    <small class="text-muted">Poli Umum</small>
                  </td>
                  <td>
                    <span class="badge bg-secondary">Selesai</span>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalDetailResep">
                      Detail
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDetailResep" tabindex="-1" aria-labelledby="modalDetailResepLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg rounded-4">
        <div class="modal-header border-bottom-0 pt-4 px-4">
          <div class="d-flex align-items-center">
            <div class="text-primary p-2 me-3">
              <i class="bi bi-file-earmark-medical fs-4"></i>
            </div>
            <div>
              <h5 class="modal-title fw-bold" id="modalDetailResepLabel">Detail Resep #RSP-202</h5>
              <small class="text-muted">Diterbitkan pada 10 April 2026 • 09:45 WIB</small>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body px-4 py-2">
          <div class="row g-4">
            <div class="col-md-5">
              <div class="p-3 bg-light rounded-4 h-100">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted">Informasi Medis</h6>
                <div class="mb-3">
                  <label class="d-block small text-muted">Dokter Pemeriksa</label>
                  <span class="fw-bold text-dark">dr. Andi Hermawan</span>
                  <small class="d-block text-muted">Poli Umum</small>
                </div>
                <div class="mb-3">
                  <label class="d-block small text-muted">Diagnosa Dokter</label>
                  <p class="small fw-medium text-dark mb-0">
                    Gastroenteritis Akut (Infeksi Saluran Pencernaan). Pasien mengeluh mual dan nyeri perut.
                  </p>
                </div>
                <div class="mb-0">
                  <label class="d-block small text-muted">Status Resep</label>
                  <span class="badge bg-primary px-3 rounded-pill">Aktif (Sedang Berjalan)</span>
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <h6 class="fw-bold mb-3 small text-uppercase text-muted">Rincian Obat & Kepatuhan</h6>

              <div class="list-group list-group-flush border rounded-4 overflow-hidden mb-3">
                <div class="list-group-item p-3">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="fw-bold mb-1 small">Amoxicillin 500mg</h6>
                      <p class="extra-small text-muted mb-0">Durasi: 5 Hari (3x1 Sesudah Makan)</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill extra-small">Wajib Habis</span>
                  </div>
                </div>
                <div class="list-group-item p-3">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="fw-bold mb-1 small">Antasida Doen</h6>
                      <p class="extra-small text-muted mb-0">Durasi: 3 Hari (1x1 Sebelum Makan)</p>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill extra-small">Bila Perlu</span>
                  </div>
                </div>
              </div>

              <div class="card border-primary border-opacity-25 bg-primary bg-opacity-10 rounded-4">
                <div class="card-body p-3">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold small mb-0">Skor Kepatuhan Anda</h6>
                    <span class="fw-bold text-primary">85%</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <small class="text-muted mt-2 d-block extra-small">
                    *Data ini dihitung berdasarkan konfirmasi minum obat yang Anda lakukan.
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer border-top-0 pb-4 px-4 pt-3">
          <button type="button" class="btn btn-outline-primary rounded-pill px-4">
            <i class="bi bi-download me-2"></i>Cetak E-Resep
          </button>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>

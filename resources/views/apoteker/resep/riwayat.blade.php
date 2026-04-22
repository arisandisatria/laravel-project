<x-app-layout>
  <style>
    .nav-pills .nav-link {
      color: #6c757d;
      font-weight: 500;
    }

    .nav-pills .nav-link.active {
      background-color: #0d6efd;
      color: white;
    }

    .pagination .page-link {
      color: #6c757d;
    }

    .pagination .active .page-link {
      background-color: #0d6efd;
      border-color: #0d6efd;
      color: white;
    }

    .small-label {
      font-size: 0.65rem;
      letter-spacing: 0.5px;
    }

    .italic {
      font-style: italic;
    }

  </style>

  <div class="d-flex justify-content-between align-items-start mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Riwayat Resep Selesai</h2>
      <p class="text-muted small">Arsip seluruh resep yang telah berhasil diserahkan kepada pasien.</p>
    </div>
  </div>

  <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border">
    <li class="nav-item">
      <a class="nav-link rounded-pill px-4" href="{{ url('/permintaan-resep') }}">
        <i class="bi bi-hourglass-split me-1"></i>Antrean Aktif
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active rounded-pill px-4" href="{{ url('/permintaan-resep/riwayat') }}">
        <i class="bi bi-check-all me-1"></i>Riwayat Selesai
      </a>
    </li>
  </ul>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <div class="row g-2 align-items-center justify-content-between">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari nama pasien atau ID resep...">
          </div>
        </div>
        <div class="col-md-3">
          <input type="date" class="form-control border-0 bg-light rounded-pill shadow-none small">
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">Waktu Selesai</th>
            <th class="border-0 text-muted small text-uppercase">ID Resep</th>
            <th class="border-0 text-muted small text-uppercase">Pasien</th>
            <th class="border-0 text-muted small text-uppercase">Dokter</th>
            <th class="border-0 text-muted small text-uppercase">Status</th>
            <th class="border-0 text-muted small text-uppercase text-end pe-4">Detail</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ps-4">
              <span class="fw-bold text-dark">14:20</span>
              <small class="d-block text-muted">12 Apr 2026</small>
            </td>
            <td><span class="badge bg-light text-secondary border">#RSP-099</span></td>
            <td>
              <div class="fw-bold text-dark">Siti Aminah</div>
              <small class="text-muted">Apoteker: Apt. Aris</small>
            </td>
            <td>
              <div class="small fw-medium">dr. Sarah</div>
            </td>
            <td>
              <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill small">
                <i class="bi bi-check-circle-fill me-1"></i> Telah Diserahkan
              </span>
            </td>
            <td class="text-end pe-4">
              <button class="btn btn-sm btn-light border rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDetailRiwayat" title="Detail Transaksi">
                <i class="bi bi-info-circle text-primary"></i>
              </button>
            </td>
          </tr>

          <tr>
            <td class="ps-4">
              <span class="fw-bold text-dark">13:05</span>
              <small class="d-block text-muted">12 Apr 2026</small>
            </td>
            <td><span class="badge bg-light text-secondary border">#RSP-098</span></td>
            <td>
              <div class="fw-bold text-dark">Budi Santoso</div>
              <small class="text-muted">Apoteker: Apt. Aris</small>
            </td>
            <td>
              <div class="small fw-medium">dr. Andi Hermawan</div>
            </td>
            <td>
              <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill small">
                <i class="bi bi-check-circle-fill me-1"></i> Telah Diserahkan
              </span>
            </td>
            <td class="text-end pe-4">
              <button class="btn btn-sm btn-light border rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDetailRiwayat">
                <i class="bi bi-info-circle text-primary"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer bg-white border-top-0 py-3">
      <nav class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan 2 dari 150 riwayat resep</small>
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-start-pill px-3" href="#">Prev</a></li>
          <li class="page-item active"><a class="page-link border-0 px-3" href="#">1</a></li>
          <li class="page-item"><a class="page-link border-0 px-3" href="#">2</a></li>
          <li class="page-item"><a class="page-link border-0 bg-light rounded-end-pill px-3" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <div class="modal fade" id="modalDetailRiwayat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg rounded-4">
        <div class="modal-header border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-start">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
              <i class="bi bi-check-all fs-3"></i>
            </div>
            <div>
              <h5 class="modal-title fw-bold">Detail Penyerahan #RSP-101</h5>
              <p class="text-muted small mb-0">Diselesaikan pada 12 Apr 2026 • 14:20 WIB</p>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body px-4">
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <div class="p-3 bg-light rounded-4 border">
                <small class="text-muted d-block text-uppercase small-label mb-1">Pasien</small>
                <h6 class="fw-bold mb-0">Andi Wijaya</h6>
                <small class="text-muted text-truncate">Laki-laki, 32 Thn</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 bg-light rounded-4 border">
                <small class="text-muted d-block text-uppercase small-label mb-1">Dokter</small>
                <h6 class="fw-bold mb-0">dr. Andi Hermawan</h6>
                <small class="text-muted">Poli Umum</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 bg-light rounded-4 border">
                <small class="text-muted d-block text-uppercase small-label mb-1">Petugas Apotek</small>
                <h6 class="fw-bold mb-0 text-success">Apt. Aris</h6>
                <small class="text-muted">ID: STAFF-092</small>
              </div>
            </div>
          </div>

          <h6 class="fw-bold mb-3"><i class="bi bi-capsule-pill me-2 text-primary"></i>Obat yang Diserahkan</h6>
          <div class="table-responsive border rounded-4">
            <table class="table align-middle mb-0">
              <thead class="bg-light">
                <tr class="small text-muted">
                  <th class="ps-3 border-0">Nama Obat</th>
                  <th class="border-0 text-center">Jumlah</th>
                  <th class="border-0">Aturan Pakai</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="ps-3">
                    <div class="fw-bold small">Amoxicillin 500mg</div>
                    <small class="text-muted">Kategori: Antibiotik</small>
                  </td>
                  <td class="text-center fw-bold small">15 Tab</td>
                  <td class="small italic">3 x 1 Hari (Sesudah Makan)</td>
                </tr>
                <tr>
                  <td class="ps-3">
                    <div class="fw-bold small">Paracetamol 500mg</div>
                    <small class="text-muted">Kategori: Analgetik</small>
                  </td>
                  <td class="text-center fw-bold small">10 Tab</td>
                  <td class="small italic">3 x 1 Hari (Bila Demam)</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-4 p-3 border-start border-4 border-info bg-info bg-opacity-10 rounded-end-3">
            <h6 class="fw-bold small mb-1">Catatan Tambahan:</h6>
            <p class="small text-dark mb-0 italic">"Obat antibiotik wajib dihabiskan meskipun gejala sudah reda."</p>
          </div>
        </div>

        <div class="modal-footer border-top-0 pb-4 px-4 pt-3 d-flex justify-content-end">
          <div class="btn-group">
            <button type="button" class="btn btn-outline-dark rounded-start-pill px-3 border-end" onclick="window.print()">
              <i class="bi bi-printer me-2"></i>Cetak Struk
            </button>
            <button type="button" class="btn btn-primary rounded-end-pill px-3">
              <i class="bi bi-share me-2"></i>Kirim ke Pasien
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

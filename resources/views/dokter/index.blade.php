<x-app-layout>
  <style>
    .border-dashed {
      border-style: dashed !important;
    }

  </style>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Dokter Panel</h2>
      <p class="text-muted small mb-0">Pantau aktivitas medis dan resep pasien hari ini.</p>
    </div>
    <span class="text-muted small bg-white px-3 py-2 rounded-pill shadow-sm border">
      <i class="bi bi-calendar3 me-1"></i> {{ date('d F Y') }}
    </span>
  </div>

  <div class="card shadow-sm border-0 rounded-4 mb-4 bg-primary text-white overflow-hidden">
    <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
      <div style="z-index: 1;">
        <h4 class="fw-bold mb-1">Selamat Bertugas, {{ Auth::user()->name }}! 🩺</h4>
        <p class="mb-0 text-white-50 small">Anda memiliki <span class="text-white fw-bold fs-5">3</span> pasien di antrean resep saat ini.</p>
      </div>
      <div class="d-none d-md-block opacity-25">
        <i class="bi bi-heart-pulse-fill" style="font-size: 5rem;"></i>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100 border-4 border-bottom border-primary">
        <div class="card-body p-4 text-center text-xl-start">
          <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-people fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Pasien Saya</h6>
          <h3 class="fw-bold mb-0 text-dark">42 <span class="fs-6 text-muted fw-normal">Orang</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-xl-start">
          <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-file-earmark-medical fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Resep Diterbitkan</h6>
          <h3 class="fw-bold mb-0 text-dark">8 <span class="fs-6 text-muted fw-normal">Resep</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-xl-start">
          <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-hourglass-split fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Antrean Menunggu</h6>
          <h3 class="fw-bold mb-0 text-dark">3 <span class="fs-6 text-muted fw-normal">Sisa</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4 text-center text-xl-start">
          <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-info-circle fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Obat Kosong</h6>
          <h3 class="fw-bold mb-0 text-dark">2 <span class="fs-6 text-muted fw-normal">Item</span></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
          <h5 class="fw-bold text-dark mb-0">Aktivitas Resep Terbaru</h5>
          <a href="{{ url('/kelola-resep') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light text-muted small">
                <tr>
                  <th class="border-0 rounded-start">ID Resep</th>
                  <th class="border-0">Nama Pasien</th>
                  <th class="border-0">Waktu</th>
                  <th class="border-0">Status</th>
                  <th class="border-0 rounded-end text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="fw-semibold text-primary">#RSP-101</td>
                  <td>Andi Wijaya</td>
                  <td class="text-muted small">09:30 AM</td>
                  <td><span class="badge bg-warning text-dark bg-opacity-25 rounded-pill px-3">Proses Apotek</span></td>
                  <td class="text-end">
                    <button class="btn btn-sm btn-light border-0" data-bs-toggle="modal" data-bs-target="#modalLihatResep">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="fw-semibold text-primary">#RSP-100</td>
                  <td>Lani Marlina</td>
                  <td class="text-muted small">08:15 AM</td>
                  <td><span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3">Selesai</span></td>
                  <td class="text-end">
                    <button class="btn btn-sm btn-light border-0" data-bs-toggle="modal" data-bs-target="#modalLihatResep">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
          <h5 class="fw-bold text-dark mb-0">Tugas Dokter</h5>
        </div>
        <div class="card-body p-4">
          <div class="d-grid gap-3">
            <a href="{{ url('/kelola-resep/create') }}" class="btn btn-outline-primary text-start p-3 rounded-4 d-flex align-items-center text-decoration-none">
              <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-pencil-square"></i></div>
              <div>
                <h6 class="fw-bold mb-0">Tulis Resep Baru</h6>
                <span class="small text-muted">Input diagnosa & obat pasien</span>
              </div>
            </a>

            <a href="{{ url('/manajemen-pasien') }}" class="btn btn-outline-dark text-start p-3 rounded-4 d-flex align-items-center text-decoration-none border-dashed">
              <div class="bg-dark text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-person-lines-fill"></i></div>
              <div>
                <h6 class="fw-bold mb-0">Riwayat Pasien</h6>
                <span class="small opacity-75">Cek rekam medis terdahulu</span>
              </div>
            </a>
          </div>

          <hr class="my-4 text-muted">

          <h6 class="fw-bold text-dark mb-3">Info Ketersediaan Obat</h6>
          <div class="alert alert-info bg-opacity-10 border-0 border-start border-info shadow-sm" role="alert">
            <div class="small">
              <i class="bi bi-info-circle-fill me-1"></i>
              <strong>Info:</strong> Stok <strong>Amoxicillin</strong> hampir habis. Mohon tanyakan ketersediaan ke apotek sebelum meresepkan.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLihatResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-0 pt-4 px-4">
          <h5 class="fw-bold mb-0">Detail Resep #RSP-101</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4 pb-4">
          <div class="mb-3">
            <small class="text-muted d-block">Pasien:</small>
            <span class="fw-bold">Budi Santoso (Laki-laki, 45 Thn)</span>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Diagnosa:</small>
            <p class="small bg-light p-2 rounded">Demam tinggi disertai batuk berdahak.</p>
          </div>
          <h6 class="fw-bold small mb-2 text-uppercase text-muted">Daftar Obat</h6>
          <ul class="list-group list-group-flush border rounded-3">
            <li class="list-group-item d-flex justify-content-between align-items-center small p-3">
              <div>
                <strong>Amoxicillin 500mg</strong>
                <div class="text-muted">3 x 1 Hari (Habiskan)</div>
              </div>
              <span class="badge bg-primary rounded-pill">15 Tab</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center small p-3">
              <div>
                <strong>Paracetamol 500mg</strong>
                <div class="text-muted">3 x 1 Hari (Bila Demam)</div>
              </div>
              <span class="badge bg-primary rounded-pill">10 Tab</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

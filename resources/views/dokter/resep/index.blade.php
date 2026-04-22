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
      <form class="row g-3 align-items-center">
        <div class="col-md-4">
          <div class="input-group gap-2">
            <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-0 bg-light rounded-3 shadow-none" placeholder="Cari nama pasien atau ID resep...">
          </div>
        </div>
        <div class="col-md-3">
          <select class="form-select border-0 bg-light rounded-3 shadow-none small">
            <option selected>Semua Status</option>
            <option>Menunggu Obat</option>
            <option>Siap Diambil</option>
            <option>Selesai</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="date" class="form-control border-0 bg-light rounded-3 shadow-none small">
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-dark w-100 rounded-3 small">Filter</button>
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
          <tr>
            <td class="ps-4">
              <span class="fw-bold text-primary">#RSP-2026-001</span>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" class="rounded-circle me-2" width="32">
                <div>
                  <h6 class="mb-0 fw-bold small">Budi Santoso</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">Laki-laki, 45 Thn</small>
                </div>
              </div>
            </td>
            <td>
              <div class="small fw-medium text-dark">12 April 2026</div>
              <small class="text-muted">09:45 WIB</small>
            </td>
            <td>
              <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill small">
                <i class="bi bi-hourglass-split me-1"></i> Menunggu Obat
              </span>
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalLihatResep" title="Lihat Detail">
                  <i class="bi bi-eye text-primary"></i>
                </button>
                <a href="{{ url('/kelola-resep/edit/1') }}" class="btn btn-sm btn-light rounded-circle shadow-sm border" title="Edit Resep">
                  <i class="bi bi-pencil-square text-warning"></i>
                </a>
                <button class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalHapusResep" title="Hapus">
                  <i class="bi bi-trash text-danger"></i>
                </button>
              </div>
            </td>
          </tr>

          <tr>
            <td class="ps-4">
              <span class="fw-bold text-primary">#RSP-2026-002</span>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" class="rounded-circle me-2" width="32">
                <div>
                  <h6 class="mb-0 fw-bold small">Siti Aminah</h6>
                  <small class="text-muted" style="font-size: 0.7rem;">Perempuan, 28 Thn</small>
                </div>
              </div>
            </td>
            <td>
              <div class="small fw-medium text-dark">11 April 2026</div>
              <small class="text-muted">14:20 WIB</small>
            </td>
            <td>
              <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill small">
                <i class="bi bi-check-circle me-1"></i> Selesai
              </span>
            </td>
            <td class="text-center text-muted small">
              <em>Tidak ada aksi</em>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white border-top-0 py-3">
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan 2 dari 48 resep</small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-circle me-2" href="#"><i class="bi bi-chevron-left"></i></a></li>
            <li class="page-item active"><a class="page-link border-0 rounded-circle me-2" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0 bg-light text-dark rounded-circle" href="#"><i class="bi bi-chevron-right"></i></a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLihatResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-0 pt-4 px-4">
          <h5 class="fw-bold mb-0">Detail Resep #RSP-2026-001</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4">
          <div class="mb-3">
            <small class="text-muted d-block">Pasien:</small>
            <span class="fw-bold">Budi Santoso (Laki-laki, 45 Thn)</span>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Diagnosa:</small>
            <p class="small bg-light p-2 rounded">Demam tinggi disertai batuk berdahak.</p>
          </div>
          <h6 class="fw-bold small mb-2 text-uppercase text-muted">Daftar Obat</h6>
          <ul class="list-group list-group-flush border rounded-3 mb-4">
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

  <div class="modal fade" id="modalHapusResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4 text-center">
        <div class="modal-body p-4">
          <div class="text-danger mb-3">
            <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
          </div>
          <h5 class="fw-bold">Hapus Resep?</h5>
          <p class="text-muted small">Data resep #RSP-2026-001 akan dihapus permanen dari sistem.</p>
          <div class="d-flex flex-column gap-2 align-items-center mt-4">
            <button type="button" class="btn btn-danger rounded-pill w-100 fw-bold">Ya, Hapus Resep</button>
            <button type="button" class="btn btn-link btn-sm text-muted" style="width: fit-content;" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

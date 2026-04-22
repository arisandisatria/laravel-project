<x-app-layout>
  <x-slot name="header">
    <h2 class="h4 fw-bold text-dark mb-0">
      {{ __('') }}
    </h2>
  </x-slot>

  <style>
    .timeline {
      padding-left: 10px;
    }

    .form-control:focus {
      border-color: #0d6efd;
    }

    .timeline-action {
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
    }

    .timeline-item:hover .timeline-action {
      opacity: 1;
    }

  </style>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Data Riwayat Pasien</h2>
    <p class="text-muted small mb-0">Cari dan tinjau riwayat medis pasien untuk diagnosa yang lebih akurat.</p>
  </div>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <div class="input-group">
        <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-0 shadow-none" placeholder="Masukkan Nama atau ID Pasien untuk melihat riwayat...">
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small">ID PASIEN</th>
            <th class="border-0 text-muted small">NAMA PASIEN</th>
            <th class="border-0 text-muted small">INFO DASAR</th>
            <th class="border-0 text-muted small">KUNJUNGAN TERAKHIR</th>
            <th class="border-0 text-muted small text-center">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ps-4 fw-bold text-primary">PAS-001</td>
            <td>
              <div class="fw-bold text-dark">Budi Santoso</div>
            </td>
            <td>
              <span class="badge bg-light text-dark border fw-normal">Laki-laki</span>
              <span class="badge bg-light text-dark border fw-normal">45 Thn</span>
            </td>
            <td>10 April 2026</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-sm btn-outline-dark rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalRekamMedis" title="Lihat Riwayat Medis">
                  <i class="bi bi-journal-text me-1"></i> Riwayat
                </button>

                <a href="{{ url('/rekam-medis/create') }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm fw-bold" title="Tambah Pemeriksaan Baru">
                  <i class="bi bi-plus-lg me-1"></i> Periksa Pasien
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="modalRekamMedis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-bottom-0 pt-4 px-4 bg-light rounded-top-4">
          <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-medical text-primary me-2"></i>Riwayat Medis: Budi Santoso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-4">
          <div class="timeline">

            <div class="border-start border-primary border-3 ps-4 pb-4 position-relative timeline-item">
              <div class="position-absolute start-0 translate-middle-x bg-primary rounded-circle" style="width: 12px; height: 12px; margin-left: -1.5px; top: 5px;"></div>

              <div class="d-flex justify-content-between align-items-start mb-1">
                <div>
                  <span class="fw-bold text-dark">10 April 2026</span>
                  <span class="badge bg-primary bg-opacity-10 text-primary ms-2">dr. Andi Hermawan</span>
                </div>
                <div class="timeline-action">
                  <a href="{{ url('/rekam-medis/edit/1') }}" class="btn btn-sm btn-light text-warning px-2 py-1 border shadow-sm rounded-3" title="Edit Rekam Medis Ini">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <button class="btn btn-sm btn-light text-danger px-2 py-1 border shadow-sm rounded-3 ms-1" data-bs-toggle="modal" data-bs-target="#modalHapusRekamMedis" title="Hapus Rekam Medis Ini">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </div>

              <div class="p-3 bg-light rounded-3 mt-2">
                <div class="mb-2">
                  <small class="text-muted d-block">Diagnosa/Keluhan:</small>
                  <span class="fw-medium text-dark">Demam tinggi dan batuk berdahak selama 3 hari.</span>
                </div>
                <div>
                  <small class="text-muted d-block">Resep Obat:</small>
                  <span class="badge bg-white border text-dark fw-normal">Paracetamol 500mg</span>
                  <span class="badge bg-white border text-dark fw-normal">Amoxicillin 500mg</span>
                </div>
              </div>
            </div>

            <div class="border-start border-light border-3 ps-4 pb-2 position-relative timeline-item">
              <div class="position-absolute start-0 translate-middle-x bg-secondary rounded-circle" style="width: 12px; height: 12px; margin-left: -1.5px; top: 5px;"></div>

              <div class="d-flex justify-content-between align-items-start mb-1 text-muted">
                <div>
                  <span class="fw-bold">05 Maret 2026</span>
                  <span class="badge bg-light text-muted ms-2 border">dr. Sarah</span>
                </div>
                <div class="timeline-action">
                  <a href="{{ url('/rekam-medis/2/edit') }}" class="btn btn-sm btn-light text-warning px-2 py-1 border shadow-sm rounded-3" title="Edit Rekam Medis Ini">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                </div>
              </div>

              <div class="p-3 bg-light bg-opacity-50 rounded-3 mt-2">
                <div class="mb-1 text-muted small">
                  <strong>Diagnosa:</strong> Radang tenggorokan ringan.
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer border-top-0 pb-4">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHapusRekamMedis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg rounded-4 text-center">
        <div class="modal-body p-4">
          <div class="text-danger mb-3">
            <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
          </div>
          <h5 class="fw-bold">Hapus Rekam Medis?</h5>
          <p class="text-muted small">Catatan medis tanggal 10 April 2026 akan dihapus permanen. Resep yang terkait mungkin juga akan ikut terhapus.</p>

          <form action="{{ url('/rekam-medis/1') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column gap-2 align-items-center mt-4">
              <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">Ya, Hapus Data</button>
              <button type="button" class="btn btn-link btn-sm text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

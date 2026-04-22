<x-app-layout>
  <div class="d-flex align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Proses Penyiapan Obat</h2>
      <p class="text-muted small mb-0">Validasi item obat sesuai instruksi resep dokter.</p>
    </div>
  </div>

  <div class="row g-4 align-items-start">

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Informasi Resep</h6>
          <div class="mb-3">
            <small class="text-muted d-block">ID Resep / Tanggal:</small>
            <span class="fw-bold">#RSP-101</span> / <span class="small">12 Apr 2026</span>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Nama Pasien:</small>
            <span class="fw-bold text-dark">Andi Wijaya</span>
          </div>
          <div class="mb-0">
            <small class="text-muted d-block">Dokter Pemeriksa:</small>
            <span class="fw-bold">dr. Andi Hermawan</span>
          </div>
        </div>
      </div>

      <div class="alert alert-warning bg-warning bg-opacity-10 text-dark border-0 border-start border-warning border-4 rounded-4 shadow-sm small">
        <i class="bi bi-exclamation-circle-fill text-warning me-2 fs-5 align-middle"></i>
        Pastikan memeriksa kembali label dosis sebelum obat diserahkan ke pasien.
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <h6 class="fw-bold mb-4">Item Obat yang Harus Disiapkan</h6>

          <form action="{{ url('/permintaan-resep/1/konfirmasi') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="bg-light small text-muted">
                  <tr>
                    <th class="border-0 ps-3">Nama Obat</th>
                    <th class="border-0 text-center">Jumlah</th>
                    <th class="border-0">Aturan Pakai</th>
                    <th class="border-0 text-end pe-3">Check</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="ps-3">
                      <div class="fw-bold">Amoxicillin 500mg</div>
                      <small class="text-muted">Stok tersedia: 48</small>
                    </td>
                    <td class="text-center fw-bold">15 Tab</td>
                    <td class="small fst-italic">3 x 1 Hari (Habiskan)</td>
                    <td class="text-end pe-3">
                      <input class="form-check-input border-primary shadow-none cursor-pointer" type="checkbox" style="width: 20px; height: 20px;" required>
                    </td>
                  </tr>
                  <tr>
                    <td class="ps-3">
                      <div class="fw-bold">Paracetamol 500mg</div>
                      <small class="text-muted">Stok tersedia: 95</small>
                    </td>
                    <td class="text-center fw-bold">10 Tab</td>
                    <td class="small fst-italic">3 x 1 Hari (Bila Demam)</td>
                    <td class="text-end pe-3">
                      <input class="form-check-input border-primary shadow-none cursor-pointer" type="checkbox" style="width: 20px; height: 20px;" required>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mt-4 pt-4 border-top">
              <div class="row g-3 justify-content-between">
                <div class="col-md-3">
                  <a href="{{ url('/permintaan-resep') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2">
                    Batal
                  </a>
                </div>
                <div class="col-md-9 d-flex gap-2 justify-content-end">
                  <button type="button" class="btn btn-outline-danger rounded-pill py-2 px-4">
                    Tolak Resep
                  </button>
                  <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 fw-bold shadow-sm">
                    Konfirmasi Penyerahan
                  </button>
                </div>
              </div>
              <p class="text-end small fst-italic text-muted mt-3 mb-0">
                *Menekan konfirmasi akan otomatis mengurangi stok gudang.
              </p>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>
</x-app-layout>

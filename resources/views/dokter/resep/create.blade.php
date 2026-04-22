<x-app-layout>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Buat Resep Digital</h2>
    <p class="text-muted small mb-0">Input diagnosa dan instruksi obat untuk pasien.</p>
  </div>

  <form action="{{ url('/kelola-resep') }}" method="POST">
    @csrf

    <div class="row g-4 align-items-start">

      <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-4">
            <h6 class="fw-bold mb-3">Informasi Pemeriksaan</h6>

            <div class="mb-3">
              <label class="form-label small fw-bold">Pilih Pasien</label>
              <select class="form-select border-0 bg-light rounded-3" name="id_pasien" required>
                <option value="">-- Cari Pasien --</option>
                <option value="1">PAS-001 - Budi Santoso</option>
                <option value="2">PAS-002 - Siti Aminah</option>
              </select>
            </div>

            <div class="mb-0">
              <label class="form-label small fw-bold">Diagnosa / Keluhan</label>
              <textarea class="form-control border-0 bg-light rounded-3" name="diagnosa" rows="4" placeholder="Contoh: Pasien mengeluh pusing dan mual..." required></textarea>
            </div>
          </div>
        </div>

        <div class="alert alert-info bg-opacity-10 text-info border-0 border-start border-info border-4 shadow-sm rounded-4 small">
          <i class="bi bi-info-circle-fill me-2"></i>
          Pastikan stok obat tersedia sebelum menambahkan ke daftar resep.
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6 class="fw-bold mb-0">Daftar Obat</h6>
              <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" id="add-obat">
                <i class="bi bi-plus-lg me-1"></i> Tambah Obat
              </button>
            </div>

            <div id="wrapper-obat">
              <div class="item-obat border-bottom pb-3 mb-3">
                <div class="row g-2">
                  <div class="col-12">
                    <label class="small text-muted">Pilih Obat</label>
                    <select class="form-select form-select-sm border-0 bg-light" name="obat[]" required>
                      <option value="">-- Pilih --</option>
                      <option value="1">Amoxicillin 500mg (Stok: 50)</option>
                      <option value="2">Paracetamol 500mg (Stok: 100)</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <label class="small text-muted">Jumlah</label>
                    <input type="number" min="1" max="999" value="1" class="form-control form-control-sm border-0 bg-light" name="qty[]" placeholder="Qty" required>
                  </div>
                  <div class="col-8">
                    <label class="small text-muted">Aturan Minum</label>
                    <input type="text" class="form-control form-control-sm border-0 bg-light" name="aturan[]" placeholder="Contoh: 3 x 1 Hari (Sesudah Makan)" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-3 mt-4">
              <div class="col-md-4">
                <a href="{{ url('/kelola-resep') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted fw-medium">
                  Batal
                </a>
              </div>
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                  Simpan & Kirim ke Apotek
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </form>

  <script>
    document.getElementById('add-obat').addEventListener('click', function() {
      const wrapper = document.getElementById('wrapper-obat');
      const newField = document.createElement('div');
      newField.classList.add('item-obat', 'border-bottom', 'pb-3', 'mb-3');

      newField.innerHTML = `
                <div class="row g-2">
                    <div class="col-11">
                        <label class="small text-muted">Pilih Obat</label>
                        <select class="form-select form-select-sm border-0 bg-light" name="obat[]" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">Amoxicillin 500mg (Stok: 50)</option>
                            <option value="2">Paracetamol 500mg (Stok: 100)</option>
                        </select>
                    </div>
                    <div class="col-1 d-flex align-items-end justify-content-end">
                        <button type="button" class="btn btn-sm btn-link text-danger remove-obat" title="Hapus Obat">
                            <i class="bi bi-trash fs-5"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <label class="small text-muted">Jumlah</label>
                        <input type="number" min="1" max="999" value="1" class="form-control form-control-sm border-0 bg-light" name="qty[]" placeholder="Qty" required>
                    </div>
                    <div class="col-8">
                        <label class="small text-muted">Aturan Minum</label>
                        <input type="text" class="form-control form-control-sm border-0 bg-light" name="aturan[]" placeholder="Contoh: 3 x 1 Hari (Sesudah Makan)" required>
                    </div>
                </div>
            `;
      wrapper.appendChild(newField);
    });

    document.addEventListener('click', function(e) {
      if (e.target.closest('.remove-obat')) {
        e.target.closest('.item-obat').remove();
      }
    });

  </script>
</x-app-layout>

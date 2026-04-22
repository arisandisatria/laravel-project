<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Edit Resep Digital</h2>
    <p class="text-muted small mb-0">Perbarui diagnosa atau instruksi obat untuk resep <span class="fw-bold text-primary">#RSP-101</span>.</p>
  </div>

  <form action="{{ url('/kelola-resep/1') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4 align-items-start">

      <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-4">
            <h6 class="fw-bold mb-3">Informasi Pemeriksaan</h6>

            <div class="mb-3">
              <label class="form-label small fw-bold">Pasien</label>
              <input type="text" class="form-control border-0 bg-light rounded-3 text-muted" value="PAS-001 - Budi Santoso" readonly>
              <small class="text-info" style="font-size: 0.7rem;">*Pasien tidak dapat diubah pada mode edit.</small>
            </div>

            <div class="mb-0">
              <label class="form-label small fw-bold">Diagnosa / Keluhan</label>
              <textarea class="form-control border-0 bg-light rounded-3" name="diagnosa" rows="4" required>Demam tinggi disertai batuk berdahak selama 3 hari.</textarea>
            </div>
          </div>
        </div>

        <div class="alert alert-warning bg-opacity-10 text-warning border-0 border-start border-warning border-4 shadow-sm rounded-4 small">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          Mengubah resep yang sudah dikirim ke apotek dapat mempengaruhi proses penyiapan obat yang sedang berlangsung.
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
                  <div class="col-11">
                    <label class="small text-muted">Pilih Obat</label>
                    <select class="form-select form-select-sm border-0 bg-light" name="obat[]" required>
                      <option value="">-- Pilih --</option>
                      <option value="1" selected>Amoxicillin 500mg (Stok: 48)</option>
                      <option value="2">Paracetamol 500mg (Stok: 95)</option>
                    </select>
                  </div>
                  <div class="col-1 d-flex align-items-end justify-content-end">
                    <button type="button" class="btn btn-sm btn-link text-danger mb-1 remove-obat" title="Hapus Obat">
                      <i class="bi bi-trash fs-5"></i>
                    </button>
                  </div>
                  <div class="col-4">
                    <label class="small text-muted">Jumlah</label>
                    <input type="number" min="1" max="999" class="form-control form-control-sm border-0 bg-light" name="qty[]" value="15" required>
                  </div>
                  <div class="col-8">
                    <label class="small text-muted">Aturan Minum</label>
                    <input type="text" class="form-control form-control-sm border-0 bg-light" name="aturan[]" value="3 x 1 Hari (Habiskan)" required>
                  </div>
                </div>
              </div>

              <div class="item-obat border-bottom pb-3 mb-3">
                <div class="row g-2">
                  <div class="col-11">
                    <label class="small text-muted">Pilih Obat</label>
                    <select class="form-select form-select-sm border-0 bg-light" name="obat[]" required>
                      <option value="">-- Pilih --</option>
                      <option value="1">Amoxicillin 500mg (Stok: 48)</option>
                      <option value="2" selected>Paracetamol 500mg (Stok: 95)</option>
                    </select>
                  </div>
                  <div class="col-1 d-flex align-items-end justify-content-end">
                    <button type="button" class="btn btn-sm btn-link text-danger mb-1 remove-obat" title="Hapus Obat">
                      <i class="bi bi-trash fs-5"></i>
                    </button>
                  </div>
                  <div class="col-4">
                    <label class="small text-muted">Jumlah</label>
                    <input type="number" min="1" max="999" class="form-control form-control-sm border-0 bg-light" name="qty[]" value="10" required>
                  </div>
                  <div class="col-8">
                    <label class="small text-muted">Aturan Minum</label>
                    <input type="text" class="form-control form-control-sm border-0 bg-light" name="aturan[]" value="3 x 1 Hari (Bila Demam)" required>
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
                  Simpan Perubahan Resep
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
                            <option value="1">Amoxicillin 500mg (Stok: 48)</option>
                            <option value="2">Paracetamol 500mg (Stok: 95)</option>
                        </select>
                    </div>
                    <div class="col-1 d-flex align-items-end justify-content-end">
                        <button type="button" class="btn btn-sm btn-link text-danger mb-1 remove-obat" title="Hapus Obat">
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

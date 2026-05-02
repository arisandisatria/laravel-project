<x-app-layout>
  <style>
    .form-control:focus,
    .form-select:focus {
      background-color: #fff !important;
      border: 1px solid #198754 !important;
      box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1) !important;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

  </style>

  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="d-flex align-items-center mb-4">
        <div>
          <h2 class="h4 fw-bold text-dark mb-0">Tambah Item Obat</h2>
          <p class="text-muted small mb-0">Masukkan data obat baru ke dalam sistem inventaris.</p>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('stok-obat.store') }}" method="POST">
            @csrf

            <div class="row g-4">
              <div class="col-4 col-md-2">
                <label class="form-label small fw-bold text-muted">Kode Obat</label>
                <input type="text" class="form-control border-0 bg-light rounded-3 py-2" name="kode_obat" placeholder="Contoh: OBT-001" required>
              </div>
              <div class="col-8 col-md-10">
                <label class="form-label small fw-bold text-muted">Nama Obat</label>
                <input type="text" class="form-control border-0 bg-light rounded-3 py-2" name="nama_obat" placeholder="Masukkan nama lengkap obat..." required>
              </div>

              <div class="col-8 col-md-6">
                <label class="form-label small fw-bold text-muted">Kategori</label>
                <select class="form-select border-0 bg-light rounded-3 py-2" name="kategori" required>
                  <option value="" selected disabled>Pilih Kategori</option>
                  <option value="Antibiotik">Antibiotik</option>
                  <option value="Analgetik">Analgetik</option>
                  <option value="Vitamin">Vitamin</option>
                  <option value="Suplemen">Suplemen</option>
                  <option value="Obat Luar">Obat Luar</option>
                </select>
              </div>
              <div class="col-4 col-md-6">
                <label class="form-label small fw-bold text-muted">Satuan</label>
                <select class="form-select border-0 bg-light rounded-3 py-2" name="satuan" required>
                  <option value="" selected disabled>Pilih Satuan</option>
                  <option value="Tablet">Tablet</option>
                  <option value="Kapsul">Kapsul</option>
                  <option value="Botol">Botol (Sirup)</option>
                  <option value="Tube">Tube (Salep)</option>
                  <option value="Pcs">Pcs</option>
                </select>
              </div>

              <div class="col-6 col-md-4">
                <label class="form-label small fw-bold text-muted">Stok</label>
                <div class="input-group">
                  <input type="number" class="form-control border-0 bg-light rounded-3 py-2" name="stok" min="0" max="999999999" value="0" required>
                </div>
              </div>
              <div class="col-6 col-md-4">
                <label class="form-label small fw-bold text-muted">Harga Satuan (Rp)</label>
                <div class="input-group">
                  <span class="input-group-text border-0 bg-light rounded-start-3 small fw-bold text-muted">Rp</span>
                  <input type="number" min="0" class="form-control border-0 bg-light rounded-end-3 py-2" name="harga" placeholder="0" required>
                </div>
              </div>

              <div class="col-md-4"> <label class="form-label small fw-bold text-muted">Tanggal Kedaluwarsa (Expired)</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-x text-muted"></i></span>
                  <input type="date" class="form-control border-0 bg-light py-2 @error('tanggal_expired') is-invalid @enderror" name="tanggal_expired" value="{{ old('tanggal_expired', $item->tanggal_expired ?? '') }}" required>
                </div>
                @error('tanggal_expired')
                <div class="small text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold text-muted">Keterangan Obat (Opsional)</label>
                <textarea class="form-control border-0 bg-light rounded-3 py-2" name="keterangan" rows="3" placeholder="Tambahkan informasi tambahan jika ada..."></textarea>
              </div>

              <div class="col-12 mt-5">
                <div class="d-flex justify-content-between">
                  <div class="col-4 col-md-2">
                    <a href="{{ url('/stok-obat') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2">
                      Batal
                    </a>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                      Simpan Data Obat
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

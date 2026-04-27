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
            <span class="fw-bold">{{ $resep->kode_resep }}</span> / <span class="small">{{ $resep->created_at->format('d F Y') }}</span>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Nama Pasien:</small>
            <span class="fw-bold text-dark">{{ $resep->rekamMedis->pasien->user->name }}</span>
          </div>
          <div class="mb-0">
            <small class="text-muted d-block">Dokter Pemeriksa:</small>
            <span class="fw-bold">{{ $resep->rekamMedis->dokter->user->name }}</span>
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

          <form action="{{ route('permintaan-resep.update', $resep->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Instruksi Obat dari Dokter</label>
              <div class="p-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3">
                @if($resep->obat)
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-capsule me-2"></i>{{ $resep->obat->nama_obat }}</h6>
                <div class="d-flex justify-content-between align-items-center mt-2 small">
                  <span class="text-muted">Kategori: {{ $resep->obat->kategori }}</span>
                  <span class="badge {{ $resep->obat->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                    Sisa Stok di Apotek: {{ $resep->obat->stok }} {{ $resep->obat->satuan }}
                  </span>
                </div>
                @else
                <div class="text-danger small"><i class="bi bi-exclamation-triangle me-1"></i> Dokter belum memasukkan data obat!</div>
                @endif
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Perbarui Status Antrean <span class="text-danger">*</span></label>
              <select name="status" class="form-select bg-light border-0 py-2 shadow-none" required {{ $resep->status === 'Selesai' ? 'disabled' : '' }}>
                <option value="Menunggu" {{ $resep->status === 'Menunggu' ? 'selected' : '' }}>Menunggu (Baru Masuk)</option>
                <option value="Disiapkan" {{ $resep->status === 'Disiapkan' ? 'selected' : '' }}>Disiapkan (Menunggu Diambil Pasien)</option>
                <option value="Selesai" {{ $resep->status === 'Selesai' ? 'selected' : '' }}>Selesai (Sudah Diserahkan)</option>
              </select>
            </div>

            @if($resep->status !== 'Selesai')
            <div class="alert alert-warning bg-warning bg-opacity-10 border-0 small text-warning rounded-3 mt-3">
              <i class="bi bi-info-circle-fill me-1"></i> Mengubah status menjadi <strong>Selesai</strong> akan memotong stok secara otomatis.
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm" {{ (!$resep->obat || $resep->obat->stok < 1) ? 'disabled' : '' }}>
              <i class="bi bi-save me-2"></i>Simpan Perubahan
            </button>
            @else
            <div class="alert alert-success bg-success bg-opacity-10 border-0 small text-success rounded-3 text-center">
              <i class="bi bi-check-circle-fill d-block fs-3 mb-2"></i>
              Resep diserahkan dan stok obat telah dipotong.
            </div>
            <div class="col-md-12 mt-4">
              <a href="{{ route('permintaan-resep.index') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2">
                Kembali
              </a>
            </div>
            @endif

          </form>

        </div>
      </div>
    </div>

  </div>
</x-app-layout>

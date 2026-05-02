<x-app-layout>
  <style>
    .form-control:focus,
    .form-select:focus {
      background-color: #fff !important;
      border: 0px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

  </style>

  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Edit Data Obat</h2>
    <p class="text-muted small mb-0">Perbarui informasi stok, harga, atau detail obat.</p>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
      @if ($errors->any())
      <div class="alert alert-danger mb-4 rounded-3 border-0">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="{{ route('stok-obat.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
          <div class="col-4 col-md-2">
            <label class="form-label small fw-bold text-muted text-uppercase">Kode Obat</label>
            <input type="text" class="form-control border-0 bg-light rounded-3 py-2 fw-bold" name="kode_obat" value="{{ $item->kode_obat }}" readonly>
            <small class="text-info">*Kode obat tidak dapat diubah</small>
          </div>

          <div class="col-8 col-md-10">
            <label class="form-label small fw-bold text-muted text-uppercase">Nama Obat</label>
            <input type="text" class="form-control border-0 bg-light rounded-3 py-2" name="nama_obat" value="{{ $item->nama_obat }}" required>
          </div>

          <div class="col-8 col-md-6">
            <label class="form-label small fw-bold text-muted text-uppercase">Kategori</label>
            <select class="form-select border-0 bg-light rounded-3 py-2" name="kategori">
              <option value="Antibiotik" {{ old('kategori', $item->kategori) == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
              <option value="Analgetik" {{ old('kategori', $item->kategori) == 'Analgetik' ? 'selected' : '' }}>Analgetik</option>
              <option value="Vitamin" {{ old('kategori', $item->kategori) == 'Vitamin' ? 'selected' : '' }}>Vitamin</option>
              <option value="Suplemen" {{ old('kategori', $item->kategori) == 'Suplemen' ? 'selected' : '' }}>Suplemen</option>
              <option value="Obat Luar" {{ old('kategori', $item->kategori) == 'Obat Luar' ? 'selected' : '' }}>Obat Luar</option>
            </select>
          </div>

          <div class="col-4 col-md-6">
            <label class="form-label small fw-bold text-muted text-uppercase">Satuan</label>
            <select class="form-select border-0 bg-light rounded-3 py-2" name="satuan">
              <option value="Tablet" {{ old('satuan', $item->satuan) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
              <option value="Botol" {{ old('satuan', $item->satuan) == 'Botol' ? 'selected' : '' }}>Botol</option>
              <option value="Kapsul" {{ old('satuan', $item->satuan) == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
              <option value="Tube" {{ old('satuan', $item->satuan) == 'Tube' ? 'selected' : '' }}>Tube (Salep)</option>
              <option value="Pcs" {{ old('satuan', $item->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
            </select>
          </div>

          <div class="col-6 col-md-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Stok Saat Ini</label>
            <input type="number" min="0" class="form-control border-0 bg-light rounded-3 py-2" name="stok" value="{{ $item->stok }}" required>
          </div>
          <div class="col-6 col-md-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Harga Satuan (Rp)</label>
            <div class="input-group">
              <span class="input-group-text border-0 bg-light rounded-start-3 small fw-bold text-muted">Rp</span>
              <input type="number" min="0" class="form-control border-0 bg-light rounded-end-3 py-2" name="harga" value="{{ $item->harga }}" required>
            </div>
          </div>

          <div class="col-md-4"> <label class="form-label small fw-bold text-muted">Tanggal Kedaluwarsa (Expired)</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-x text-muted"></i></span>
              <input type="date" class="form-control border-0 bg-light py-2 @error('tanggal_expired') is-invalid @enderror" name="tanggal_expired" value="{{ $item->tanggal_expired?->format('Y-m-d') ?? '' }}" required>
            </div>
            @error('tanggal_expired')
            <div class="small text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12">
            <label class="form-label small fw-bold text-muted">Keterangan Obat (Opsional)</label>
            <textarea class="form-control border-0 bg-light rounded-3 py-2" name="keterangan" rows="3" placeholder="Tambahkan informasi tambahan jika ada...">{{ $item->keterangan }}</textarea>
          </div>

          <div class="col-12 mt-5">
            <div class="d-flex justify-content-between pt-3 border-top">
              <div class="col-4 col-md-2">
                <a href="{{ url('/stok-obat') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2">
                  Batal
                </a>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                  Simpan Perubahan
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

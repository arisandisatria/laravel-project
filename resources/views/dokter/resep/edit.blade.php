<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Edit Resep Digital</h2>
    <p class="text-muted small mb-0">Perbarui diagnosa atau instruksi obat untuk resep <span class="fw-bold text-primary">#RSP-101</span>.</p>
  </div>

  <form action="{{ route('dokter.resep.update', $rm->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4 align-items-start">
      <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-3 p-md-4">
            <h6 class="fw-bold mb-3">Informasi Pemeriksaan</h6>

            <div class="mb-3">
              <label class="form-label small fw-bold">Pasien</label>
              <input type="text" class="form-control border-0 bg-light rounded-3 text-muted" value="PAS-{{ str_pad($rm->pasien_id, 3, '0', STR_PAD_LEFT) }} - {{ $rm->pasien->user->name }}" readonly>
              <small class="text-info" style="font-size: 0.7rem;">*Pasien tidak dapat diubah pada mode edit.</small>
            </div>

            <div class="mb-0">
              <label class="form-label small fw-bold">Diagnosa / Keluhan</label>
              <textarea class="form-control border-0 bg-light rounded-3" name="diagnosa" rows="4" required>{{ $rm->diagnosa }}</textarea>
            </div>
          </div>
        </div>

        <div class="alert alert-warning bg-opacity-10 text-warning border-0 border-start border-warning border-4 shadow-sm rounded-4 small">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          Mengubah resep yang sudah dikirim ke apotek dapat mempengaruhi proses penyiapan obat yang sedang berlangsung.
        </div>
      </div>

      <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-3 p-md-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-2">
              <h6 class="fw-bold mb-0">Daftar Obat</h6>
              <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 w-100 w-sm-auto" id="add-obat">
                <i class="bi bi-plus-lg me-1"></i> Tambah Obat
              </button>
            </div>

            <div id="wrapper-obat">
              @foreach($rm->reseps as $resepLama)
              @if($resepLama->status === 'Menunggu')
              <div class="item-obat border-bottom pb-3 mb-3">
                <div class="row g-2">
                  <div class="col-10 col-sm-11">
                    <label class="small text-muted">Pilih Obat</label>
                    <select class="form-select form-select-sm border-0 bg-light py-2" name="obat[]" required>
                      <option value="">-- Pilih --</option>
                      @foreach($obats as $obat)
                      <option value="{{ $obat->id }}" {{ $obat->id == $resepLama->obat_id ? 'selected' : '' }}>
                        {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-2 col-sm-1 d-flex align-items-end justify-content-end">
                    <button type="button" class="btn btn-sm btn-link text-danger remove-obat p-0 mb-1" title="Hapus Obat">
                      <i class="bi bi-trash fs-4"></i>
                    </button>
                  </div>
                  <div class="col-12 col-sm-4 mt-2 mt-sm-0">
                    <label class="small text-muted">Jumlah</label>
                    <input type="number" min="1" max="999" class="form-control form-control-sm border-0 bg-light py-2" name="qty[]" value="{{ $resepLama->jumlah }}" required>
                  </div>
                  <div class="col-12 col-sm-8 mt-2 mt-sm-0">
                    <label class="small text-muted">Aturan Minum</label>
                    <input type="text" class="form-control form-control-sm border-0 bg-light py-2" name="aturan[]" value="{{ $resepLama->aturan }}" required>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
            </div>

            <div class="row g-3 mt-4">
              <div class="col-12 col-md-4">
                <a href="{{ route('dokter.resep.index') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted fw-medium text-center">
                  Batal
                </a>
              </div>
              <div class="col-12 col-md-8">
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
    const pilihanObat = `
      <option value="">-- Pilih --</option>
      @foreach($obats as $obat)
        <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
      @endforeach
    `;

    document.getElementById('add-obat').addEventListener('click', function() {
      const wrapper = document.getElementById('wrapper-obat');
      const newField = document.createElement('div');
      newField.classList.add('item-obat', 'border-bottom', 'pb-3', 'mb-3');

      newField.innerHTML = `
        <div class="row g-2">
          <div class="col-10 col-sm-11">
            <label class="small text-muted">Pilih Obat</label>
            <select class="form-select form-select-sm border-0 bg-light py-2" name="obat[]" required>
              ${pilihanObat}
            </select>
          </div>
          <div class="col-2 col-sm-1 d-flex align-items-end justify-content-end">
            <button type="button" class="btn btn-sm btn-link text-danger remove-obat p-0 mb-1" title="Hapus Obat">
              <i class="bi bi-trash fs-4"></i>
            </button>
          </div>
          <div class="col-12 col-sm-4 mt-2 mt-sm-0">
            <label class="small text-muted">Jumlah</label>
            <input type="number" min="1" max="999" value="1" class="form-control form-control-sm border-0 bg-light py-2" name="qty[]" placeholder="Qty" required>
          </div>
          <div class="col-12 col-sm-8 mt-2 mt-sm-0">
            <label class="small text-muted">Aturan Minum</label>
            <input type="text" class="form-control form-control-sm border-0 bg-light py-2" name="aturan[]" placeholder="Contoh: 3 x 1 Hari" required>
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

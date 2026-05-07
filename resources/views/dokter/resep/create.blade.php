<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-0">Buat Resep Digital</h2>
    <p class="text-muted small mb-0">Input diagnosa dan instruksi obat untuk pasien.</p>
  </div>

  <form action="{{ route('dokter.resep.store') }}" method="POST">
    @csrf

    <div class="row g-4 align-items-start">
      <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-3 p-md-4">
            <h6 class="fw-bold mb-3">Informasi Pemeriksaan</h6>

            <div class="mb-3">
              <label class="form-label small fw-bold">Pilih Pasien</label>
              <select class="form-select border-0 bg-light rounded-3" name="id_pasien" required>
                <option value="">-- Cari Pasien --</option>
                @foreach($pasiens as $pasien)
                <option value="{{ $pasien->id }}">PAS-{{ str_pad($pasien->id, 3, '0', STR_PAD_LEFT) }} - {{ $pasien->user->name }}</option>
                @endforeach
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

      <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-body p-3 p-md-4">
            <div class="row justify-content-between align-items-center mb-4 g-3">
              <div class="col-12 col-md-auto">
                <h6 class="fw-bold mb-0">Daftar Obat</h6>
              </div>
              <div class="col-12 col-md-auto">
                <div class="d-grid d-md-block">
                  <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 w-100" id="add-obat">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Obat
                  </button>
                </div>
              </div>
            </div>

            <div id="wrapper-obat">
              <div class="item-obat border-bottom pb-3 mb-3">
                <div class="row g-2">
                  <div class="col-12">
                    <label class="small text-muted">Pilih Obat</label>
                    <select class="form-select form-select-sm border-0 bg-light py-2" name="obat[]" required>
                      <option value="">-- Pilih --</option>
                      @foreach($obats as $obat)
                      <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-4 mt-2 mt-sm-0">
                    <label class="small text-muted">Jumlah</label>
                    <input type="number" min="1" max="999" value="1" class="form-control form-control-sm border-0 bg-light py-2" name="qty[]" placeholder="Qty" required>
                  </div>
                  <div class="col-8 mt-2 mt-sm-0">
                    <label class="small text-muted">Aturan Minum</label>
                    <input type="text" class="form-control form-control-sm border-0 bg-light py-2" name="aturan[]" placeholder="Contoh: 3 x 1 Hari (Sesudah Makan)" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-3 mt-4">
              <div class="col-4">
                <a href="{{ url('/kelola-resep') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted fw-medium text-center">
                  Batal
                </a>
              </div>
              <div class="col-8">
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

<x-app-layout>

  <div class="row justify-content-center mb-5">
    <div class="col-lg-12">

      <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
        <div class="card-body p-4">
          <div class="row align-items-center">
            <div class="col-md-8">
              <small class="text-white text-uppercase" style="letter-spacing: 1px;">Data Pasien</small>
              <h4 class="fw-bold mb-1 mt-1">Budi Santoso</h4>
              <p class="mb-0 text-white small">
                <i class="bi bi-fingerprint me-1"></i> ID: PAS-001 &nbsp; • &nbsp;
                <i class="bi bi-gender-male me-1"></i> Laki-laki &nbsp; • &nbsp;
                <i class="bi bi-calendar3 me-1"></i> 45 Tahun
              </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0 d-none d-md-block opacity-50">
              <i class="bi bi-clipboard2-pulse" style="font-size: 4rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <form action="{{ url('/rekam-medis/1') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4 align-items-start">

              <div class="col-md-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Anamnesis (Wawancara Medis)</h6>

                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Keluhan Utama <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="keluhan_utama" rows="3" required autofocus>Demam tinggi dan batuk berdahak selama 3 hari.</textarea>
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Riwayat Penyakit Sebelumnya</label>
                    <textarea class="form-control border-0 bg-light py-2 rounded-3" name="riwayat_penyakit" rows="2">Tidak ada riwayat alergi obat.</textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Pemeriksaan Fisik & Diagnosa</h6>

                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Tensi Darah</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="tensi" value="120/80">
                      <span class="input-group-text border-0 bg-light text-muted small">mmHg</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Suhu Tubuh</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="suhu" value="38.5">
                      <span class="input-group-text border-0 bg-light text-muted small">°C</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Berat Badan</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="berat_badan" value="65">
                      <span class="input-group-text border-0 bg-light text-muted small">Kg</span>
                    </div>
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Diagnosa Medis <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="diagnosa" rows="3" required>Observasi Febris + ISPA</textarea>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-3">
                <div class="alert alert-warning bg-opacity-10 border-0 border-start border-warning border-4 shadow-sm rounded-4 small py-2 mb-0">
                  <i class="bi bi-info-circle-fill text-warning me-2"></i>
                  Perhatian: Jika Anda mengubah diagnosa, pastikan resep obat yang mungkin sudah terbit untuk pemeriksaan ini juga disesuaikan jika diperlukan.
                </div>
              </div>

              <div class="col-12 mt-4">
                <div class="d-flex justify-content-between pt-3 border-top">
                  <div class="col-md-2">
                    <a href="{{ url('/manajemen-pasien') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted fw-medium">
                      Batal
                    </a>
                  </div>
                  <div class="col-md-5">
                    <button type="submit" class="btn btn-primary text-white w-100 rounded-pill py-2 fw-bold shadow-sm">
                      <i class="bi bi-save me-2"></i>Simpan Perubahan
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

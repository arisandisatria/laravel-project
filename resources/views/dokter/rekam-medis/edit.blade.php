<x-app-layout>

  <div class="row justify-content-center mb-5">
    <div class="col-lg-12">

      <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
        <div class="card-body p-4">
          <div class="row align-items-center">
            <div class="col-md-8 text-center text-md-start">
              <small class="text-white text-uppercase" style="letter-spacing: 1px;">Data Pasien</small>
              <h4 class="fw-bold mb-2 mt-1">{{ $rm->pasien->user->name }}</h4>
              <p class="mb-0 text-white small d-flex flex-column flex-sm-row justify-content-center justify-content-md-start gap-2 gap-sm-3">
                <span><i class="bi bi-fingerprint me-1"></i> ID: PAS-{{ str_pad($rm->pasien_id, 3, '0', STR_PAD_LEFT) }}</span>
                <span class="d-none d-sm-inline">•</span>
                <span><i class="bi bi-gender-male me-1"></i> {{ $rm->pasien->jenis_kelamin }}</span>
                <span class="d-none d-sm-inline">•</span>
                <span><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($rm->pasien->tanggal_lahir)->age }} Tahun</span>
              </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0 d-none d-md-block opacity-50">
              <i class="bi bi-clipboard2-pulse" style="font-size: 4rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3 p-md-5">
          <form action="{{ route('dokter.rekam-medis.update', $rm->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4 align-items-start">
              <div class="col-12 col-lg-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Anamnesis (Wawancara Medis)</h6>
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Keluhan Utama <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="keluhan_utama" rows="3" required autofocus>{{ $rm->keluhan_utama }}</textarea>
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Riwayat Penyakit Sebelumnya</label>
                    <textarea class="form-control border-0 bg-light py-2 rounded-3" name="riwayat_penyakit" placeholder="Misal: Asma, Hipertensi, Alergi Obat..." rows="2">{{ $rm->riwayat_penyakit ?? '' }}</textarea>
                    <small class="text-muted" style="font-size: 0.7rem;">Kosongkan jika tidak ada.</small>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Pemeriksaan Fisik & Diagnosa</h6>
                <div class="row g-3">
                  <div class="col-4">
                    <label class="form-label small fw-bold text-muted">Tensi Darah</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light py-2" name="tensi" placeholder="120/80" value="{{ $rm->tensi ?? '' }}">
                      <span class="input-group-text border-0 bg-light text-muted small px-2 px-sm-3">mmHg</span>
                    </div>
                  </div>
                  <div class="col-4">
                    <label class="form-label small fw-bold text-muted">Suhu Tubuh</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light py-2" name="suhu" placeholder="36.5" value="{{ $rm->suhu ?? '' }}">
                      <span class="input-group-text border-0 bg-light text-muted small px-2 px-sm-3">°C</span>
                    </div>
                  </div>
                  <div class="col-4">
                    <label class="form-label small fw-bold text-muted">Berat Badan</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light py-2" name="berat_badan" placeholder="65" value="{{ $rm->berat_badan ?? '' }}">
                      <span class="input-group-text border-0 bg-light text-muted small px-2 px-sm-3">Kg</span>
                    </div>
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Diagnosa Medis <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="diagnosa" rows="3" placeholder="Masukkan diagnosa akhir pasien berdasarkan hasil pemeriksaan..." required>{{ $rm->diagnosa }}</textarea>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center pt-3 border-top gap-2">
                  <a href="{{ route('dokter.pasien') }}" class="btn btn-light rounded-pill py-2 px-4 text-muted fw-medium text-center">
                    Batal
                  </a>
                  <button type="submit" class="btn btn-primary text-white px-5 rounded-pill py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                  </button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

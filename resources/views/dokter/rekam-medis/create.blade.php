<x-app-layout>

  <div class="row justify-content-center mb-5">
    <div class="col-lg-12">

      <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
        <div class="card-body p-4">
          <div class="row align-items-center">
            <div class="col-md-8">
              <small class="text-white text-uppercase" style="letter-spacing: 1px;">Data Pasien</small>
              <h4 class="fw-bold mb-1 mt-1">{{ $pasien->user->name }}</h4>
              <p class="mb-0 text-white small">
                <i class="bi bi-fingerprint me-1"></i> ID: PAS-{{ str_pad($pasien->id, 3, '0', STR_PAD_LEFT) }} &nbsp; • &nbsp;
                <i class="bi bi-gender-male me-1"></i> {{ $pasien->jenis_kelamin }} &nbsp; • &nbsp;
                <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Tahun
              </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0 d-none d-md-block opacity-50">
              <i class="bi bi-person-bounding-box" style="font-size: 4rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('dokter.rekam-medis.simpan-pemeriksaan', $pasien->id) }}" method="POST">
            @csrf

            <div class="row g-4 align-items-start">
              <div class="col-md-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Anamnesis (Wawancara Medis)</h6>

                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Keluhan Utama <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="keluhan_utama" rows="3" placeholder="Apa yang dirasakan pasien saat ini?" required autofocus></textarea>
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Riwayat Penyakit Sebelumnya</label>
                    <textarea class="form-control border-0 bg-light py-2 rounded-3" name="riwayat_penyakit" rows="2" placeholder="Misal: Asma, Hipertensi, Alergi Obat..."></textarea>
                    <small class="text-muted" style="font-size: 0.7rem;">Kosongkan jika tidak ada.</small>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Pemeriksaan Fisik & Diagnosa</h6>

                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Tensi Darah</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="tensi" placeholder="120/80">
                      <span class="input-group-text border-0 bg-light text-muted small">mmHg</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Suhu Tubuh</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="suhu" placeholder="36.5">
                      <span class="input-group-text border-0 bg-light text-muted small">°C</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Berat Badan</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control border-0 bg-light" name="berat_badan" placeholder="65">
                      <span class="input-group-text border-0 bg-light text-muted small">Kg</span>
                    </div>
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Diagnosa Medis <span class="text-danger">*</span></label>
                    <textarea class="form-control border-0 bg-light py-3 rounded-3" name="diagnosa" rows="3" placeholder="Masukkan diagnosa akhir pasien berdasarkan hasil pemeriksaan..." required></textarea>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-4">
                <div class="p-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-4 d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="fw-bold text-primary mb-1"><i class="bi bi-capsule-pill me-2"></i>Resepkan Obat?</h6>
                    <p class="small text-muted mb-0">Lanjutkan ke halaman penulisan E-Resep setelah menyimpan pemeriksaan ini.</p>
                  </div>
                  <div class="form-check form-switch fs-4 mb-0">
                    <input class="form-check-input cursor-pointer" type="checkbox" id="buatResep" name="buat_resep" value="1" checked>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-4">
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                  <div class="col-md-2">
                    <a href="{{ url('/manajemen-pasien') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted fw-medium">
                      Batal
                    </a>
                  </div>
                  <button type="submit" class="btn btn-primary px-5 rounded-pill py-2 fw-bold shadow-sm">
                    Simpan Pemeriksaan <i class="bi bi-chevron-right ms-1"></i>
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

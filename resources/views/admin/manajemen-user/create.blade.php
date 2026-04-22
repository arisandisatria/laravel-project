<x-app-layout>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="d-flex align-items-center mb-4">
        <div>
          <h2 class="h4 fw-bold text-dark mb-0">Tambah User Baru</h2>
          <p class="text-muted small mb-0">Daftarkan staf medis atau pasien baru ke dalam sistem Obatku.</p>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('manajemen-user.store') }}" method="POST">
            @csrf

            <div class="row g-4 align-items-start">

              <div class="col-md-7">
                <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: #6610f2;">Informasi Dasar</h6>

                <div class="row">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                      <input type="text" class="form-control border-0 bg-light py-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Contoh: Andi Hermawan" required autofocus>
                    </div>
                    @error('name')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Alamat Email</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                      <input type="email" class="form-control border-0 bg-light py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Contoh: andi@obatku.com" required>
                    </div>
                    @error('email')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Hak Akses (Role)</label>
                    <select id="roleSelect" class="form-select border-0 bg-light py-2 fw-medium @error('role') is-invalid @enderror" name="role" onchange="toggleDetailFields()" required>
                      <option value="" selected disabled>-- Pilih Hak Akses Sistem --</option>
                      <option value="dokter" {{ old('role') == 'dokter' ? 'selected' : '' }}>Dokter (Akses Penulisan Resep)</option>
                      <option value="apoteker" {{ old('role') == 'apoteker' ? 'selected' : '' }}>Apoteker (Akses Inventaris & Penyerahan)</option>
                      <option value="pasien" {{ old('role') == 'pasien' ? 'selected' : '' }}>Pasien (Akses Jadwal Minum Obat)</option>
                      <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Pusat Kendali)</option>
                    </select>
                    @error('role')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12 mt-4">
                    <div id="formDokter">
                      <label class="form-label small fw-bold text-muted">Poliklinik</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-building text-muted"></i></span>
                        <input type="text" name="poli" id="inputPoli" class="form-control border-0 bg-light py-2 @error('poli') is-invalid @enderror" value="{{ old('poli') }}" placeholder="Contoh: Poli Umum" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div id="formPasien">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label small fw-bold text-muted">NIK (16 Digit)</label>
                          <input type="text" name="nik" id="inputNik" class="form-control border-0 bg-light py-2 @error('nik') is-invalid @enderror" value="{{ old('nik') }}" value="{{ old('nik') }}" maxlength="16" placeholder="Contoh: 3598394931919994">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                          <input type="date" name="tanggal_lahir" id="inputTgl" class="form-control border-0 bg-light py-2 @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div class="col-md-12">
                          <label class="form-label small fw-bold text-muted">Jenis Kelamin</label>
                          <select name="jenis_kelamin" class="form-select border-0 bg-light py-2 fw-medium @error('jenis_kelamin') is-invalid @enderror">
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-5">
                <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: #6610f2;">Keamanan Akun</h6>

                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Kata Sandi (Password)</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-key text-muted"></i></span>
                      <input type="password" class="form-control border-0 bg-light py-2 @error('password') is-invalid @enderror" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    @error('password')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-shield-check text-muted"></i></span>
                      <input type="password" class="form-control border-0 bg-light py-2" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    </div>
                  </div>
                </div>

                <div class="alert alert-info bg-opacity-10 border-0 border-start border-info border-4 shadow-sm rounded-4 mt-4 small">
                  <i class="bi bi-info-circle-fill text-info me-2"></i>
                  Pastikan email yang didaftarkan aktif. Pengguna dapat mengubah kata sandi ini nanti melalui halaman Profil mereka masing-masing.
                </div>
              </div>

              <div class="col-md-7">
                <div class="col-12">
                  <div class="d-flex justify-content-between pt-3 border-top">
                    <div class="col-md-3">
                      <a href="{{ url('/manajemen-user') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2 fw-medium">
                        Batal
                      </a>
                    </div>
                    <div class="col-md-5">
                      <button type="submit" class="btn text-white w-100 rounded-pill py-2 fw-bold shadow-sm" style="background-color: #6610f2; border-color: #6610f2;">
                        <i class="bi bi-person-check-fill me-2"></i>Daftarkan Pengguna
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

  <script>
    function toggleDetailFields() {
      const role = document.getElementById('roleSelect').value;

      const formDokter = document.getElementById('formDokter');
      const formPasien = document.getElementById('formPasien');

      const inputPoli = document.getElementById('inputPoli');
      const inputNik = document.getElementById('inputNik');
      const inputTgl = document.getElementById('inputTgl');

      formDokter.style.display = 'none';
      formPasien.style.display = 'none';

      inputPoli.required = false;
      inputNik.required = false;
      inputTgl.required = false;

      if (role === 'dokter') {
        formDokter.style.display = 'block';
        inputPoli.required = true;
      } else if (role === 'pasien') {
        formPasien.style.display = 'block';
        inputNik.required = true;
        inputTgl.required = true;
      }
    }

    document.addEventListener("DOMContentLoaded", toggleDetailFields);

  </script>
</x-app-layout>

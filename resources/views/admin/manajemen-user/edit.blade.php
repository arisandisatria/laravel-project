<x-app-layout>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="d-flex align-items-center mb-4">
        <div>
          <h2 class="h4 fw-bold text-dark mb-0">Edit Data Pengguna</h2>
          <p class="text-muted small mb-0">Perbarui informasi profil atau reset kata sandi pengguna.</p>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
          <form action="{{ route('manajemen-user.update', $editUser->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4 align-items-start">

              <div class="col-md-7">
                <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: #6610f2;">Informasi Dasar</h6>

                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                      <input type="text" class="form-control border-0 bg-light py-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name', $editUser->name) }}" required>
                    </div>
                    @error('name')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Alamat Email</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                      <input type="email" class="form-control border-0 bg-light py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email', $editUser->email) }}" required>
                    </div>
                    @error('email')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12 mt-4">
                    <label class="form-label small fw-bold text-muted">Hak Akses (Role)</label>
                    <select id="roleSelect" class="form-select border-0 bg-light py-2 fw-medium @error('role') is-invalid @enderror" name="role" onchange="toggleDetailFields()" required>
                      <option value="admin" {{ $editUser->role == 'admin' ? 'selected' : '' }}>Admin (Akses Pusat Kendali)</option>
                      <option value="dokter" {{ $editUser->role == 'dokter' ? 'selected' : '' }}>Dokter (Akses Penulisan Resep)</option>
                      <option value="apoteker" {{ $editUser->role == 'apoteker' ? 'selected' : '' }}>Apoteker (Akses Inventaris & Penyerahan)</option>
                      <option value="pasien" {{ $editUser->role == 'pasien' ? 'selected' : '' }}>Pasien (Akses Jadwal Minum Obat)</option>
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
                        <input type="text" name="poli" id="inputPoli" class="form-control border-0 bg-light py-2 @error('poli') is-invalid @enderror" value="{{ old('poli', $editUser->dokter?->poli) }}" placeholder="Contoh: Poli Umum" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div id="formPasien">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label small fw-bold text-muted">NIK (16 Digit)</label>
                          <input type="text" name="nik" id="inputNik" class="form-control border-0 bg-light py-2 @error('nik') is-invalid @enderror" value="{{ old('nik', $editUser->pasien?->nik) }}" value="{{ old('nik') }}" maxlength="16" placeholder="Contoh: 3598394931919994">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                          <input type="date" name="tanggal_lahir" id="inputTgl" class="form-control border-0 bg-light py-2 @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $editUser->pasien?->tanggal_lahir ?? '') }}">
                        </div>
                        <div class="col-md-12">
                          <label class="form-label small fw-bold text-muted">Jenis Kelamin</label>
                          <select name="jenis_kelamin" class="form-select border-0 bg-light py-2 fw-medium @error('jenis_kelamin') is-invalid @enderror">
                            <option value="Laki-laki" {{ $editUser->pasien?->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $editUser->pasien?->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: #6610f2;">Reset Kata Sandi</h6>

                <div class="alert alert-warning bg-opacity-10 border-0 border-start border-warning border-4 shadow-sm rounded-4 mb-4 small text-dark">
                  <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                  <strong>Kosongkan kolom di bawah ini</strong> jika Anda tidak ingin mengubah kata sandi pengguna saat ini.
                </div>

                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Kata Sandi Baru</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-key text-muted"></i></span>
                      <input type="password" class="form-control border-0 bg-light py-2 @error('password') is-invalid @enderror" name="password" placeholder="Ketik kata sandi baru (Opsional)">
                    </div>
                    @error('password')
                    <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label class="form-label small fw-bold text-muted">Konfirmasi Kata Sandi Baru</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-0"><i class="bi bi-shield-check text-muted"></i></span>
                      <input type="password" class="form-control border-0 bg-light py-2" name="password_confirmation" placeholder="Ulangi kata sandi baru">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-5">
                <div class="d-flex justify-content-between pt-3 border-top">
                  <div class="col-md-3">
                    <a href="{{ url('/manajemen-user') }}" class="btn btn-outline-secondary w-100 rounded-pill py-2 fw-medium">
                      Batal
                    </a>
                  </div>
                  <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn text-white w-100 rounded-pill py-2 fw-bold shadow-sm" style="background-color: #6610f2; border-color: #6610f2;">
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

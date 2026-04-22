<x-app-layout>
  <div class="d-flex justify-content-between align-items-start mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Permintaan Resep</h2>
      <p class="text-muted small">Kelola antrean dan pantau riwayat penyerahan obat.</p>
    </div>
    <div class="bg-white p-2 rounded-pill shadow-sm px-3 border">
      <small class="fw-bold text-primary"><i class="bi bi-clock-history me-1"></i> Antrean: {{ $totalAntrean }} Resep</small>
    </div>
  </div>

  <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border">
    <li class="nav-item">
      <a class="nav-link active rounded-pill px-4" href="{{ route('permintaan-resep.index', ['tab' => 'aktif']) }}">
        <i class="bi bi-hourglass-split me-1"></i>Antrean Aktif
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link rounded-pill px-4" href="{{ route('permintaan-resep.index', ['tab' => 'selesai']) }}">
        <i class="bi bi-check-all me-1"></i>Riwayat Selesai
      </a>
    </li>
  </ul>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <div class="row g-2 align-items-center justify-content-between">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari nama pasien atau ID resep...">
          </div>
        </div>
        <div class="col-md-4">
          <select class="form-select border-0 bg-light rounded-3 shadow-none small">
            <option selected>Semua Urgensi</option>
            <option>Segera (Cito)</option>
            <option>Normal</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-dark w-100 rounded-3">Cari</button>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">Waktu Masuk</th>
            <th class="border-0 text-muted small text-uppercase">ID Resep</th>
            <th class="border-0 text-muted small text-uppercase">Pasien</th>
            <th class="border-0 text-muted small text-uppercase">Dokter</th>
            <th class="border-0 text-muted small text-uppercase">Status</th>
            <th class="border-0 text-muted small text-uppercase text-end pe-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ps-4">
              <span class="fw-bold text-dark">09:45</span>
              <small class="d-block text-muted">Hari Ini</small>
            </td>
            <td><span class="badge bg-light text-primary border border-primary border-opacity-25">#RSP-101</span></td>
            <td>
              <div class="fw-bold text-dark">Andi Wijaya</div>
              <small class="text-muted">Umur: 32 Thn</small>
            </td>
            <td>
              <div class="small fw-medium">dr. Andi Hermawan</div>
            </td>
            <td>
              <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill small">
                <i class="bi bi-hourglass-split me-1"></i> Menunggu
              </span>
            </td>
            <td class="text-end pe-4">
              <a href="{{ url('/permintaan-resep/proses/1') }}" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">
                Proses Obat
              </a>
            </td>
          </tr>

          <tr>
            <td class="ps-4">
              <span class="fw-bold text-dark">09:30</span>
              <small class="d-block text-muted">Hari Ini</small>
            </td>
            <td><span class="badge bg-light text-primary border border-primary border-opacity-25">#RSP-100</span></td>
            <td>
              <div class="fw-bold text-dark">Budi Santoso</div>
              <small class="text-muted">Umur: 45 Thn</small>
            </td>
            <td>
              <div class="small fw-medium">dr. Sarah</div>
            </td>
            <td>
              <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill small">
                <i class="bi bi-box-seam me-1"></i> Disiapkan
              </span>
            </td>
            <td class="text-end pe-4">
              <a href="{{ url('/permintaan-resep/proses/1') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">
                Lanjutkan
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white border-top-0 py-3 text-center">
      <small class="text-muted">Gunakan tombol <strong class="text-dark">Proses Obat</strong> untuk mulai memvalidasi item resep.</small>
    </div>
  </div>
</x-app-layout>

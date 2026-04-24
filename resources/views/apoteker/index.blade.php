<x-app-layout>
  <style>
    .border-dashed {
      border-style: dashed !important;
    }

  </style>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Apoteker Panel</h2>
      <p class="text-muted small mb-0">Kelola persediaan obat dan validasi resep masuk.</p>
    </div>
    <span class="text-dark small bg-white px-3 py-2 rounded-pill shadow-sm border">
      <i class="bi bi-calendar3 me-1"></i> {{ date('d F Y') }}
    </span>
  </div>

  <div class="card shadow-sm border-0 rounded-4 mb-4 bg-primary text-white overflow-hidden">
    <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
      <div style="z-index: 1;">
        <h4 class="fw-bold mb-1">Halo, Apt. {{ Auth::user()->name }}! 💊</h4>
        <p class="mb-0 text-white-50 small">Ada <span class="text-white fw-bold fs-5">5</span> resep baru yang perlu divalidasi hari ini.</p>
      </div>
      <div class="d-none d-md-block opacity-25">
        <i class="bi bi-capsule-pill" style="font-size: 5rem;"></i>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4">
          <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-receipt fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Resep Masuk</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $resepBaru }} <span class="fs-6 text-muted fw-normal">Baru</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4">
          <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-bag-check fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Siap Diambil</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $resepSelesai }} <span class="fs-6 text-muted fw-normal">Selesai</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100 border-start border-danger border-4">
        <div class="card-body p-4">
          <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-exclamation-octagon fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Stok Kritis</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $stokKritisCount }} <span class="fs-6 text-muted fw-normal">Item</span></h3>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-body p-4">
          <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 text-center mb-3 d-inline-block">
            <i class="bi bi-box-seam fs-4"></i>
          </div>
          <h6 class="text-muted fw-semibold mb-1 small">Total Master Obat</h6>
          <h3 class="fw-bold mb-0 text-dark">{{ $totalObat }} <span class="fs-6 text-muted fw-normal">Item</span></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
          <h5 class="fw-bold text-dark mb-0">Antrean Resep Masuk</h5>
          <a href="{{ url('/permintaan-resep') }}" class="btn btn-sm btn-link link-underline link-underline-opacity-0 link-underline-opacity-100-hover link-offset-2">Lihat Semua</a>
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light text-muted small">
                <tr>
                  <th class="border-0 rounded-start">ID Resep</th>
                  <th class="border-0">Pasien</th>
                  <th class="border-0 rounded-end">Dokter</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($antreanResep as $item)
                <tr>
                  <td class="text-primary fw-bold">{{ $item->kode_resep }}</td>
                  <td>{{ $item->rekamMedis->pasien->user->name }}</td>
                  <td class="text-muted">{{ $item->rekamMedis->dokter->user->name }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center py-3 text-muted">Tidak ada antrean resep baru.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
          <h5 class="fw-bold text-dark mb-0">Manajemen Gudang</h5>
        </div>
        <div class="card-body p-4">
          <div class="d-grid gap-3">
            <a href="{{ url('/stok-obat/create') }}" class="btn btn-outline-primary text-start p-3 rounded-4 d-flex align-items-center text-decoration-none">
              <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-plus-circle"></i></div>
              <div>
                <h6 class="fw-bold mb-0">Tambah Stok Obat</h6>
                <span class="small text-muted">Input stok barang masuk</span>
              </div>
            </a>
            <a href="{{ url('/stok-obat') }}" class="btn btn-outline-dark text-start p-3 rounded-4 d-flex align-items-center text-decoration-none border-dashed">
              <div class="bg-dark text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-list-check"></i></div>
              <div>
                <h6 class="fw-bold mb-0">Cek Stok Obat</h6>
                <span class="small opacity-75">Lihat semua data & harga</span>
              </div>
            </a>
          </div>

          <hr class="my-4 text-muted">

          <div class="d-flex flex-column gap-2">
            @forelse ($peringatanStok as $stok)
            <h6 class="fw-bold text-dark mb-3">Peringatan Stok</h6>
            <div class="alert alert-danger border-0 shadow-sm rounded-4 small mb-0">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              {{ $stok->nama_obat }} sisa <strong>{{ $stok->stok }} {{ $stok->satuan }}</strong>. Segera buat pesanan baru.
            </div>
            @empty
            <div class="alert alert-success mb-0 py-2 small border-0">
              <i class="bi bi-check-circle-fill me-2"></i>
              Stok obat aman terkendali.
            </div>
            @endforelse
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

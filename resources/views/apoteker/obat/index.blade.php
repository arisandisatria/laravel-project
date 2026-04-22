<x-app-layout>
  <style>
    .table-danger {
      background-color: rgba(220, 53, 69, 0.05) !important;
    }

    .form-control:focus,
    .form-select:focus {
      background-color: #fff !important;
      border: 1px solid #198754 !important;
      box-shadow: none;
    }

  </style>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Inventaris Obat</h2>
      <p class="text-muted small mb-0">Kelola ketersediaan stok, harga, dan kategori obat apotek.</p>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ url('/stok-obat/create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
        <i class="bi bi-plus-lg me-2"></i>Tambah Obat Baru
      </a>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-body p-3">
          <form action="{{ route('stok-obat.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari nama obat atau kode..." value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-md-4">
              <select name="kategori" class="form-select border-0 bg-light rounded-3 shadow-none small">
                <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="Antibiotik" {{ request('kategori') == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
                <option value="Vitamin" {{ request('kategori') == 'Vitamin' ? 'selected' : '' }}>Vitamin</option>
                <option value="Analgetik" {{ request('kategori') == 'Analgetik' ? 'selected' : '' }}>Analgetik</option>
              </select>
            </div>

            <div class="col-md-2">
              <button type="submit" class="btn btn-dark w-100 rounded-3">Cari</button>
            </div>

            @if(request('search') || (request('kategori') && request('kategori') != 'all'))
            <a href="{{ route('stok-obat.index') }}" class="btn btn-outline-danger px-3 rounded-3" title="Hapus Filter">
              <i class="bi bi-x-lg"></i>
            </a>
            @endif
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      @if ($itemKritis > 0)
      <div class="card border-0 shadow-sm rounded-4 h-100 bg-danger bg-opacity-10">
        <div class="card-body d-flex align-items-center p-3 text-danger">
          <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
          <div>
            <h6 class="mb-0 fw-bold">{{ $itemKritis }} Item Kritis</h6>
            <small>Stok di bawah batas minimal.</small>
          </div>
        </div>
      </div>
      @else
      <div class="card border-0 shadow-sm rounded-4 h-100 bg-success bg-opacity-10">
        <div class="card-body d-flex align-items-center p-3 text-success">
          <i class="bi bi-check-circle-fill fs-3 me-3"></i>
          <div>
            <h6 class="mb-0 fw-bold">Stok Aman Terkendali</h6>
            <small>Tidak ada item di bawah batas minimal.</small>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="ps-4 py-3 border-0 text-muted small text-uppercase">Kode</th>
            <th class="border-0 text-muted small text-uppercase">Nama Obat</th>
            <th class="border-0 text-muted small text-uppercase">Kategori</th>
            <th class="border-0 text-muted small text-uppercase text-center">Stok</th>
            <th class="border-0 text-muted small text-uppercase text-center">Expired Date</th>
            <th class="border-0 text-muted small text-uppercase text-end">Harga Satuan</th>
            <th class="border-0 text-muted small text-uppercase text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($obat as $item)
          <tr class="{{ $item->stok < 10 ? 'table-danger bg-opacity-10' : '' }}">
            <td class="ps-4 text-muted small">{{ $item->kode_obat }}</td>
            <td>
              <div class="fw-bold text-dark">{{ $item->nama_obat }}</div>
              <small class="text-muted">Satuan: {{ $item->satuan }}</small>
              @if($item->stok < 10) <br>
                <small class="text-muted text-danger fw-bold"><i class="bi bi-info-circle me-1"></i>Stok Menipis</small>
                @endif
            </td>
            <td><span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill">{{ $item->kategori }}</span></td>
            <td class="text-center">
              <span class="fw-bold @if($item->stok < 20) text-danger @endif">{{ $item->stok }}</span>
            </td>
            <td class="text-center">
              @if($item->tanggal_expired)
              <span class="small fw-medium {{ $item->tanggal_expired->isPast() ? 'text-danger fw-bold' : 'text-dark' }}">
                {{ $item->tanggal_expired->format('d M Y') }}
              </span>
              @if($item->tanggal_expired->isPast())
              <br><small class="badge bg-danger mt-1">Kedaluwarsa!</small>
              @endif
              @else
              <span class="text-muted fst-italic">-</span>
              @endif
            </td>
            <td class="text-end">Rp {{ $item->harga }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('stok-obat.edit', $item->id) }}" class="btn btn-sm btn-light rounded-circle shadow-sm border" title="Edit Data Obat"><i class="bi bi-pencil-square text-warning"></i></a>
                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm border" data-bs-toggle="modal" data-bs-target="#modalHapusObat{{ $item->id }}" title="Hapus dari Inventaris">
                  <i class="bi bi-trash text-danger"></i>
                </button>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalHapusObat{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
              <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-body p-4 text-center">
                  <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
                  </div>
                  <h5 class="fw-bold text-dark">Hapus Obat?</h5>
                  <p class="text-muted small">Tindakan ini akan menghapus <strong id="namaObatHapus">{{ $item->nama_obat }}</strong> dari daftar inventaris secara permanen.</p>

                  <div class="d-flex flex-column gap-2 align-items-center mt-4">
                    <form action="{{ route('stok-obat.destroy', $item->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">Ya, Hapus Obat</button>
                    </form>
                    <button type="button" class="btn btn-link btn-sm text-muted" style="width: fit-content;" data-bs-dismiss="modal">Batal</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white border-top-0 py-3">
      {{ $obat->links('pagination::bootstrap-5') }}
    </div>
  </div>


</x-app-layout>

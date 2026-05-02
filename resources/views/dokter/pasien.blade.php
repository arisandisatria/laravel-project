<x-app-layout>

  <style>
    .timeline {
      padding-left: 10px;
    }

    .form-control:focus {
      border-color: #0d6efd;
    }

    .timeline-action {
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
    }

    .timeline-item:hover .timeline-action {
      opacity: 1;
    }

  </style>

  <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div>
      <h2 class="h4 fw-bold text-dark mb-0">Data Riwayat Pasien</h2>
      <p class="text-muted small mb-0">Cari dan tinjau riwayat medis pasien untuk diagnosa yang lebih akurat.</p>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
      <form action="{{ route('dokter.pasien') }}" method="GET" class="row g-2 align-items-center justify-content-between">
        <div class="col-12 col-md-10">
          <div class="input-group">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-0 shadow-none" name="search" placeholder="Masukkan Nama Pasien untuk melihat riwayat..." value="{{ request('search') }}">
          </div>
        </div>
        <div class="col-12 col-md-2">
          <button type="submit" class="btn btn-dark w-100 rounded-3">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0 text-nowrap">
        <thead class="bg-light">
          <tr>
            <th class="ps-3 ps-md-4 py-3 border-0 text-muted small">ID PASIEN</th>
            <th class="border-0 text-muted small">NAMA PASIEN</th>
            <th class="border-0 text-muted small">INFO DASAR</th>
            <th class="border-0 text-muted small">KUNJUNGAN TERAKHIR</th>
            <th class="border-0 text-muted small text-center pe-3 pe-md-4">AKSI</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pasiens as $pasien)
          <tr>
            <td class="ps-3 ps-md-4 fw-bold text-primary">PAS-{{ str_pad($pasien->id, 3, '0', STR_PAD_LEFT) }}</td>
            <td>
              <div class="fw-bold text-dark">{{ $pasien->user->name ?? 'Data Kosong' }}</div>
            </td>
            <td>
              <span class="badge bg-light text-dark border fw-normal">{{ $pasien->jenis_kelamin }}</span>
              <span class="badge bg-light text-dark border fw-normal">{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Thn</span>
            </td>
            <td>
              @if($pasien->rekamMedis->isNotEmpty())
              {{ $pasien->rekamMedis->first()->created_at->format('d F Y') }}
              @else
              <span class="text-muted small">Belum ada kunjungan</span>
              @endif
            </td>
            <td class="text-center pe-3 pe-md-4">
              <div class="d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalRiwayat-{{ $pasien->id }}" title="Lihat Riwayat Medis">
                  <i class="bi bi-journal-text me-1"></i> Riwayat
                </button>

                <a href="{{ route('dokter.rekam-medis.periksa', $pasien->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm fw-bold" title="Tambah Pemeriksaan Baru">
                  <i class="bi bi-plus-lg me-1"></i> Periksa Pasien
                </a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalRiwayat-{{ $pasien->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
              <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header border-bottom-0 pb-0 mt-3 mx-2">
                  <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-file-earmark-medical text-primary me-2"></i>Riwayat Medis: {{ $pasien->user->name ?? 'Pasien' }}
                  </h5>
                  <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3 p-md-4">
                  @if($pasien->rekamMedis->isEmpty())
                  <div class="text-center text-muted py-5">
                    <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                    Belum ada catatan riwayat medis untuk pasien ini.
                  </div>
                  @else
                  <div class="position-relative ms-2 ms-md-3 border-start border-2 border-primary border-opacity-25 pb-2">

                    @foreach($pasien->rekamMedis as $rm)
                    <div class="position-relative mb-4 ms-3 ms-md-4">
                      <span class="position-absolute top-0 start-0 translate-middle bg-primary border border-white border-2 rounded-circle" style="width: 14px; height: 14px; margin-left: -1rem; margin-top: 0.4rem;"></span>

                      <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center mb-2 gap-2">
                        <span class="fw-bold text-dark">{{ $rm->created_at->format('d F Y') }}</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-2 py-1 small">
                          {{ $rm->dokter->user->name ?? 'dr. Tidak Diketahui' }}
                        </span>
                      </div>

                      <div class="bg-light bg-opacity-50 border border-light-subtle rounded-3 p-3 shadow-sm position-relative">
                        @if(auth()->id() === $rm->dokter->user_id)
                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-1">
                          <a href="{{ url('/dokter/rekam-medis/'.$rm->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm text-warning py-0 px-2" title="Edit Data">
                            <i class="bi bi-pencil-square small"></i>
                          </a>
                          <button type="button" class="btn btn-sm btn-white border shadow-sm text-danger py-0 px-2" data-bs-toggle="modal" data-bs-target="#modalHapusRekamMedis{{ $rm->id }}" title="Hapus Data">
                            <i class="bi bi-trash small"></i>
                          </button>
                        </div>
                        @endif

                        <div class="small text-muted mb-1 mt-3 mt-sm-0">Diagnosa/Keluhan:</div>
                        <div class="text-dark fw-medium mb-3 text-wrap">
                          {{ $rm->keluhan_utama }} {{ $rm->diagnosa ? '- ' . $rm->diagnosa : '' }}
                        </div>

                        @if($rm->reseps->isNotEmpty())
                        <div class="small text-muted mb-2">Resep Obat:</div>
                        <div class="d-flex flex-wrap gap-2">
                          @foreach($rm->reseps as $resep)
                          @if($resep->obat)
                          <span class="badge bg-white text-dark border border-secondary-subtle fw-normal py-1 px-2 text-wrap text-start">
                            {{ $resep->obat->nama_obat }}
                          </span>
                          @endif
                          @endforeach
                        </div>
                        @endif
                      </div>

                    </div>
                    @endforeach

                  </div>
                  @endif
                </div>

              </div>
            </div>
          </div>

          @foreach($pasien->rekamMedis as $rm)
          <div class="modal fade" id="modalHapusRekamMedis{{ $rm->id }}" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content border-0 shadow-lg rounded-4 text-center">
                <div class="modal-body p-4">
                  <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-octagon" style="font-size: 3rem;"></i>
                  </div>
                  <h5 class="fw-bold">Hapus Rekam Medis?</h5>
                  <p class="text-muted small">Catatan medis tanggal {{ $rm->created_at->format('d M Y') }} akan dihapus permanen. Resep yang terkait mungkin juga akan ikut terhapus.</p>

                  <form action="{{ url('/dokter/rekam-medis/'.$rm->id) }}" method="POST" class="d-inline w-100">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex flex-column gap-2 align-items-center mt-4">
                      <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">Ya, Hapus Data</button>
                      <button type="button" class="btn btn-link btn-sm text-muted" style="width: fit-content;" data-bs-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          @empty
          <tr>
            <td colspan="5" class="text-center py-5 text-muted">
              <i class="bi bi-person-x fs-2 d-block mb-2"></i>
              Tidak ada data pasien yang ditemukan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</x-app-layout>

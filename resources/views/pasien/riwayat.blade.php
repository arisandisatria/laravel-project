<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengobatan</h2>
    <p class="text-muted">Kelola jadwal konsumsi obat harian dan arsip resep medis Anda.</p>
  </div>

  <div class="d-flex gap-2 mb-4 bg-white p-2 rounded-pill shadow-sm" style="width: fit-content;">
    <a href="{{ route('pasien.jadwal') }}" class="btn btn-light bg-transparent border-0 rounded-pill px-4 text-muted fw-medium hover-bg-light">
      <i class="bi bi-calendar2-check me-2"></i>Jadwal
    </a>
    <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-primary rounded-pill px-4 fw-medium">
      <i class="bi bi-file-earmark-medical me-2"></i>Riwayat Resep
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-9">

      <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="table-responsive">
          <table class="table align-middle table-hover mb-0">
            <thead class="bg-light">
              <tr>
                <th class="ps-4 py-3 border-0 text-muted small text-uppercase" style="width: 20%;">Tanggal</th>
                <th class="border-0 text-muted small text-uppercase" style="width: 25%;">Dokter & Diagnosa</th>
                <th class="border-0 text-muted small text-uppercase" style="width: 40%;">Daftar Obat & Aturan</th>
                <th class="border-0 text-muted small text-uppercase text-center" style="width: 15%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($riwayatRekamMedis as $rm)
              <tr>
                <td class="ps-4">
                  <div class="fw-bold text-dark">{{ $rm->created_at->format('d M Y') }}</div>
                  <span class="badge bg-light text-dark border mt-1">#RM-{{ str_pad($rm->id, 4, '0', STR_PAD_LEFT) }}</span>
                </td>
                <td>
                  <div class="fw-bold text-primary small mb-1">
                    <i class="bi bi-person-badge me-1"></i> {{ $rm->dokter->user->name }}
                  </div>
                  <div class="text-muted small text-wrap" style="max-width: 250px;">
                    {{ \Illuminate\Support\Str::limit($rm->diagnosa ?? $rm->keluhan_utama, 50) }}
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column gap-2 my-2">
                    @foreach($rm->reseps as $resep)
                    <div class="bg-light p-2 rounded-3 border border-light-subtle d-flex justify-content-between align-items-center">
                      <div>
                        <span class="fw-bold text-dark small">{{ optional($resep->obat)->nama_obat ?? 'Obat Dihapus' }}</span>
                        <div class="text-muted" style="font-size: 0.7rem;">{{ $resep->aturan }}</div>
                      </div>
                      <span class="badge bg-white text-dark border">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
                    </div>
                    @endforeach
                  </div>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $rm->id }}">
                    Detail
                  </button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center py-5">
                  <i class="bi bi-folder-x fs-1 text-muted d-block mb-2"></i>
                  <h6 class="fw-bold text-muted mb-0">Belum Ada Riwayat</h6>
                  <p class="small text-muted mb-0">Anda belum memiliki arsip resep medis.</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($riwayatRekamMedis->hasPages())
        <div class="card-footer bg-white border-top py-3">
          {{ $riwayatRekamMedis->links('pagination::bootstrap-5') }}
        </div>
        @endif
      </div>

    </div>

    <div class="col-lg-3">
      <div class="card shadow-sm border-0 rounded-4 bg-info text-white mb-4">
        <div class="card-body p-4">
          <h6 class="fw-bold"><i class="bi bi-shield-check me-2"></i>Keamanan Data</h6>
          <p class="small text-white-50 mb-0">Data riwayat medis Anda dienkripsi dan hanya dapat diakses oleh Anda dan tenaga medis terkait.</p>
        </div>
      </div>
    </div>
  </div>

  @foreach($riwayatRekamMedis as $rm)
  <div class="modal fade" id="modalDetail-{{ $rm->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-0 pt-4 px-4 pb-0">
          <h5 class="fw-bold mb-0 text-primary">Detail Pemeriksaan</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-3 border-bottom pb-3">
            <span class="text-muted small d-block">Diagnosa Lengkap:</span>
            <span class="text-dark fw-medium">{{ $rm->diagnosa ?? $rm->keluhan_utama }}</span>
          </div>

          <h6 class="fw-bold small mb-3">Detail Resep:</h6>
          <ul class="list-group list-group-flush border rounded-3 mb-0">
            @foreach($rm->reseps as $resep)
            <li class="list-group-item d-flex justify-content-between align-items-center p-3 small">
              <div>
                <strong class="d-block">{{ optional($resep->obat)->nama_obat }}</strong>
                <span class="text-muted">{{ $resep->aturan }}</span>
              </div>
              <span class="badge bg-primary rounded-pill px-3">{{ $resep->jumlah }} {{ optional($resep->obat)->satuan }}</span>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endforeach

</x-app-layout>

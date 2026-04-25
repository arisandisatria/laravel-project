<x-app-layout>
  <div class="mb-4">
    <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengobatan</h2>
    <p class="text-muted">Kelola jadwal konsumsi obat harian dan log riwayat Anda.</p>
  </div>

  <div class="d-flex gap-2 mb-4 bg-white p-2 rounded-pill shadow-sm" style="width: fit-content;">
    <a href="{{ route('pasien.jadwal') }}" class="btn btn-primary rounded-pill px-4 fw-medium">
      <i class="bi bi-calendar2-check me-2"></i>Jadwal
    </a>
    <a href="{{ route('pasien.riwayat-resep') }}" class="btn btn-light bg-transparent border-0 rounded-pill px-4 text-muted fw-medium hover-bg-light">
      <i class="bi bi-file-earmark-medical me-2"></i>Riwayat Resep
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <h6 class="fw-bold mb-3"><i class="bi bi-alarm me-2 text-primary"></i>Perlu Diminum Hari Ini</h6>

      @forelse($resepAktif as $resep)
      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between">
            <div>
              <span class="badge bg-primary mb-2">{{ $resep->aturan }}</span>
              <h5 class="fw-bold mb-1">{{ optional($resep->obat)->nama_obat }}</h5>
              <p class="small text-muted mb-3">Aturan: {{ $resep->aturan }}</p>
            </div>
          </div>

          <div class="row g-3">
            @php
            $sudahPagi = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Pagi')->isNotEmpty();
            $sudahSiang = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Siang')->isNotEmpty();
            $sudahMalam = $logHariIni->where('resep_id', $resep->id)->where('waktu', 'Malam')->isNotEmpty();

            $kaliSehari = (int) filter_var($resep->aturan, FILTER_SANITIZE_NUMBER_INT);
            @endphp

            @if($kaliSehari >= 1)
            <div class="col-md-4">
              @if($sudahPagi)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-3 p-3 text-center">
                <i class="bi bi-check-circle-fill fs-4 d-block mb-1"></i>
                <h6 class="fw-bold mb-0">Pagi</h6>
                <small>Selesai</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Pagi">
                <button type="submit" class="btn btn-outline-success border-2 w-100 p-3 rounded-3 text-center">
                  <i class="bi bi-brightness-alt-high fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0">Pagi (07:00)</h6>
                  <small>Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

            @if($kaliSehari >= 3)
            <div class="col-md-4">
              @if($sudahSiang)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-3 p-3 text-center">
                <i class="bi bi-check-circle-fill fs-4 d-block mb-1"></i>
                <h6 class="fw-bold mb-0">Siang</h6>
                <small>Selesai</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Siang">
                <button type="submit" class="btn btn-outline-success border-2 w-100 p-3 rounded-3 text-center">
                  <i class="bi bi-sun fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0">Siang (13:00)</h6>
                  <small>Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

            @if($kaliSehari >= 2)
            <div class="col-md-4">
              @if($sudahMalam)
              <div class="border border-success bg-success bg-opacity-10 text-success rounded-3 p-3 text-center">
                <i class="bi bi-check-circle-fill fs-4 d-block mb-1"></i>
                <h6 class="fw-bold mb-0">Malam</h6>
                <small>Selesai</small>
              </div>
              @else
              <form action="{{ route('pasien.jadwal.tandai') }}" method="POST">
                @csrf
                <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                <input type="hidden" name="waktu" value="Malam">
                <button type="submit" class="btn btn-outline-success border-2 w-100 p-3 rounded-3 text-center">
                  <i class="bi bi-moon-stars fs-4 d-block mb-1"></i>
                  <h6 class="fw-bold mb-0">Malam (20:00)</h6>
                  <small>Klik Jika Sudah</small>
                </button>
              </form>
              @endif
            </div>
            @endif

          </div>
        </div>
      </div>
      @empty
      <div class="card border-0 shadow-sm rounded-4 text-center py-5">
        <p class="text-muted mb-0">Belum ada resep obat yang aktif saat ini.</p>
      </div>
      @endforelse
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Log Konsumsi</h6>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle small mb-0">
              <thead class="border-bottom">
                <tr>
                  <th class="ps-4">Obat</th>
                  <th>Waktu</th>
                  <th class="pe-4 text-end">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($logRiwayat as $log)
                <tr>
                  <td class="ps-4 fw-bold text-dark">{{ optional($log->resep->obat)->nama_obat }}</td>
                  <td class="text-muted">
                    {{ \Carbon\Carbon::parse($log->tanggal)->format('d M y') }} <br>
                    <span class="badge bg-light text-dark border">{{ $log->waktu }}</span>
                  </td>
                  <td class="pe-4 text-end">
                    <span class="badge bg-success rounded-pill">Diminum</span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center py-4 text-muted">Belum ada catatan konsumsi obat.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

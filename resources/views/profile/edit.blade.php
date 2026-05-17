<x-app-layout>
  <div class="row g-4 align-items-start">

    <div class="col-lg-4 sticky-lg-top" style="top: 100px; z-index: 1;">
      <div class="card shadow-sm border-0 rounded-4 text-center p-1 p-md-4">
        <div class="card-body">
          <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px;">
            <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
          </div>

          <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>

          <span class="badge bg-success bg-opacity-10 mt-2 text-success rounded-pill px-3 py-2 text-capitalize">
            Akun {{ Auth::user()->role }} Aktif
          </span>

          <div class="d-flex align-items-center w-100 mt-3">
            <div class="w-50 text-end pe-2 border-end border-secondary">
              <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
            </div>

            <div class="w-50 text-start ps-2">
              @if (Auth::user()->role == "pasien" && Auth::user()->pasien && Auth::user()->pasien->no_hp)
              <p class="text-muted small mb-0">
                <i class="bi bi-whatsapp text-success me-1"></i>{{ Auth::user()->pasien->no_hp }}
              </p>
              @else
              <p class="text-muted small mb-0 fst-italic">-</p>
              @endif
            </div>
          </div>

          <hr class="my-4 text-muted border-opacity-25">

          <div class="text-start">
            <label class="small text-muted d-block">Terdaftar Sejak:</label>
            <p class="fw-medium text-dark mb-0">{{ Auth::user()->created_at->format('d F Y') }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <div class="card shadow-sm border-0 rounded-4 border-danger border-top border-4">
        <div class="card-body p-4 p-md-5">
          @include('profile.partials.delete-user-form')
        </div>
      </div>

    </div>
  </div>
</x-app-layout>

<section>
  <header>
    <h4 class="mb-1 text-dark">{{ __('Informasi Profil') }}</h4>
    <p class="text-muted small mb-4">
      {{ __("Update informasi profil dan alamat email akun anda.") }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">{{ __('Nama Akun') }}</label>
      <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
      <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
      @error('email')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
      <div class="mt-2 text-muted small">
        {{ __('Alamat email belum diverifikasi!') }}

        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none small">
          {{ __('Klik disini untuk mengirim ulang email verifikasi.') }}
        </button>

        @if (session('status') === 'verification-link-sent')
        <p class="mt-2 text-success fw-medium">
          {{ __('Link verifikasi baru telah dikirim ke email anda.') }}
        </p>
        @endif
      </div>
      @endif
    </div>

    @if ($user->role == 'pasien' && $user->pasien)
    <div class="mb-3">
      <label for="no_hp" class="form-label fw-semibold">{{ __('Nomor WhatsApp') }}</label>
      <input id="no_hp" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $user->pasien->no_hp) }}" required autocomplete="tel">
      @error('no_hp')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    @endif

    <div class="d-flex align-items-center gap-3 mt-4">
      <button type="submit" class="btn btn-primary px-4">{{ __('Simpan') }}</button>

      @if (session('status') === 'profile-updated')
      <span class="text-success small fw-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
        {{ __('Tersimpan.') }}
      </span>
      @endif
    </div>
  </form>
</section>

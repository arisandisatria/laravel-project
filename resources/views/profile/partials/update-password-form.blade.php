<section>
  <header>
    <h4 class="mb-1 text-dark">{{ __('Update Password') }}</h4>
    <p class="text-muted small mb-4">
      {{ __('Pastikan akun anda menggunakan password acak dan panjang agar tetap aman.') }}
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
      <label for="update_password_current_password" class="form-label fw-semibold">{{ __('Password Sekarang') }}</label>
      <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
      @error('current_password', 'updatePassword')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="update_password_password" class="form-label fw-semibold">{{ __('Password Baru') }}</label>
      <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
      @error('password', 'updatePassword')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="update_password_password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
      <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
      @error('password_confirmation', 'updatePassword')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
      <button type="submit" class="btn btn-primary px-4">{{ __('Simpan') }}</button>

      @if (session('status') === 'password-updated')
      <span class="text-success small fw-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
        {{ __('Tersimpan.') }}
      </span>
      @endif
    </div>
  </form>
</section>

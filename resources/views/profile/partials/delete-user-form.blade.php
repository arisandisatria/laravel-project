<section>
  <header>
    <h4 class="text-danger mb-1">{{ __('Hapus Akun') }}</h4>
    <p class="text-muted small mb-4">
      {{ __('Ketika akun dihapus, semua data akan dihapus permanen. Mohon simpan dan backup semua data dan informasi yang anda simpan.') }}
    </p>
  </header>

  <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
    {{ __('Hapus Akun') }}
  </button>

  <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="post" action="{{ route('profile.destroy') }}" class="modal-content border-0 shadow">
        @csrf
        @method('delete')

        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="modal-title fs-5" id="confirmUserDeletionModalLabel">
            {{ __('Anda yakin ingin menghapus akun anda?') }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <p class="text-muted small mb-4">
            {{ __('Ketika akun dihapus, semua data akan dihapus permanen. Masukkan password anda untuk mengkonfirmasi bahwa anda ingin menghapus akun anda secara permanen.') }}
          </p>

          <div class="mb-3">
            <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="{{ __('Password') }}">
            @error('password', 'userDeletion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="modal-footer border-top-0 pt-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('Hapus Akun') }}</button>
        </div>
      </form>
    </div>
  </div>
</section>

@if ($errors->userDeletion->isNotEmpty())
<script type="module">
  document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
            myModal.show();
        });
    </script>
@endif

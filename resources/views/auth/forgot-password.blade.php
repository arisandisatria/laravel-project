<x-guest-layout>
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width: 50px; height: 50px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                      <path d="M5.338 1.59a59.768 59.768 0 0 0-2.836.856.896.896 0 0 0-.631.846c-.003.553-.02 4.148.807 6.467.818 2.298 2.39 4.31 4.322 5.561l.5.321.5-.321c1.932-1.251 3.504-3.263 4.322-5.561.827-2.319.81-5.914.807-6.467a.896.896 0 0 0-.631-.846c-.958-.3-1.922-.59-2.836-.856C8.898 1.156 8.1 1 8 1s-.898.156-1.662.59zM8 2.083c.764-.413 1.528-.564 2.228-.758.91-.253 1.83-.553 2.65-.826.002.502.016 3.842-.731 5.952-.73 2.053-2.146 3.738-3.647 4.718-1.501-.98-2.917-2.665-3.647-4.718-.747-2.11-.733-5.45-.731-5.952.82-.273 1.74-.573 2.65-.826C6.472 1.519 7.236 1.67 8 2.083z"/>
                      <path d="M8 8.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                </div>
                <h4 class="fw-bold text-dark">Pemulihan Akses</h4>
                <p class="text-muted small">Jangan khawatir. Masukkan email terdaftar Anda dan sistem kami akan mengirimkan tautan untuk mereset kata sandi.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success mb-4 text-center small fw-medium" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold text-secondary">{{ __('Alamat Email') }}</label>
                    <input id="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill">
                        {{ __('Kirim Tautan Pemulihan') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none small text-muted hover-primary">
                        &larr; Kembali ke halaman Masuk
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

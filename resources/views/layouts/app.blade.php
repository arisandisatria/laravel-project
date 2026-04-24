<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Obatku') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light" style="font-family: 'Inter', sans-serif; overflow-x: hidden;">

  @include('layouts.navigation')

  <main id="main-content" class="d-flex flex-column min-vh-100" style="margin-left: 260px; transition: all 0.3s;">

    @isset($header)
    <div class="bg-white border-bottom py-3 px-4 mb-4">
      {{ $header }}
    </div>
    @endisset

    <div class="container-fluid py-4">
      {{ $slot }}
    </div>

  </main>

  <footer class="bg-white py-4 border-top mt-auto">
    <div class="container-fluid px-4 text-center text-muted small">
      &copy; {{ date('Y') }} Obatku. Membangun Ekosistem Kesehatan Digital.
    </div>
  </footer>

  <script>
    document.getElementById('sidebarCollapse').addEventListener('click', function() {
      document.getElementById('sidebar').classList.toggle('active');

      if (window.innerWidth <= 992) {
        let sidebar = document.getElementById('sidebar');
        sidebar.style.marginLeft = sidebar.style.marginLeft === '0px' ? '-260px' : '0px';
      }
    });

  </script>
</body>
</html>

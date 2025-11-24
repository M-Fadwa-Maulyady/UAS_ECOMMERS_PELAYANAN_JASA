<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Jasaku Pekerja — Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ asset('ayam/pekerja.css') }}">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <x-sidebarJasa></x-sidebarJasa>

    <!-- Main -->
    <main class="main">
      {{ $slot }}
    </main>
  </div>

  <script src="{{ asset('ayam/pekerja.js') }}"></script>
</body>
</html>

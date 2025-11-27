<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Admin Dashboard — Jasa</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Font & ChartJS -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('ayam/admin.css') }}">
</head>
<body>
  <div class="app">
    <!-- SIDEBAR -->
    <x-sidebarAdmin></x-sidebarAdmin>
    



    <!-- HEADER -->

<header>
      <div class="hello">
        <div class="avatar">A</div>
        <div>
          <div style="opacity:.9;font-weight:600">Selamat datang, Admin</div>
          <div class="muted">Pantau performa bisnis & tim pekerja</div>
        </div>
      </div>
      <div class="actions">
        <input class="search" placeholder="Cari transaksi, pelanggan, pekerja..." />
        <button class="btn" id="btnRefresh">Refresh</button>
        <button class="btn primary" id="btnExport">Export Data</button>
      </div>
    </header>
    <!-- MAIN -->
    <main>
      {{ $slot }}
    </main>
  </div>

  <!-- JS -->
  <script src="{{ asset('ayam/admin.js') }}"></script>
</body>
</html>

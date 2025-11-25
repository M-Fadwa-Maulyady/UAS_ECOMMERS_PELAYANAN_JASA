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
  <style>
  /* Biar kolom tidak melebar seenaknya */
  .table-wrapper table th,
  .table-wrapper table td {
      white-space: nowrap;
  }

  /* Gambar fix size */
  .table-wrapper img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
  }

  /* Kolom otomatis menyesuaikan konten */
  .table-wrapper table {
      table-layout: auto;
  }

  /* Header lebih rapi */
  .table-wrapper thead th {
      font-weight: 600;
      font-size: 14px;
  }
</style>


</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <x-sidebarJasa></x-sidebarJasa>
    <header class="topbar">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Cari proyek, klien, file…">
        </div>

        <div class="top-actions">
          <div class="locale">
            <img src="https://flagcdn.com/w20/id.png" alt="ID">
            <span>Ind (ID)</span>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <button class="icon-btn"><i class="fa-regular fa-bell"></i></button>
          <div class="profile">
            <img src="https://i.pravatar.cc/100?img=15" alt="avatar">
            <div class="info">
              <strong>Rafli Saputra</strong>
              <span class="muted">Freelance Designer</span>
            </div>
          </div>
        </div>
      </header>
    <!-- Main -->
    <main class="main">
      {{ $slot }}
    </main>
  </div>

  <script src="{{ asset('ayam/pekerja.js') }}"></script>
</body>
</html>

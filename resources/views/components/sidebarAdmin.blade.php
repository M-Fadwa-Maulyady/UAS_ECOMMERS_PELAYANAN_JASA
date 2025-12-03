<aside class="sidebar">

    {{-- Brand Header --}}
    <div class="brand">
        <div class="logo">JS</div>
        <div class="name">Jasaku Admin</div>
    </div>

    {{-- Section Label --}}
    <div class="section-label">Menu</div>

    {{-- Menu Items --}}
    <nav class="menu">
        <a href="/admin/dashboard" class="active">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="{{ route('manajemen-user.index') }}" class="{{ request()->is('manajemen-user*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manajemen User
        </a>


        <a href="/admin/pekerja">
            <i class="fas fa-user-tie"></i> Manajemen Pekerja
        </a>

        <a href="/admin/jasa">
            <i class="fas fa-briefcase"></i> Manajemen Jasa
        </a>

        <a href="/admin/transaksi">
            <i class="fas fa-receipt"></i> Manajemen Transaksi
        </a>

        <a href="/admin/laporan">
            <i class="fas fa-chart-pie"></i> Laporan & Statistik
        </a>

        <a href="/admin/pengaturan">
            <i class="fas fa-cogs"></i> Pengaturan Website
        </a>

        <a href="/admin/komplain">
            <i class="fas fa-comment-dots"></i> Komplain & Umpan Balik
        </a>
    </nav>

    {{-- Promo Box --}}
    <div class="pro-box">
        <div>
            <strong>Get Pro</strong><br>
            <span class="muted">Unlock advanced analytics & export.</span>
        </div>
        <button id="btnGoPro">Upgrade</button>
    </div>

</aside>

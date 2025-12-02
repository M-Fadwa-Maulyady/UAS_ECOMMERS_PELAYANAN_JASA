<aside class="sidebar">

    {{-- Brand Header --}}
    <div class="brand">
        <span class="dot">J</span>
        <div class="brand-text">
            <div class="title">Jasaku</div>
            <div class="role">Pekerja</div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="menu">

        <a href="{{ route('pekerja.dashboard') }}" class="item active">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>

        <a href="{{ route('pekerja.manajemen-jasa.index') }}" class="item">
            <i class="fa-solid fa-briefcase"></i>
            Manajemen Jasa
        </a>

        <a href="/jasa/tugas" class="item">
            <i class="fa-solid fa-cart-arrow-down"></i>
            Order Management
        </a>

        <a href="/jasa/kalender" class="item">
            <i class="fa-solid fa-dollar-sign"></i>
            Keuangan
        </a>

        <a href="/jasa/laporan" class="item">
            <i class="fa-solid fa-comment"></i>
            Chat / Komunikasi
        </a>

        <a href="/jasa/pesan" class="item">
            <i class="fa-solid fa-pen-to-square"></i>
            Review
        </a>
    </nav>

    {{-- Promo Box --}}
    <div class="pro-card">
        <div class="badge">J</div>
        <div class="txt">
            <div class="t">Jasaku Pro</div>
            <div class="s">Semangat Bekerja</div>
        </div>
        <button class="btn-pro">Logout</button>
    </div>

</aside>

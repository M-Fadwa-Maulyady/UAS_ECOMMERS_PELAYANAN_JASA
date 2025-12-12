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
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a href="{{ route('pekerja.manajemen-jasa.index') }}" class="item">
            <i class="fa-solid fa-briefcase"></i> Manajemen Jasa
        </a>
        <a href="{{ route('pekerja.orders.index') }}" class="item">
            <i class="fa-solid fa-cart-arrow-down"></i> Order Management
        </a>
        <a href="{{ route('worker.saldo') }}" class="item">
            <i class="fa-solid fa-dollar-sign"></i> Keuangan
        </a>

        <a href="/jasa/laporan" class="item">
            <i class="fa-solid fa-comment"></i> Chat / Komunikasi
        </a>
        <a href="/jasa/pesan" class="item">
            <i class="fa-solid fa-pen-to-square"></i> Review
        </a>
    </nav>

    {{-- STATUS SELLER CARD --}}
    @php
    $user = Auth::user();
    $progress = 0;

    if ($user->ktp) $progress += 33;
    if ($user->profile_filled) $progress += 33;

    // Check rekening lengkap
    if ($user->rekening_bank && $user->rekening_nama && $user->rekening_nomor) {
        $progress += 34;
    }

    $percentage = min(100, $progress);
@endphp

<div class="status-card-green">

    <div class="status-head">
        <div class="icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div class="title">
            Status Akun Pekerja
        </div>
    </div>

    <div class="progress-container">
        <div class="progress-label">
            {{ $percentage }}% Selesai
        </div>

        <div class="progress-bar">
            <div class="fill" style="width: {{ $percentage }}%"></div>
        </div>
    </div>

    <a href="{{ route('pekerja.account.status') }}" class="status-btn-green">
        Lihat Detail Status
    </a>

    <div class="pro-box">
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
    </div>

</div>


</aside>

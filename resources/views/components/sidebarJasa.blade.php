<style>
    .logout-box {
    margin-top: 12px;
}

.logout-btn {
    width: 100%;
    background: #ffffff;
    color: #0E6B50;
    border: 2px solid #0E6B50;
    border-radius: 12px;
    padding: 10px 0;
    font-weight: 600;
    cursor: pointer;
    transition: .25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.logout-btn:hover {
    background: #0E6B50;
    color: #ffffff;
}

</style>

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

        <a href="{{ route('pekerja.dashboard') }}"
           class="item {{ request()->routeIs('pekerja.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>

        <a href="{{ route('pekerja.manajemen-jasa.index') }}"
           class="item {{ request()->routeIs('pekerja.manajemen-jasa.*') ? 'active' : '' }}">
            <i class="fa-solid fa-briefcase"></i> Manajemen Jasa
        </a>

        <a href="{{ route('pekerja.orders.index') }}"
           class="item {{ request()->routeIs('pekerja.orders.*') ? 'active' : '' }}">
            <i class="fa-solid fa-cart-arrow-down"></i> Order Management
        </a>

        <a href="{{ route('worker.saldo') }}"
           class="item {{ request()->routeIs('worker.saldo*') ? 'active' : '' }}">
            <i class="fa-solid fa-dollar-sign"></i> Keuangan
        </a>

        <a href="{{ route('pekerja.chat') }}"
           class="item {{ request()->routeIs('pekerja.chat*') ? 'active' : '' }}">
            <i class="fa-solid fa-comment"></i> Chat / Komunikasi
        </a>

        {{-- 🔥 MENU REVIEW / RATING --}}
        <a href="{{ route('pekerja.ratings') }}"
           class="item {{ request()->routeIs('pekerja.ratings') ? 'active' : '' }}">
            <i class="fa-solid fa-star"></i> Review
        </a>

    </nav>

    {{-- STATUS SELLER CARD --}}
    @php
        $user = Auth::user();
        $progress = 0;

        if ($user->ktp) $progress += 33;
        if ($user->profile_filled) $progress += 33;
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
            <div class="title">Status Akun Pekerja</div>
        </div>

        <div class="progress-container">
            <div class="progress-label">{{ $percentage }}% Selesai</div>
            <div class="progress-bar">
                <div class="fill" style="width: {{ $percentage }}%"></div>
            </div>
        </div>

        <a href="{{ route('pekerja.account.status') }}" class="status-btn-green">
            Lihat Detail Status
        </a>

        <div class="logout-box">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>


    </div>

</aside>

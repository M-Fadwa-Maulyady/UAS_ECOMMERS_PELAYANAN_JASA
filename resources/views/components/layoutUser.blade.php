<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jasaku' }}</title>

    <link rel="stylesheet" href="{{ asset('jasa-barang2/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('jasa-barang2/jasa.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- ================= HEADER ================= -->
<header class="top-header">
    <div class="container-top">
        <img src="{{ asset('jasa-barang2/img/logo.png') }}" alt="Logo" class="logo">

        <div class="header-right-info">
            <div class="contact-info">
                <div class="phone"><i class="fa fa-phone"></i> +62 0823-4567-8901</div>
                <div class="email"><i class="fa fa-envelope"></i> infotransport@gmail.com</div>
            </div>

            {{-- USER DROPDOWN --}}
            @if(Auth::check())
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileToggle">
                    <i class="fa-solid fa-user-circle"></i>
                </button>

                <div class="profile-menu" id="profileMenu">
                    <div class="profile-info">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            @endif

        </div>
    </div>
</header>

<!-- ================= NAVBAR FIX ================= -->
<nav class="navbar">
    <div class="container-nav">

        <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li><a href="#services-section">Services</a></li>
            <li><a href="#category-section">Categories</a></li>
            <li><a href="#pricing-section">Pricing</a></li>
            <li><a href="#contact-section">Contact</a></li>
            <li><a href="#about-section">About</a></li>
            <li><a href="{{ route('user.orders') }}">📦 Pesanan Saya</a></li>
        </ul>

        <div class="nav-right">
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<main>
    {{ $slot }}
</main>

<footer style="margin-top:60px;">
    <div class="footer-bottom">
        <p>© 2025 Gerak Cepat - All rights reserved.</p>
    </div>
</footer>


<script>
document.addEventListener('click', function (e) {
    const toggle = document.getElementById('profileToggle');
    const menu = document.getElementById('profileMenu');

    if (toggle && menu) {
        if (toggle.contains(e.target)) {
            menu.classList.toggle('active');
        } else if (!menu.contains(e.target)) {
            menu.classList.remove('active');
        }
    }
});
</script>

</body>
</html>

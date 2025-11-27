<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Jasa')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('detail-jasa/jasa.css') }}">
</head>
<body>
    <!-- Top Header -->
    <header class="top-header">
        <div class="container-top">
            <img src="{{ asset('jasa-barang2/img/logo.png') }}" alt="Logo" class="logo">
            <div class="header-right-info">
                <div class="contact-info">
                    <div class="phone"><i class="fa fa-phone"></i> +62 0823-4567-8901</div>
                    <div class="email"><i class="fa fa-envelope"></i> infotransport@gmail.com</div>
                </div>
                @auth
                <div class="logout-icon">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
                @else
                <div class="logout-icon">
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Navbar Hijau -->
    <nav class="navbar navbar-expand-lg" style="background-color:#00605b;">
        <div class="container-nav container">
            <ul class="nav-menu navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('landing') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#services-section">Services</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <li><a class="dropdown-item" href="#">Pindahan Rumah</a></li>
                        <li><a class="dropdown-item" href="#">Relokasi Kantor</a></li>
                        <li><a class="dropdown-item" href="#">Jasa Pengepakan</a></li>
                        <li><a class="dropdown-item" href="#">Transportasi Khusus</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="#pricing-section">Pricing</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#contact-section">Contact</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#about-section">About</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search...">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

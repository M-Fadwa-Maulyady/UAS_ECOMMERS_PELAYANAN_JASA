<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moving & Transportation Service</title>
    <link rel="stylesheet" href="{{ asset('jasa-barang2/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="top-header">
    <div class="container-top">
        <img src="{{ asset('jasa-barang2/img/logo.png') }}" alt="Logo" class="logo">

        <div class="header-right-info">
            <div class="contact-info">
                <div class="phone"><i class="fa fa-phone"></i> +62 0823-4567-8901</div>
                <div class="email"><i class="fa fa-envelope"></i> infotransport@gmail.com</div>
            </div>

            <div class="logout-icon">
                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
            </div>
        </div>
    </div>
</header>

<nav class="navbar">
    <div class="container-nav">
        <ul class="nav-menu">
            <li><a href="#dashboard-section">Home</a></li>
            <li><a href="#services-section">Services</a></li>
            <li class="dropdown">
                <a href="#category-section" id="category-dropdown-toggle">
                    Categories <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pindahan Rumah</a></li>
                    <li><a href="#">Relokasi Kantor</a></li>
                    <li><a href="#">Jasa Pengepakan</a></li>
                    <li><a href="#">Transportasi Khusus</a></li>
                    <li><a href="#">Penyimpanan Barang</a></li>
                    <li><a href="#">View All Categories</a></li>
                </ul>
            </li>
            <li><a href="#pricing-section">Pricing</a></li>
            <li><a href="#contact-section">Contact</a></li>
            <li><a href="#about-section">About</a></li>
        </ul>

        <div class="nav-right">
            <div class="icons">
                <a href="#"><i class="fa fa-envelope"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</nav>

<section class="dashboard" id="dashboard-section">
    <div class="container dash-content">
        <div class="dash-text">
            <h1>Transportation & Moving Service</h1>
            <p>Fast, reliable, and affordable moving & transport solutions.</p>
            <button class="btn-primary">Get Started</button>
        </div>
        <div class="dash-img">
            <img src="{{ asset('jasa-barang2/img/gambar1.png') }}" alt="Dashboard Illustration">
        </div>
    </div>
</section>

<section class="services" id="services-section">
    <div class="services-header">
        <p class="service-subtitle">SERVICES</p>
        <h2>What We <span>Offer</span> For Our Customers</h2>
    </div>

    <div class="offer-slider-container">
        <div class="offer-slider">
            @foreach($jasas as $jasa)
                <div class="offer-card">
                    <img src="{{ asset('storage/' . $jasa->gambar) }}" alt="{{ $jasa->nama }}">
                    <div class="offer-content">
                        <h3>{{ $jasa->nama }}</h3>
                        <p>{{ Str::limit($jasa->deskripsi, 100) }}</p>
                        @if ($jasa->slug)
                            <button class="btn-offer"
                                onclick="window.location.href='{{ route('jasa.show', ['slug' => $jasa->slug]) }}'">
                                Read More
                            </button>
                        @else
                            <button class="btn-offer" disabled>
                                No Slug
                            </button>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer id="contact-section">
    <div class="container footer-content">
        <div class="footer-col">
            <h3>Contact Us</h3>
            <p>+1 (999) 000-000</p>
            <p>info@transport.com</p>
            <p>123 Green Street, City</p>
        </div>
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 Moving & Transport Co. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('jasa-barang2/dashboard.js') }}"></script>
</body>
</html>

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

    <!-- ================= HEADER ================= -->
    <header class="top-header">
        <div class="container-top">
            <img src="{{ asset('jasa-barang2/img/logo.png') }}" alt="Logo" class="logo">

            <div class="header-right-info">
                <div class="contact-info">
                    <div class="phone"><i class="fa fa-phone"></i> +62 0823-4567-8901</div>
                    <div class="email"><i class="fa fa-envelope"></i> infotransport@gmail.com</div>
                </div>

                {{-- LOGIN / LOGOUT --}}
                @if(Auth::check())
                <div class="user-section">
                    <div class="profile-dropdown">
                        <button class="profile-btn" id="profileToggle">
                            <img src="{{ asset('jasa-barang2/img/pp.jpg') }}" alt="Profile" class="profile-img">
                        </button>

                        <div class="profile-menu" id="profileMenu">
                            <div class="profile-info">
                                <img src="{{ asset('jasa-barang2/img/pp.jpg') }}" alt="User" class="profile-avatar">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p>{{ Auth::user()->email }}</p>
                            </div>

                            <ul class="profile-links">
                                <li><i class="fas fa-user"></i> <a href="#">View Profile</a></li>
                                <li><i class="fas fa-cog"></i> <a href="#">Settings</a></li>
                            </ul>

                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                @else
                <div class="logout-icon">
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                </div>
                @endif

            </div>
        </div>
    </header>


    <!-- ================= NAVBAR ================= -->
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
                        <li><a href="#">Fruits & Vegetables</a></li>
                        <li><a href="#">Raw Meats</a></li>
                        <li><a href="#">Soft Drinks</a></li>
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


    <!-- ================= DASHBOARD ================= -->
    <section class="dashboard" id="dashboard-section">
        <div class="container dash-content">

            <div class="dash-text">
                <h1>Transportation & Moving Service</h1>
                <p>Fast, reliable, and affordable moving & transport solutions for your business or home.</p>
                <button class="btn-primary">Get Started</button>
            </div>

            <div class="dash-img">
                <img src="{{ asset('jasa-barang2/img/gambar1.png') }}" alt="Dashboard Illustration">
            </div>

        </div>
    </section>


    <!-- ================= CATEGORY SLIDER ================= -->
    <section class="browse-category" id="category-section">

    <div class="category-header">
        <h2>Browse by Category</h2>

        <!-- Tombol All Categories harus memanggil filter, bukan route -->
        <span class="view-all filter-btn" data-kategori="all" style="cursor:pointer;">
            All Categories →
        </span>
    </div>

    <div class="category-slider-container">

        <button class="slide-btn left"><i class="fa fa-chevron-left"></i></button>

        <div class="category-slider">
            <!-- Loop kategori -->
            @foreach ($kategori as $item)
                <div class="category-card filter-btn" data-kategori="{{ $item->id }}">

                    @if ($item->icon)
                        <img 
                            src="{{ asset('storage/kategori/' . $item->icon) }}" 
                            alt="Icon {{ $item->nama }}"
                            class="category-icon"
                        >
                    @else
                        <img 
                            src="{{ asset('default/category.png') }}" 
                            alt="Default Icon"
                            class="category-icon"
                        >
                    @endif

                    <p>{{ $item->nama }}</p>

                </div>
            @endforeach

        </div>

        <button class="slide-btn right"><i class="fa fa-chevron-right"></i></button>

    </div>

</section>




    <!-- ============== SERVICES (HANYA 1, TIDAK DOBEL) ============== -->
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

                    @if($jasa->slug)
                        <button class="btn-offer"
                            onclick="window.location.href='{{ route('jasa.show', $jasa->slug) }}'">
                            Read More
                        </button>
                    @else
                        <button class="btn-offer" disabled>No Slug</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="professional-services">
        <div class="container">
            <div class="service-header">
                <div class="service-title">
                    <h2>Our Professional Moving Services</h2>
                    <a href="#" class="explore-all">Explore All <i class="fa fa-arrow-right"></i></a>
                </div>
                <p>We offer a wide range of moving services tailored to meet your needs. Safe, efficient, and affordable solutions.</p>
            </div>

            <div class="pro-service-grid">
                <div class="pro-card">
                    <img src="img/homeservice.png" alt="Home Shifting">
                    <h3>Home Shifting</h3>
                    <p>Hassle-free moving experience for your home.</p>
                    <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
                </div>

                <div class="pro-card">
                    <img src="img/office.png" alt="Office Relocation">
                    <h3>Office Relocation</h3>
                    <p>Reduce downtime with fast relocation services.</p>
                    <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
                </div>

                <div class="pro-card">
                    <img src="img/packing.png" alt="Packing & Unpacking">
                    <h3>Packing & Unpacking</h3>
                    <p>Let us handle packing while you relax.</p>
                    <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
                </div>

                <div class="pro-card">
                    <img src="img/longmove.png" alt="Long-Distance Moving">
                    <h3>Long-Distance Moving</h3>
                    <p>Move between cities safely and easily.</p>
                    <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="our-company">
    <div class="container company-content">
        <div class="company-text">
            <h1>OUR COMPANY</h1>
            <h2>Kami adalah perusahaan pindahan terbaik di dunia.</h2>
            <p>Pindah lebih mudah dengan mitra logistik tepercaya. Kami memastikan barang Anda sampai tujuan dengan aman dan tepat waktu.</p>

            <div class="company-stats">
                <div class="stat">
                    <i class="fas fa-users"></i>
                    <div>
                        <h3>500+</h3>
                        <p>Pelanggan Bahagia</p>
                    </div>
                </div>

                <div class="stat">
                    <i class="fas fa-box"></i>
                    <div>
                        <h3>6,540</h3>
                        <p>Total Boks Dipindahkan</p>
                    </div>
                </div>

                <div class="stat">
                    <i class="fas fa-award"></i>
                    <div>
                        <h3>12+</h3>
                        <p>Tahun Pengalaman</p>
                    </div>
                </div>
            </div>

            <div class="company-guarantees">
                <div class="guarantee-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Jaminan Asuransi Penuh</span>
                </div>

                <div class="guarantee-item">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Pelacakan GPS 24/7</span>
                </div>
            </div>
        </div>

        <div class="company-img">
            <img src="jasa-barang2/img/gambar2.png" alt="Our Company">
        </div>
    </div>
</section>


<section class="working-process">
    <div class="container process-content">
        <p class="process-subtitle">OUR PROCESS</p>
        <h2>Our Working Process</h2>

        <div class="process-steps">

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">01</span>
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>Choose a Service</h3>
                <p>Pilih layanan yang diperlukan (Rumah, Kantor, Pengepakan, dll).</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">02</span>
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3>Define Requirements</h3>
                <p>Berikan detail lengkap: barang, lokasi awal, tujuan, dan waktu.</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">03</span>
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Request a Booking</h3>
                <p>Konfirmasi penawaran dan tentukan tanggal pindahan.</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">04</span>
                    <i class="fas fa-truck-moving"></i>
                </div>
                <h3>Safe Execution</h3>
                <p>Tim profesional kami menangani proses pindahan hingga selesai.</p>
            </div>

        </div>
    </div>
</section>


<section class="about-illustration" id="about-section">
    <div class="container about-container">
        <div class="about-text">
            <h2>About Us</h2>
            <p>Kami adalah perusahaan pindahan terpercaya dengan pengalaman bertahun-tahun memastikan barang Anda sampai dengan aman dan tepat waktu.</p>
            <button class="btn-primary">Read More</button>
        </div>

        <div class="about-img">
            <img src="jasa-barang2/img/gambar3.png" alt="About Illustration">
        </div>
    </div>
</section>

<!-- ============== DETAILED STATS ============== -->
<section class="detailed-stats">
    <div class="container stats-grid">
        <div class="stat-item">
            <h3>3.9K+</h3>
            <p>Berhasil Dipindahkan</p>
        </div>

        <div class="stat-item">
            <h3>15.8K+</h3>
            <p>Proyek Selesai</p>
        </div>

        <div class="stat-item">
            <h3>97.5%+</h3>
            <p>Pengiriman Tepat Waktu</p>
        </div>

        <div class="stat-item">
            <h3>100.2K+</h3>
            <p>Ulasan Memuaskan</p>
        </div>
    </div>
</section>




<!-- ============== FOOTER (TIDAK DOBEL) ============== -->
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

        <div class="footer-col">
            <h3>Follow Us</h3>
            <div class="social">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Moving & Transport Co. All rights reserved.</p>
    </div>
</footer>


<!-- ============== SCRIPT (FINAL) ============== -->
<script src="{{ asset('jasa-barang2/dashboard.js') }}"></script>

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

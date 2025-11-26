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
        <img src="jasa-barang2/img/logo.png" alt="Logo" class="logo">

        <div class="header-right-info">
            <div class="contact-info">
                <div class="phone">
                    <i class="fa fa-phone"></i> +62 0823-4567-8901
                </div>
                <div class="email">
                    <i class="fa fa-envelope"></i> infotransport@gmail.com
                </div>
            </div>

            <div class="logout-icon">
                <a href="{{ route('login.post') }}"><i class="fas fa-sign-in-alt"></i></a>
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
                <a href="#category-section" id="category-dropdown-toggle">Categories <i class="fas fa-chevron-down dropdown-arrow"></i></a>
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
                <input type="text" placeholder="Search..." />
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</nav>

<section class="dashboard" id="dashboard-section">
    <div class="container dash-content">
        <div class="dash-text">
            <h1>Transportation & Moving Service</h1>
            <p>Fast, reliable, and affordable moving & transport solutions for your business or home.</p>
            <button class="btn-primary">Get Started</button>
        </div>
        <div class="dash-img">
            <img src="jasa-barang2/img/gambar1.png" alt="Dashboard Illustration">
        </div>
    </div>
</section>

<section class="browse-category">
    <div class="category-header">
        <h2>Browse by Category</h2>
        <a href="#" class="view-all">All Categories →</a>
    </div>

    <div class="category-slider-container">
        <button class="slide-btn left"><i class="fa fa-chevron-left"></i></button>

        <div class="category-slider">
            <div class="category-card"><img src="jasa-barang2/img/bongkar.png"><p>Jasa Bongkar Pasang</p></div>
            <div class="category-card"><img src="jasa-barang2/img/pengempangan.png"><p>Jasa Pengepakan</p></div>
            <div class="category-card"><img src="jasa-barang2/img/penyimpanan.png"><p>Jasa Penyimpanan</p></div>
            <div class="category-card"><img src="jasa-barang2/img/antar_barang.png"><p>Jasa Pengantaran</p></div>
            <div class="category-card"><img src="jasa-barang2/img/surat_izin.png"><p>Jasa Pengurusan Dokumen Pindahan</p></div>
            <div class="category-card"><img src="jasa-barang2/img/bersih.png"><p>Jasa Deep Cleaning</p></div>
            <div class="category-card"><img src="jasa-barang2/img/sofa.png"><p>Jasa Cuci Karpet & Sofa</p></div>
            <div class="category-card"><img src="jasa-barang2/img/ac.png"><p>Jasa Servis & Cuci AC</p></div>
            <div class="category-card"><img src="jasa-barang2/img/pembasmi.png"><p>Jasa Pest Control</p></div>
            <div class="category-card"><img src="jasa-barang2/img/perawatan.png"><p>Jasa Perawatan Taman</p></div>
            <div class="category-card"><img src="jasa-barang2/img/semua.png"><p>Jasa Tukang Serba Bisa</p></div>
            <div class="category-card"><img src="jasa-barang2/img/listrik.png"><p>Jasa Perbaikan Listrik</p></div>
            <div class="category-card"><img src="jasa-barang2/img/cat_rumah.png"><p>Jasa Cat Rumah</p></div>
            <div class="category-card"><img src="jasa-barang2/img/kurir.png"><p>Jasa Kurir Kilat</p></div>
            <div class="category-card"><img src="jasa-barang2/img/jastip.png"><p>Jasa Titip Beli</p></div>
            <div class="category-card"><img src="jasa-barang2/img/tiket.png"><p>Jasa Pemesanan Tiket Transportasi</p></div>
        </div>

        <button class="slide-btn right"><i class="fa fa-chevron-right"></i></button>
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
                        <button class="btn-offer"
                            onclick="window.location.href='{{ route('jasa.show', $jasa->slug) }}'">
                            Read More
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="why-choose">
    <div class="container">
        <h2>We give you complete control of your shipments.</h2>
        <div class="choose-grid">
            <div class="choose-card">
                <h3>01</h3>
                <h4>Request Quotes</h4>
                <p>Get instant quotes from our moving specialists for transparent pricing.</p>
                <a href="#">Read More</a>
            </div>

            <div class="choose-card">
                <h3>02</h3>
                <h4>Compare Prices</h4>
                <p>Compare different package options and choose what fits your needs best.</p>
                <a href="#">Read More</a>
            </div>

            <div class="choose-card">
                <h3>03</h3>
                <h4>Safely Delivered</h4>
                <p>Our professional team guarantees safe, on-time delivery of your goods.</p>
                <a href="#">Read More</a>
            </div>
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
                <img src="jasa-barang2/img/homeservice.png" alt="Home Shifting">
                <h3>Home Shifting</h3>
                <p>Hassle-free moving experience for your home.</p>
                <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
            </div>

            <div class="pro-card">
                <img src="jasa-barang2/img/office.png" alt="Office Relocation">
                <h3>Office Relocation</h3>
                <p>Reduce downtime with fast relocation services.</p>
                <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
            </div>

            <div class="pro-card">
                <img src="jasa-barang2/img/packing.png" alt="Packing & Unpacking">
                <h3>Packing & Unpacking</h3>
                <p>Let us handle packing while you relax.</p>
                <a href="#" class="btn-explore">Explore Now <i class="fa fa-arrow-right"></i></a>
            </div>

            <div class="pro-card">
                <img src="jasa-barang2/img/longmove.png" alt="Long-Distance Moving">
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
                <p>Pick the moving service needed (Home, Office, Packing, etc.).</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">02</span>
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3>Define Requirements</h3>
                <p>Provide details: items, origin, destination, and timing for accurate quote.</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">03</span>
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Request a Booking</h3>
                <p>Finalize the quote and confirm your preferred moving date and time.</p>
            </div>

            <div class="connector"></div>

            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number">04</span>
                    <i class="fas fa-truck-moving"></i>
                </div>
                <h3>Safe Execution</h3>
                <p>Our professional team handles packing, loading, transport, and delivery.</p>
            </div>
        </div>
    </div>
</section>

<section class="about-illustration" id="about-section">
    <div class="container about-container">
        <div class="about-text">
            <h2>About Us</h2>
            <p>We are a trusted moving and transportation company with years of experience ensuring your goods are delivered safely and on time. Our professional team guarantees reliability and customer satisfaction.</p>
            <button class="btn-primary">Read More</button>
        </div>
        <div class="about-img">
            <img src="jasa-barang2/img/gambar3.png" alt="About Illustration">
        </div>
    </div>
</section>

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

<script src="{{ asset('jasa-barang2/dashboard.js') }}"></script>
</body>
</html>

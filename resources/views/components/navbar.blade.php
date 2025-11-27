<header class="top-header">
    <div class="container-top">
        <img src="img/logo.png" alt="Logo" class="logo">
        
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
                <a href="#"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
</header>

<nav class="navbar">
    <div class="container-nav">

        {{-- LEFT MENU --}}
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

        {{-- RIGHT MENU --}}
        <div class="nav-right">

            {{-- Social Icons --}}
            <div class="icons">
                <a href="#"><i class="fa fa-envelope"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            {{-- Search --}}
            <div class="search-box">
                <input type="text" placeholder="Search..." />
                <button><i class="fa fa-search"></i></button>
            </div>

            {{-- USER PROFILE (KALAU LOGIN) --}}
            @if(Auth::check())
                <div class="user-profile">
                    <img src="{{ Auth::user()->foto ?? asset('default-user.png') }}" class="profile-img">
                </div>
            @endif
        </div>

    </div>
</nav>

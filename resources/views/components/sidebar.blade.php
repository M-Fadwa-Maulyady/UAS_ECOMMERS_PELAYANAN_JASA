        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-user-nurse"></i>
                                    <p>
                                        Data Layanan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dataAnggota') }}"
                                    class="nav-link {{ request()->routeIs('dataAnggota') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Data Anggota
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dataKategori') }}"
                                    class="nav-link {{ request()->routeIs('dataKategori') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Data Kategori
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Data Pesanan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Data Laporan
                                    </p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Katalog Buku
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Riwayat Peminjaman
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

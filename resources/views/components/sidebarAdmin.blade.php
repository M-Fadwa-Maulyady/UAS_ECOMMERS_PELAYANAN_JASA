<aside class="sidebar">

    <div class="brand">
        <div class="logo">JS</div>
        <div class="name">Jasaku Admin</div>
    </div>

    <div class="section-label">Menu</div>

    <nav class="menu">

        <a href="/admin/dashboard"
           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="/admin/manajemen-user"
           class="{{ request()->is('admin/manajemen-user*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manajemen User
        </a>

        <a href="/admin/kategori"
           class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori Jasa
        </a>

        <a href="/admin/pekerja"
           class="{{ request()->is('admin/pekerja*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> Manajemen Pekerja
        </a>

        <a href="/admin/jasa"
           class="{{ request()->is('admin/jasa*') ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Manajemen Jasa
        </a>

        <a href="/admin/orders"
           class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Manajemen Order
        </a>

        <a href="/admin/payments"
           class="{{ request()->is('admin/payments*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Manajemen Transaksi
        </a>


    </nav>

    <div class="pro-box">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

</aside>

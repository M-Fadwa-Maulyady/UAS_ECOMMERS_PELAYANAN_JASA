    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Logout -->
            <li class="nav-item">
                {{-- <a class="nav-link" href="#" role="button">
                    <i class="fas fa-sign-in-alt"></i>
                </a> --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i></button>
                </form>
            </li>
        </ul>   
    </nav>
    <!-- /.navbar -->

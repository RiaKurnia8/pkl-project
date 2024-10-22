<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <!-- Navbar Brand-->
    {{-- <a class="navbar-brand ps-3" href="{{ url('admin/dashboard') }}">Inventory IT</a> --}}
    <a class="navbar-brand ps-3" href="{{ url('admin/dashboard') }}">
        <img src="{{ asset('assets/images/sasa.png') }}" alt="Logo" style="width: 60px; margin-right: 5px;"> <!-- Ganti dengan path logo yang sesuai -->
        Inventory IT
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

        <li class="nav-item">
            <!-- Ikon User dan Nama Pengguna -->
            <a class="nav-link" href="{{ url('admin/profiladmin') }}">
                <i class="fas fa-circle-user"></i>
                <span>{{ auth()->user()->name }}</span> <!-- Menampilkan nama pengguna -->
            </a>
        </li>
        <!-- Tombol Log Out -->
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> 
                </a>
            </form>
        </li>
    </ul>
    
</nav>
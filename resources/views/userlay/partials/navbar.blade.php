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
        {{-- <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div> --}}
    </form>
    <!-- Navbar-->
    {{-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin<i class="fas fa-circle-user fa-fw fa-2x"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    {{-- <a class="dropdown-item" href="#!">Logout</a> --}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                         {{ __('Log Out') }}
                     </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul> --}}

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <!-- Ikon User dan Nama Pengguna -->
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-circle-user"></i>
                <span>{{ auth()->user()->name }}</span> <!-- Menampilkan nama pengguna -->
            </a>
        
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ url('user/profiluser') }}">
                        Edit Profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('user.profile.updatePassword') }}">
                        Ubah Password
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="nav-item">
            <!-- Ikon User dan Nama Pengguna -->
            <a class="nav-link" href="#">
                <i class="fas fa-circle-user"></i>
                <span>{{ auth()->user()->name }}</span> <!-- Menampilkan nama pengguna -->
            </a>
        </li> --}}
        <!-- Tombol Log Out -->
        <li class="nav-item">
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> 
                </a>
            </form> --}}
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
    </ul>
    
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">
                    Logout
                </button>
            </div>
        </div>
    </div>
</div>
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
            <!-- Ikon User -->
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-circle-user"></i>
            </a>
            <!-- Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Edit Profile</a></li>
                <li><a class="dropdown-item" href="#!">Reset Password</a></li>
                <li><hr class="dropdown-divider" /></li>
            </ul>
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
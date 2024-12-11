<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <div class="sb-sidenav-menu-heading">Transaksi</div>
            <a class="nav-link" href="{{ url('user/upeminjaman') }}">
                <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a>

                <div class="sb-sidenav-menu-heading">History</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHomes"
                aria-expanded="false" aria-controls="collapseHomes">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-rotate"></i></div>
                History
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseHomes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                
                <nav class="sb-sidenav-menu-nested nav">
                        {{-- <a class="nav-link" href="{{ url('user/upeminjaman') }}">
                            <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a> --}}
                            <a class="nav-link" href="{{ url('user/hpeminjaman') }}">
                                <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a>
                
                            <a class="nav-link" href="{{ url('user/hpengembalian') }}">
                                <i class="fas fa-box" style="margin-right: 10px;"></i>Pengembalian</a>
                </nav>
            </div>

            {{-- <div class="sb-sidenav-menu-heading">History</div>
            <a class="nav-link" href="{{ url('user/hpeminjaman') }}">
                <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a>

            <a class="nav-link" href="{{ url('user/hpengembalian') }}">
                <i class="fas fa-box" style="margin-right: 10px;"></i>Pengembalian</a> --}}

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Inventory IT
    </div>
</nav>

<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>

            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            {{-- Master --}}
            <div class="sb-sidenav-menu-heading">Utama</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasters"
                aria-expanded="false" aria-controls="collapseMasters">
                <div class="sb-nav-link-icon"><i class="fas fa-suitcase"></i></div>
                Master
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseMasters" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/databarang') }}">
                        <i class="fas fa-folder-plus" style="margin-right: 10px;"></i> Data Barang</a>

                    <a class="nav-link" href="{{ url('admin/useradmin') }}">
                        <i class="fas fa-user-plus" style="margin-right: 10px;"></i>User</a>

                    <a class="nav-link" href="{{ url('admin/datadisposal') }}">
                        <i class="fas fa-recycle" style="margin-right: 10px;"></i>Data Disposal</a>

                    <a class="nav-link" href="{{ url('admin/kategori') }}">
                        <i class="fas fa-layer-group" style="margin-right: 10px;"></i>Kategory</a>
                    <a class="nav-link" href="{{ url('admin/plant') }}">
                        <i class="fas fa-location-dot" style="margin-right: 10px;"></i>Plant</a>
                        
                </nav>
            </div>

            {{-- List --}}
            <div class="sb-sidenav-menu-heading">Transaksi</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLists"
                aria-expanded="false" aria-controls="collapseLists">
                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                List
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>

            <div class="collapse" id="collapseLists" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">

                <nav class="sb-sidenav-menu-nested nav">

                    <a class="nav-link" href="{{ url('admin/peminjaman') }}">
                        <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a>

                    <a class="nav-link" href="{{ url('admin/pengembalian') }}">
                        <i class="fas fa-box" style="margin-right: 10px;"></i>Pengembalian</a>

                    {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">

                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i> <!-- Ikon Status -->
                        Status
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i> <!-- Ikon Dropdown -->
                        </div>
                    </a> --}}

                    {{-- <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">

                            <a class="nav-link" href="{{ url('admin/statuspeminjaman') }}">
                                <i class="fas fa-pen-to-square" style="margin-right: 10px;"></i>Peminjaman</a>

                            <a class="nav-link" href="{{ url('admin/statuspengembalian') }}">
                                <i class="fas fa-box" style="margin-right: 10px;"></i>Pengembalian</a>

                        </nav>
                    </div> --}}
                </nav>
            </div>

            {{-- Riwayat --}}
            <div class="sb-sidenav-menu-heading">Riwayat Sampah</div>

            <a class="nav-link" href="{{ route('admin.riwayat_sampah') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-trash-can"></i></div>
                Riwayat Sampah
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Inventory IT
    </div>
</nav>

@extends('layouts.admin')

@section('title','Dashboard')

@section('content') 

    {{-- pesan sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h1 class="mt-4">Dashboard</h1>

<div class="row">
    <!-- Card Jumlah Data Barang -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h2 class="mb-2">{{ $jumlahBarang }}</h2> <!-- Menampilkan jumlah barang dinamis -->
                <p>Jumlah Data Barang</p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('admin.databarang.index') }}">Baca Selengkapnya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

    <!-- Card Jumlah Data User -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-warning text-black">
            <div class="card-body">
                <h2 class="mb-2">{{ $jumlahUser }}</h2> <!-- Menampilkan jumlah user dinamis -->
                <p>Jumlah Data User</p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('admin.useradmin.index') }}">Baca Selengkapnya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>


<div class="mt-4 ms-3">
    <a href="{{ route('admin.export.peminjaman') }}" class="btn btn-success mt-2"><i class="fas fa-file-excel"></i></a>
         <a href="{{ route('admin.dashboard.exportPdf') }}" class="btn btn-danger mt-2"><i class="fas fa-file-pdf"></i></a>
</div>
 





<!-- Tabel Data Peminjaman -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table id="dashboardTable" class="table table-striped table-bordered">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr>
            <th>No</th>
            <th>Username</th>
            <th>Barang</th>
            <th>Plant</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($Peminjamans as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->username }}</td>
                <td>{{ $peminjaman->barang }}</td>
                <td>{{ $peminjaman->plant }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_pengembalian ?? '-' }}</td> <!-- Menampilkan '-' jika tanggal_pengembalian null -->
                {{-- <td>
                    <form action="{{ route('admin.peminjaman.delete', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </td> --}}
                <td>
                    <!-- Tombol Hapus yang memicu modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $peminjaman->id }}">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                
                    <!-- Modal Konfirmasi Penghapusan -->
                    <div class="modal fade" id="deleteModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $peminjaman->id }}">Konfirmasi Penghapusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data ini? </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.peminjaman.delete', $peminjaman->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {!! $Peminjamans->withQueryString()->links('pagination::bootstrap-5') !!} --}}

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dashboardTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            pageLength: 10,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json" // Bahasa Indonesia (opsional)
            }
        });
    });
</script>
    
@endpush


@extends('layouts.admin')

@section('title', 'Riwayat Sampah')

@section('content')

{{-- pesan sukses --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1 class="mt-4">Riwayat Sampah</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead style="background-color: #f71d1d; color: white;">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Barang</th>
                <th>Plant</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pengembalian</th>
                <th>Pulihkan</th>
                <th>Hapus Permanen</th>
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
                <td>{{ $peminjaman->tanggal_pengembalian ?? '-' }}</td>
                {{-- <td>
                    <form action="{{ route('admin.riwayat_sampah.restore', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-undo"></i> <!-- Ikon Restore -->
                        </button>
                    </form>
                </td> --}}
                <td>
                    <!-- Tombol Restore yang memicu modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $peminjaman->id }}">
                        <i class="fas fa-undo"></i> <!-- Ikon Restore -->
                    </button>
                
                    <!-- Modal Konfirmasi Restore -->
                    <div class="modal fade" id="restoreModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="restoreModalLabel{{ $peminjaman->id }}">Konfirmasi Restore</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin mengembalikan data ini dari Riwayat Sampah?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.riwayat_sampah.restore', $peminjaman->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                {{-- <td>
                    <form action="{{ route('admin.riwayat_sampah.delete', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus Permanen -->
                        </button>
                    </form>
                </td> --}}
                <td>
                    <!-- Tombol Hapus Permanen yang memicu modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#permanentDeleteModal{{ $peminjaman->id }}">
                        <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus Permanen -->
                    </button>
                
                    <!-- Modal Konfirmasi Penghapusan Permanen -->
                    <div class="modal fade" id="permanentDeleteModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="permanentDeleteModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="permanentDeleteModalLabel{{ $peminjaman->id }}">Konfirmasi Penghapusan Permanen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data ini secara permanen?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.riwayat_sampah.delete', $peminjaman->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
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
</div>
@endsection

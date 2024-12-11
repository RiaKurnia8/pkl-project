@extends('layouts.admin')

@section('title', 'Peminjaman')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Data Peminjaman</h1>

    <div class="mt-4 ms-3">
        <a href="{{ route('admin.peminjaman.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
        <a href="{{ route('admin.peminjaman.exportPdf') }}" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>
    </div>


<<<<<<< HEAD
<!-- Tabel Peminjaman -->
<div style="padding: 20px; border-radius: 10px;">
    <table id="peminjamanTable" class="table table-striped table-bordered">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                {{-- <th>No</th> --}}
                <th>ID</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Plant</th>
                <th>Barang dipinjam</th>
                <th>Tanggal pinjam</th>
                <th>Keperluan</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tanggal Pengembalian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $i => $data)
                @if ($data && $data->id) <!-- Pastikan $data dan $data->id tidak null -->
                    <tr>
                        {{-- <td>{{ $i + 1 }}</td> --}}
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->plant }}</td>
                        <td>{{ $data->barang_dipinjam }}</td>
                        <td>{{ $data->tanggal_pinjam }}</td>
                        <td>{{ $data->keperluan}}</td>
                        <td>{{ $data->notes}}</td>
                        <td>
                            @if (empty($data->status))
                                <span style="color: gray; font-style: italic; font-size: 13px; white-space: nowrap;">Menunggu Konfirmasi...</span>
                            @else
                                {{ $data->status }}
                            @endif
                            <a href="{{ route('admin.peminjaman.edit', $data->id) }}" class="ms-2">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>{{ $data->keterangan}}</td>
                        <td>{{ $data->tanggal_pengembalian}}</td>
                        
                        <td>
                            @if ($data->keterangan === 'Sudah Kembali')
                                <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                        
                                <!-- Modal Konfirmasi Penghapusan -->
                                <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Konfirmasi Penghapusan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini? 
                                                <p><strong>{{ $data->barang_dipinjam }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.peminjaman.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Pesan ketika data belum bisa dihapus -->
                                <span style="color: gray; font-style: italic; font-size: 13px; white-space: nowrap;">Belum bisa dihapus</span>
                            @endif
                        </td>                        
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination -->
    {{-- {!! $peminjamans->withQueryString()->links('pagination::bootstrap-5') !!} --}}
</div>

<script>
    // Menghilangkan pesan sukses setelah 3 detik
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 3000); // 3000ms = 3 detik
        }
    });

</script>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#peminjamanTable').DataTable({
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

{{-- <!-- CDN Bootstrap dan jQuery -->
@section('scripts')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
=======
    <!-- Tabel Peminjaman -->
    <div style="padding: 20px; border-radius: 10px;">
        <table id="peminjamanTable" class="table table-striped table-bordered">
            <thead style="background-color: #dc3545; color: white;">
                <tr>
                    
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Plant</th>
                    <th>Barang dipinjam</th>
                    <th>Tanggal pinjam</th>
                    <th>Keperluan</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $i => $data)
                    @if ($data && $data->id)
                        <!-- Pastikan $data dan $data->id tidak null -->
                        <tr>
                            
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->plant }}</td>
                            <td>{{ $data->barang_dipinjam }}</td>
                            <td>{{ $data->tanggal_pinjam }}</td>
                            <td>{{ $data->keperluan }}</td>
                            <td>{{ $data->notes }}</td>
                            <td>
                                @if (empty($data->status))
                                    <span
                                        style="color: gray; font-style: italic; font-size: 13px; white-space: nowrap;">Menunggu
                                        Konfirmasi...</span>
                                @else
                                    {{ $data->status }}
                                @endif
                                <a href="{{ route('admin.peminjaman.edit', $data->id) }}" class="ms-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>

                            <td>
                                @if (empty($data->status))
                                    <span style="color: gray; font-style: italic; font-size: 13px;">Menunggu
                                        Konfirmasi...</span>
                                @elseif ($data->status === 'ditolak')
                                    <span>Ditolak</span>
                                @elseif (empty($data->keterangan))
                                    <span style="color: gray; font-style: italic; font-size: 13px;">Belum Kembali</span>
                                @else
                                    {{ $data->keterangan }}
                                @endif
                            </td>
                            <td>{{ $data->tanggal_pengembalian }}</td>

                            <td>
                                @if ($data->keterangan === 'Sudah Kembali')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $data->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal Konfirmasi Penghapusan -->
                                    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">
                                                        Konfirmasi Penghapusan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini? <p>
                                                        <strong>{{ $data->barang_dipinjam }}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.peminjaman.destroy', $data->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Tidak ada tombol jika belum kembali atau ditolak -->
                                    <span style="color: red; font-style: italic; font-size: 13px;"></span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
>>>>>>> 72542b368a5eec9c79c1746c48f934aec671fc55


        <script>
            // Menghilangkan pesan sukses setelah 3 detik
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    setTimeout(() => {
                        alert.classList.remove('show');
                    }, 3000); // 3000ms = 3 detik
                }
            });
        </script>

    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#peminjamanTable').DataTable({
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

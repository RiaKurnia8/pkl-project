@extends('layouts.admin')

@section('title', 'pengembalian')

@section('content')

{{-- pesan sukses --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Data pengembalian</h1>

<!-- Bagian Tombol PDF, Excel, dan Search -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <!-- Tombol PDF dan Excel di sebelah kiri -->
    <div class="d-flex">
        <a href="{{ route('admin.pengembalian.xls') }}" class="btn btn-success me-2"><i class="fas fa-file-excel"></i></a>
        <a href="{{ route('admin.pengembalian.exportPdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
    </div>
</div>

<!-- Tabel pengembalian -->
<div style="padding: 20px; border-radius: 10px;">
    <table id="pengembalianTable" class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Plant</th>
                <th>Barang dipinjam</th>
                <th>Tanggal pengembalian</th>
                <th>Keperluan</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $i => $data)
                @if ($data && $data->id) <!-- Pastikan $data dan $data->id tidak null -->
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->plant }}</td>
                        <td>{{ $data->barang_dipinjam }}</td>
                        <td>{{ $data->tanggal_pengembalian }}</td>
                        <td>{{ $data->keperluan }}</td>
                        <td>{{ $data->notes }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ route('admin.pengembalian.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
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
                                            Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $data->barang_dipinjam }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.pengembalian.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
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
        $('#pengembalianTable').DataTable({
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

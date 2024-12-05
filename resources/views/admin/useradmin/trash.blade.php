@extends('layouts.admin')

@section('title', 'Sampah')

@section('content')

    {{-- pesan sukses --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Data User Sampah</h1>

   
    <!-- Tabel Data User -->
    <div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
        <table id="usersampahTable" class="table table-striped table-bordered">
            <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Usertype</th>
                    <th>No. Hp</th>
                    <th>Plant</th>
                    <th>Jenis Kelamin</th>
                    
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $i => $data)
                    <!-- Contoh data user (ini bisa diganti dengan data dari database) -->
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->usertype }}</td>
                        <td>{{ $data->nomor_hp }}</td>
                        {{-- <td>{{ $data->plant_id }}</td> --}}
                        <td>{{ $data->plant ? $data->plant->plant : 'Tidak Ditemukan' }}</td> <!-- Menampilkan nama plant -->
                        <td>{{ $data->jenis_kelamin }}</td>
                        <!-- <td>{{ $data->password }}</td> -->
                        <!-- Tombol Aksi -->
                        <td>
                            <!-- Tombol Restore yang memicu modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $data->id }}">
                                <i class="fas fa-undo"></i> <!-- Ikon Restore -->
                            </button>
                        
                            <!-- Modal Konfirmasi Restore -->
                            <div class="modal fade" id="restoreModal{{ $data->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="restoreModalLabel{{ $data->id }}">Konfirmasi Restore</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin mengembalikan data ini dari Riwayat Sampah?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.useradmin.restore', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT') <!-- Simulasikan metode PUT -->
                                                <button type="submit" class="btn btn-primary">Restore</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Tombol Hapus Permanen yang memicu modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#permanentDeleteModal{{ $data->id }}">
                                <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus Permanen -->
                            </button>
                        
                            <!-- Modal Konfirmasi Penghapusan Permanen -->
                            <div class="modal fade" id="permanentDeleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="permanentDeleteModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="permanentDeleteModalLabel{{ $data->id }}">Konfirmasi Penghapusan Permanen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini secara permanen?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.useradmin.forceDelete', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        
                    </tr>
                @endforeach
                <!-- Tambahkan data lainnya sesuai kebutuhan -->
            </tbody>
        </table>

        {{-- add data --}}
       
        {{-- {!! $users->withQueryString()->links('pagination::bootstrap-5') !!} --}}

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
        $('#usersampahTable').DataTable({
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
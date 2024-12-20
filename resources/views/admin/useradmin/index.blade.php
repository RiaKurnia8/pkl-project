@extends('layouts.admin')

@section('title', 'Data User')

@section('content')

    {{-- pesan sukses --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Data User</h1>

    <div class="mt-4 ms-3">
    <a class="btn btn-primary" href="{{ route('admin.useradmin.create') }}">Add Data</a>
    </div>

   
    <!-- Tabel Data User -->
    <div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
        <table id="userTable" class="table table-striped table-bordered">
            <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Usertype</th>
                    {{-- <th>Username</th> --}}
                    <th>No. Hp</th>
                    <th>Plant</th>
                    <th>Jenis Kelamin</th>
                    <!-- <th>Password</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $data)
                    <!-- Contoh data user (ini bisa diganti dengan data dari database) -->
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->usertype }}</td>
                        {{-- <td>{{ $data->username }}</td> --}}
                        <td>{{ $data->nomor_hp }}</td>
                        {{-- <td>{{ $data->plant_id }}</td> --}}
                        <td>{{ $data->plant ? $data->plant->plant : 'Tidak Ditemukan' }}</td> <!-- Menampilkan nama plant -->
                        <td>{{ $data->jenis_kelamin }}</td>
                        <!-- <td>{{ $data->password }}</td> -->
                        <!-- Tombol Aksi -->
                        <td>
                            <a href="{{ route('admin.useradmin.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Tombol Hapus dengan Modal Konfirmasi -->
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
                                            <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Konfirmasi
                                                Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini? <p>
                                                <strong>{{ $data->nik }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.useradmin.destroy', $data->id) }}" method="POST"
                                                style="display:inline;">
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
        $('#userTable').DataTable({
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

<!-- CDN Bootstrap dan jQuery -->
{{-- @section('scripts')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">


@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/css/toastr.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.2.min.js"
        integrity="sha384-pesnqDzEPzp58KTGw8ViPmq7fl0R/DpZ6PPcZn+SaH2gxvUo4EtYdciwMIzAEzXk" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/js/toastr.js"></script>
@endpush --}}

@extends('layouts.admin')

@section('title','Kategori')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Kategori</h1>
<div class="d-flex justify-content-between mt-4 ms-3">
    <button class="btn btn-primary" onclick="window.location.href='{{ route('kategori.create') }}'">Add Data</button>
</div>

<div style="padding: 20px; border-radius: 10px;">
    
    <table id="kategoriTable" class="table table-striped table-bordered">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Status</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>{{ $kategori->status }}</td> <!-- Tampilkan status -->
                <td>
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> 
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

   

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
        $('#kategoriTable').DataTable({
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


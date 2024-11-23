@extends('layouts.admin')

@section('title', 'Peminjaman')

@section('content')

{{-- pesan sukses --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Data Peminjaman</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
    
<div class="d-flex justify-content-end mb-3">
    <!-- Bagian Search -->
    <div class="col-auto">
        <form action="{{ route('admin.peminjaman.search') }}" method="GET">
            <div class="input-group">
                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        
        </form>
         <a href="{{ route('admin.peminjaman.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
         <a href="{{ route('admin.peminjaman.exportPdf') }}" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>

    </div>
</div>

<!-- Tabel Peminjaman -->
<div style="padding: 20px; border-radius: 10px;">
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                {{-- <th>Username</th> --}}
                <th>Nama</th>
                <th>Plant</th>
                <th>Barang dipinjam</th>
                <th>Tanggal pinjam</th>
                <th>Keperluan</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $i => $data)
                @if ($data && $data->id) <!-- Pastikan $data dan $data->id tidak null -->
                    <tr>
                        <th scope="row">{{ $i + 1 + ($peminjamans->currentPage() - 1) * $peminjamans->perPage() }}</th>
                        <td>{{ $data->nik }}</td>
                        {{-- <td>{{ $data->username }}</td> --}}
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->plant }}</td>
                        <td>{{ $data->barang_dipinjam }}</td>
                        <td>{{ $data->tanggal_pinjam }}</td>
                        <td>{{ $data->keperluan}}</td>
                        <td>{{ $data->notes}}</td>
                        <td>{{ $data->status}}</td>
                        
                        <td>
                            <a href="{{ route('admin.peminjaman.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
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
                                            Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $data->barang_dipinjam }}</strong></p>
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
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination -->
    {!! $peminjamans->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

@endsection

<!-- CDN Bootstrap dan jQuery -->
@section('scripts')

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
    {{-- <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script> --}}
@endpush

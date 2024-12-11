@extends('userlay.user')

@section('title','Home Peminjaman')

@section('content')

<h1 class="mt-4">Peminjaman Barang</h1>


<!-- Tabel Data Peminjaman -->
<div style="padding: 20px; border-radius: 10px;">
    <table id="hpeminjamanTable" class="table table-striped table-bordered">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                {{-- <th>No</th> --}}
                <th>ID</th>
                <th>NIK</th>
                <th>Plant</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Keperluan</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $peminjaman)
                <tr>
                    {{-- <td>{{ $index + 1 }}</td> --}}
                    <td>{{ $peminjaman->id }}</td>
                    <td>{{ $peminjaman->nik }}</td>
                    <td>{{ $peminjaman->plant }}</td>
                    <td>{{ $peminjaman->barang_dipinjam }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->keperluan }}</td>
                    <td>{{ $peminjaman->notes }}</td>
                    <td>
                        @if (empty($peminjaman->status))
                            <span style="color: gray; font-style: italic; font-size: 12px; white-space: nowrap;">Menunggu Konfirmasi...</span>
                        @else
                            {{ $peminjaman->status }}
                        @endif
                    </td>
                    <td>
                        {{-- <a href="{{ route('pengembalian.index', ['id' => $peminjaman->id]) }}" class="btn btn-sm btn-primary">
                            Pengembalian
                        </a> --}}
                        <a href="{{ route('pengembalian.index', ['id' => $peminjaman->id, 'barang' => $peminjaman->barang_dipinjam]) }}" class="btn btn-sm btn-primary">
                            Pengembalian
                        </a>
                        
                    </td>
                    <td>{{ $peminjaman->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#hpeminjamanTable').DataTable({
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

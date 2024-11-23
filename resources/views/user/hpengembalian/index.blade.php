@extends('userlay.user')

@section('title','Home pengembalian')

@section('content')

<h1 class="mt-4">Pengembalian Barang</h1>
{{-- 
<div class="d-flex justify-content-end mb-3">
    <!-- Bagian Search -->
    <div class="col-auto">
        <form action="{{ route('user.hpengembalian.search') }}" method="GET">
            <div class="input-group">
                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        
        </form>
    </div>
</div> --}}

<!-- Tabel Data pengembalian -->
<div style="padding: 20px; border-radius: 10px;">
    <table id="hpengembalianTable" class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Plant</th>
                <th>Barang</th>
                <th>Tanggal Pengembalian</th>
                <th>Keperluan</th>
                <th>Notes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->nik }}</td>
                    <td>{{ $pengembalian->plant }}</td>
                    <td>{{ $pengembalian->barang_dipinjam }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                    <td>{{ $pengembalian->keperluan }}</td>
                    <td>{{ $pengembalian->notes }}</td>
                    <td>{{ $pengembalian->status }}</td>
                </tr>
            @endforeach
        </tbody>
        
        {{-- <tbody>
            @foreach($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->nik }}</td>
                    <td>{{ $pengembalian->plant }}</td>
                    <td>{{ $pengembalian->barang_dipinjam  }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                    <td>{{ $pengembalian->status }}</td>
                </tr>
            @endforeach
        </tbody> --}}
    </table>
    {{-- {!! $pengembalians->withQueryString()->links('pagination::bootstrap-5') !!} --}}
</div>

<!-- Teks Showing Entries -->
{{-- <div class="mb-3 text-right">
    <span>Showing {{ $pengembalians->count() }} of {{ $pengembalians->count() }} entries</span>
</div> --}}

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#hpengembalianTable').DataTable({
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

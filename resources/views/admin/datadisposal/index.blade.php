@extends('layouts.admin')

@section('title','Data Disposal')

@section('content')

<h1>Data Disposal</h1>

<!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
    <div class="d-flex justify-content-end mb-3">
        <!-- Bagian Search -->
        <div class="col-auto">
            <form action="{{ route('admin.datadisposal.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            
            </form>
             <a href="{{ route('admin.datadisposal.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
             <a href="{{ route('admin.datadisposal.exportPdf') }}" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>

        </div>
    </div>


<!-- Tabel Data Disposal -->
<div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
    <table class="table table-striped">
        <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
            <tr class="text-center">
            <th>No</th>
            <th>Lokasi</th>
            <th>Barang</th>
            <th>No.Asset</th>
            <th>No.Equipment</th>
            <th>Kategori</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>S/N</th>
            <th>Foto</th>
            <th>Tanggal Disposal</th>
            {{-- <th>Aksi</th> --}}
        </tr>
    </thead>
    <tbody>
        <!-- Contoh data disposal (ini akan diganti dengan data dari database) -->
        @foreach ($datadisposal as $i => $data)
        <tr class="text-center">
            <th scope="row">{{ $i + 1 + ($datadisposal->currentPage() - 1) * $datadisposal->perPage() }}</th>
            <td>{{ $data->lokasi }}</td>
            <td>{{ $data->barang }}</td>
            <td>{{ $data->no_asset }}</td>
            <td>{{ $data->no_equipment }}</td>
            <td>{{ $data->kategori->nama_kategori ?? 'Kategori tidak tersedia' }}</td> <!-- Ambil nama kategori -->
            <td>{{ $data->merk }}</td>
            <td>{{ $data->tipe }}</td>
            <td>{{ $data->sn }}</td>
            <td>
                @if($data->foto)
                    <img src="{{ asset('img/' . $data->foto) }}" alt="Foto Barang" width="100" height="100">
                @else
                    <span>Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $data->updated_at->format('d-m-Y ') }}</td>


        </tr>
        @endforeach
    </tbody>
</table>
{!! $datadisposal->withQueryString()->links('pagination::bootstrap-5') !!}
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
    </script> --}}
@endpush


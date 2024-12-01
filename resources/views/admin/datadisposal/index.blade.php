@extends('layouts.admin')

@section('title', 'Data Disposal')

@section('content')

    <h1>Data Disposal</h1>

    <div class="row align-items-center">
        <div class="col-md-4 mt-4 ms-4 ">


            <a href="{{ route('admin.datadisposal.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
            <a href="{{ route('admin.datadisposal.exportPdf') }}" class="btn btn-danger mt-1"><i
                    class="fas fa-file-pdf"></i></a>
        </div>
    </div>

    <div style="padding: 20px; border-radius: 10px;"> <!-- Padding dan border-radius -->
        <table id="datadisposalTable" class="table table-striped table-bordered"> <!-- Tambahkan id -->
            <thead style="background-color: #dc3545; color: white;">
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
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datadisposal as $i => $data)
                    <tr class="text-center">
                        <th scope="row">{{ $i + 1 }}</th>
                        <td>{{ $data->lokasi }}</td>
                        <td>{{ $data->barang }}</td>
                        <td>{{ $data->no_asset }}</td>
                        <td>{{ $data->no_equipment }}</td>
                        <td>{{ $data->kategori->nama_kategori ?? 'Kategori tidak tersedia' }}</td>
                        <td>{{ $data->merk }}</td>
                        <td>{{ $data->tipe }}</td>
                        <td>{{ $data->sn }}</td>
                        <td>
                            @if ($data->foto)
                                <img src="{{ asset('img/' . $data->foto) }}" alt="Foto Barang" width="100"
                                    height="100">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $data->updated_at->format('d-m-Y ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datadisposalTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json" // Opsional, jika ingin bahasa Indonesia
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

@endpush
 --}}

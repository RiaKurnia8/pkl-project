@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')

    
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Data Barang</h1>
   
    </br>
    
    <!-- Card untuk Filter Export -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Export</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.databarang.export') }}" method="GET" class="mb-3">
                        <div class="row align-items-end">
                            <!-- Filter Tanggal Mulai -->
                            <div class="col-auto">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <!-- Filter Tanggal Akhir -->
                            <div class="col-auto">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <!-- Filter Pencarian Umum -->
                            <div class="col-auto">
                                <label for="search">Keyword</label>
                                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Lokasi, Barang, Kategori, Status">
                            </div>
                            <!-- Filter Format File -->
                            <div class="col-md-2">
                                <label for="type">Format File</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-danger w-100">Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Card untuk Filter Search -->
    <div class="col-md-8 mt-2">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Search</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.databarang.search') }}" method="GET" class="d-flex align-items-center flex-wrap">
                    <label for="bulan" class="me-2">Filter Bulan:</label>
                    <select name="bulan" class="form-select me-2" style="max-width: 150px;" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        @php
                            $monthsIndo = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                            ];
                        @endphp
                        @foreach ($monthsIndo as $month => $monthName)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>{{ $monthName }}</option>
                        @endforeach
                    </select>

                    <label for="tanggal_awal" class="ms-3">Dari Tanggal:</label>
                    <input type="date" name="tanggal_awal" class="form-control ms-2" style="max-width: 150px;" value="{{ request('tanggal_awal') }}" onchange="this.form.submit()">

                    <label for="tanggal_akhir" class="ms-3">Sampai Tanggal:</label>
                    <input type="date" name="tanggal_akhir" class="form-control ms-2" style="max-width: 150px;" value="{{ request('tanggal_akhir') }}" onchange="this.form.submit()">
                </form>
            </div>
        </div>
    </div>
    
</div>


    <div class="d-flex justify-content-between mb-2">
        <a class="btn btn-primary" href="{{ route('admin.databarang.create') }} ">Add Data</a>
    </div>


    <div style="border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table id="databarangTable" class="table table-striped table-bordered"> <!-- Tambahkan id -->
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
                    <th>Kelayakan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggal Tambah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($databarang as $i => $data)
                    <tr class="text-center">
                        <th scope="row">{{ $i + 1 }}</th>
                        <td>{{ $data->lokasi }}</td>
                        <td>{{ $data->barang }}</td>
                        <td>{{ $data->no_asset }}</td>
                        <td>{{ $data->no_equipment }}</td>
                        <td>{{ $data->kategori->nama_kategori ?? 'Kategori tidak ada' }}</td>
                        <td>{{ $data->merk }}</td>
                        <td>{{ $data->tipe }}</td>
                        <td>{{ $data->sn }}</td>
                        <td>{{ $data->kelayakan }}</td>
                        <td>
                            @if($data->foto)
                                <img src="{{ asset('img/' . $data->foto) }}" alt="Foto Barang" width="100" height="100">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.databarang.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $data->barang }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.databarang.destroy', $data->id) }}" method="POST">
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
            </tbody>
        </table>
    </div>
    
     
      <script>
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
        $('#databarangTable').DataTable({
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


{{-- @section('scripts')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha384-pesnqDzEPzp58KTGw8ViPmq7fl0R/DpZ6PPcZn+SaH2gxvUo4EtYdciwMIzAEzXk" crossorigin="anonymous"></script>
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


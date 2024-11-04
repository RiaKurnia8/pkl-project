@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')

    {{-- pesan sukses --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Data Barang</h1>
      <!-- Bagian Filter Bulan, Search, dan Export -->
    </br>
    <div class="row mb-3 align-items-center">
        <!-- Dropdown Filter Bulan -->
        <div class="col-md-4">
            <form action="{{ route('admin.databarang.search') }}" method="GET" class="d-flex align-items-center">
                <label for="bulan" class="me-2">Filter Bulan:</label>
                <select name="bulan" class="form-select me-0" style="max-width: 150px; margin-right: -2px;" onchange="this.form.submit()">
                    <option value="">Semua Bulan</option>
                    @php
                        $monthsIndo = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];
                    @endphp
                    @foreach ($monthsIndo as $month => $monthName)
                        <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                            {{ $monthName }}
                        </option>
                    @endforeach
                </select>
                <!-- Tombol Submit untuk Filter Bulan -->
                <button type="submit" class="btn btn-primary" style="margin-left: -1px;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <form action="" method="GET" id="exportForm">
            <label for="lokasi">Print Berdasarkan Lokasi:</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi" required>
        
            <button type="submit" onclick="setFormAction('excel')" class="btn btn-success">
                <i class="fas fa-file-excel"></i> 
            </button>
        
            <button type="submit" onclick="setFormAction('pdf')" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> 
            </button>
        </form>
        {{-- <form action="{{ route('export.location') }}" method="GET">
            <label for="lokasi">Masukkan Lokasi:</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi" required>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-file-excel "></i> 
            </button>
        </form>
        <form action="{{ route('export.pdf.location') }}" method="GET">
            <label for="lokasi">Masukkan Lokasi:</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi" required>
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-file-pdf "></i> 
            </button>
        </form> --}}
    </div>
    


    <!-- Bagian Search di atas, PDF dan Excel di bawahnya di sebelah kanan -->
    
    <div class="d-flex justify-content-end mb-3">
        <!-- Bagian Search -->
        <div class="col-auto">
            <form action="{{ route('admin.databarang.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" id="form1" name="cari" class="form-control" placeholder="Search" value="{{ request('cari') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            
            </form>
               
        
        
             <a href="{{ route('admin.databarang.xls') }}" class="btn btn-success mt-1"><i class="fas fa-file-excel"></i></a>
             <a href="{{ route('admin.databarang.exportPdf') }}" class="btn btn-danger mt-1"><i class="fas fa-file-pdf"></i></a>

        </div>
    </div>
    

    <!-- Tabel Data Barang -->
    <div style=" border-radius: 5px;"> <!-- Padding dan border-radius -->
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
                    <th>Kelayakan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggal Tambah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($databarang as $i => $data)
                    <!-- Contoh data barang (ini akan diganti dengan data dari database) -->
                    <tr class="text-center">
                        {{-- <th scope="row">{{ $i + 1 }}</th> --}}
                        <th scope="row">{{ $i + 1 + ($databarang->currentPage() - 1) * $databarang->perPage() }}</th>
                        <td>{{ $data->lokasi }}</td>
                        <td>{{ $data->barang }}</td>
                        <td>{{ $data->no_asset }}</td>
                        <td>{{ $data->no_equipment }}</td>
                        <td>
                            @if($data->kategori)
                                {{ $data->kategori->nama_kategori }}
                            @else
                                Kategori tidak ada
                            @endif
                        </td>
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
                        <td>{{ $data->created_at->format('d-m-Y ') }}</td> <!-- Tanggal Tambah -->
                        
                        {{-- <td>
                            <form action="{{ route('admin.databarang.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.databarang.edit', $data->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                            </a>
                            <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i></button>

                            </form>
                        </td> --}}
                         <!-- Tombol Aksi -->
                <td>
                    <a href="{{ route('admin.databarang.edit', $data->id) }}" class="btn btn-warning btn-sm">
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
                                    Apakah Anda yakin ingin menghapus data ini? <p><strong>{{ $data->barang }}</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.databarang.destroy', $data->id) }}" method="POST" style="display:inline;">
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

        <a class="btn btn-primary" href="{{ route('admin.databarang.create') }} ">Add Data</a>
        {!! $databarang->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>

      <!-- Script to set form action for export -->
      <script>
        function setFormAction(format) {
            const form = document.getElementById('exportForm');
            if (format === 'excel') {
                form.action = "{{ route('export.location') }}";
            } else if (format === 'pdf') {
                form.action = "{{ route('export.pdf.location') }}";
            }
        }
    </script>

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

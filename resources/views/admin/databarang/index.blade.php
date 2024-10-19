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

             {{-- import 
             <form action="">
                <input type="file" class="form-control @error('filexls') is-invalid @enderror" name="filexls" >
                @error('filexls')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                <button class="btn btn-info" type="submit">imp xls</button>
             </form> --}}
        </div>
    </div>
    
    <!-- Tombol Ekspor PDF dan Excel di bawah Search -->
    {{-- <div class="d-flex justify-content-end">
        <div class="btn-group">
            <button class="btn btn-danger btn-sm mr-2">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
            <button class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> XLS
            </button>
        </div>
    </div> --}}
    

    <!-- Tabel Data Barang -->
    <div style=" border-radius: 5px;"> <!-- Padding dan border-radius -->
        <table class="table table-striped">
            <thead style="background-color: #dc3545; color: white;"> <!-- Mengatur background merah hanya untuk thead -->
                <tr>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($databarang as $i => $data)
                    <!-- Contoh data barang (ini akan diganti dengan data dari database) -->
                    <tr>
                        {{-- <th scope="row">{{ $i + 1 }}</th> --}}
                        <th scope="row">{{ $i + 1 + ($databarang->currentPage() - 1) * $databarang->perPage() }}</th>
                        <td>{{ $data->lokasi }}</td>
                        <td>{{ $data->barang }}</td>
                        <td>{{ $data->no_asset }}</td>
                        <td>{{ $data->no_equipment }}</td>
                        <td>{{ $data->kategori }}</td>
                        <td>{{ $data->merk }}</td>
                        <td>{{ $data->tipe }}</td>
                        <td>{{ $data->sn }}</td>
                        <td>{{ $data->kelayakan }}</td>
                        {{-- foto --}}
                        {{-- <td><img src="{{ asset('img/'.$data->foto) }}?{{ time() }}" width="40"></td> --}}
                        {{-- <td>
                            <img src="{{ asset('img/'.$data->foto) }}" width="100">
                        </td> --}}
                        <td>
                            @if($data->foto)
                                <img src="{{ asset('img/' . $data->foto) }}" alt="Foto Barang" width="100" height="100">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        
                        <td>{{ $data->status }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.databarang.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ route('admin.databarang.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.databarang.edit', $data->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                            </a>
                            <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i></button>

                            </form>
                            {{-- <a href="" class="btn btn-danger">
                                <i class="fas fa-trash"></i> <!-- Ikon Hapus -->
                            </a> --}}
                        </td>
                        {{-- <td>
                <!-- Dropdown Aksi -->
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="aksiDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="aksiDropdown">
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Status</a>
                        <a class="dropdown-item text-danger" href="#">Hapus</a>
                    </div>
                </div>
            </td> --}}
                    </tr>
                @endforeach


                <!-- Tambahkan baris data lainnya di sini -->
            </tbody>
        </table>

        <!-- Tombol Add Data di bagian bawah -->
        {{-- <div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary" style="font-size: 16px; padding: 3px 10px;">Add Data</button> --}}
        <a class="btn btn-primary" href="{{ route('admin.databarang.create') }} ">Add Data</a>
        {!! $databarang->withQueryString()->links('pagination::bootstrap-5') !!}

        <!-- Pagination dengan nomor halaman di tengah -->
        {{-- <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Tombol Previous -->
                <li class="page-item">
                    <button class="btn btn-light" aria-label="Previous">
                        Previous
                    </button>
                </li>

                <!-- Nomor Halaman -->
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>

                <!-- Tombol Next -->
                <li class="page-item">
                    <button class="btn btn-light" aria-label="Next">
                        Next
                    </button>
                </li>
            </ul>
        </nav> --}}
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

@extends('layouts.admin')

@section('title', 'plant')

@section('content')


@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<h1>Plant</h1>

<a class="btn btn-primary" href="{{ route('admin.plant.create') }} ">Add Data</a>

<div style="padding: 20px; border-radius: 10px;">
    <table id="plantTable" class="table table-striped">
        <thead style="background-color: #dc3545; color: white;">
            <tr>
                <th>No</th>
                <th>Plant</th>
                <th>Status</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plants as $i => $data)
                
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data->plant }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <a href="{{ route('admin.plant.edit', $data->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $data->id }}">
                            <i class="fas fa-trash"></i>
                        </button>

                      
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
                                            <strong>{{ $data->plant }}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.plant.destroy', $data->id) }}" method="POST"
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
        $('#plantTable').DataTable({
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

@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/css/toastr.css" rel="stylesheet">
@endpush

@push('js')

    <script src="https://code.jquery.com/jquery-3.7.2.min.js"
            integrity="sha384-pesnqDzEPzp58KTGw8ViPmq7fl0R/DpZ6PPcZn+SaH2gxvUo4EtYdciwMIzAEzXk" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/js/toastr.js"></script>

@endpush --}}

{{-- @extends('layouts.admin')

@section('title', 'Plant')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid">

                    <h1>Plant</h1>
                    <div style="padding: 20px; border-radius: 10px;">
                    <a href="{{ route('admin.plant.create') }}" class="btn btn-primary mb-2 mt-4">Tambah Data</a>
                    <div class="table-responsive">
                    <table id="tbl_list" class="table table-striped table-bordered table-hover align-middle">
                        <thead style="background-color: #dc3545; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Plant</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data diisi otomatis oleh DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script type="text/javascript">
$(document).ready(function () {
    $('#tbl_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url()->current() }}',
        columns: [
            
            // { data: 'id', name: 'id' },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },  // Kolom nomor urut
            { data: 'plant', name: 'plant' },
            { data: 'status', name: 'status' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false } // Kolom aksi tidak dapat diurutkan/dicari
        ],
        language: {
            paginate: {
                next: '&raquo;',
                previous: '&laquo;'
            }
        },
        responsive: true,
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
    });
});

// Fungsi hapus data
function hapusData(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('admin/plant') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#tbl_list').DataTable().ajax.reload(null, false); // Reload data tanpa refresh halaman
                    Swal.fire('Berhasil!', response.message, 'success'); // Menampilkan pesan sukses
                },
                error: function (xhr) {
                    Swal.fire('Gagal!', xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        }
    });

    
}
</script>
@endpush
 --}}

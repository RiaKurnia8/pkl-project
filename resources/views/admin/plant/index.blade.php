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
<div class="mt-4 ms-3">
    <a class="btn btn-primary" href="{{ route('admin.plant.create') }}">Add Data</a>
</div>

<div style="padding: 20px; border-radius: 10px;">
    <table id="plantTable" class="table table-striped table-bordered">
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
                        
                        {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
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
                        </div> --}}
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


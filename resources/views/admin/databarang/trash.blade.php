@extends('layouts.admin')

@section('title', 'Sampah')

@section('content')

    {{-- pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Databarang Sampah</h1>

    <div class="table-responsive"> <!-- Padding dan border-radius -->
        <table id="barangTable" class="table table-striped table-bordered"> <!-- Tambahkan id -->
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
                            @if ($data->foto)
                                <img src="{{ asset('img/' . $data->foto) }}" alt="Foto Barang" width="100"
                                    height="100">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                        <td>
                            <!-- Tombol Restore yang memicu modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $data->id }}">
                                <i class="fas fa-undo"></i> <!-- Ikon Restore -->
                            </button>
                        
                            <!-- Modal Konfirmasi Restore -->
                            <div class="modal fade" id="restoreModal{{ $data->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="restoreModalLabel{{ $data->id }}">Konfirmasi Restore</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin mengembalikan data ini dari Riwayat Sampah?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.databarang.restore', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT') <!-- Simulasikan metode PUT -->
                                                <button type="submit" class="btn btn-primary">Restore</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Tombol Hapus Permanen yang memicu modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#permanentDeleteModal{{ $data->id }}">
                                <i class="fas fa-trash-alt"></i> <!-- Ikon Hapus Permanen -->
                            </button>
                        
                            <!-- Modal Konfirmasi Penghapusan Permanen -->
                            <div class="modal fade" id="permanentDeleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="permanentDeleteModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="permanentDeleteModalLabel{{ $data->id }}">Konfirmasi Penghapusan Permanen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini secara permanen?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.databarang.forceDelete', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus Permanen</button>
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
            $('#barangTable').DataTable({
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

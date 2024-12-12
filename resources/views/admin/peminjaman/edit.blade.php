@extends('layouts.admin')

@section('title', 'Edit Data Peminjaman')

@section('content')

<a href="{{ url()->previous() }}" class="text-danger">
    <i class="fa-solid fa-arrow-left-long"></i></a>
    <h2 style="text-align: center;">Edit Data Peminjaman</h2>
   

    <!-- Pesan error jika data peminjaman tidak ditemukan -->
    @if (!$peminjaman)
        <div class="alert alert-danger">
            Data peminjaman tidak ditemukan.
        </div>
    @else
        <!-- Form untuk edit data peminjaman -->
        <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Input fields here -->
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    @endif

@endsection

@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

<h1>Edit Kategori</h1>

<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Menampilkan pesan error jika ada -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Form Edit Kategori -->
<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Form Group Nama Kategori -->
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
        
        <!-- Error Feedback -->
        @error('nama_kategori')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    
    <!-- Tombol Update -->
    <button type="submit" class="btn btn-success">Update</button>
    
    <!-- Tombol Cancel -->
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection

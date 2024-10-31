@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <h1>Edit Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Kolom Status -->
        <div class="form-group mb-4">
            <label>Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_on" value="on" {{ $kategori->status == 'on' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_on">On</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_off" value="off" {{ $kategori->status == 'off' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_off">Off</label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
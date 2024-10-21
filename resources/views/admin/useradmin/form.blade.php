@extends('layouts.admin')
@section('title')
    Tambah User
@endsection

@section('content')
    <div>
        <h2 style="text-align: center;">Tambah User</h2>
        
        {{-- Tampilkan pesan kesalahan jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.useradmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                        @error('name')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}">
                            @error('username')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}">
                            @error('nomor_hp')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant</label>
                            <input type="text" class="form-control @error('plant') is-invalid @enderror" name="plant" id="plant" value="{{ old('plant') }}">
                            @error('plant')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Back -->
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

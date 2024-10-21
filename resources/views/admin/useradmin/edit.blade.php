@extends('layouts.admin')
@section('title')
    Tambah User

@section('content')
    <div>
        <h2 style="text-align: center;">Edit User</h2>
        {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        
    @endif --}}
        <form action="{{ route('admin.useradmin.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ $user->name }}">
                            @error('name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" value="{{ $user->nik }}">
                            @error('nik')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                                id="username" value="{{ $user->username }}">
                            @error('username')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                name="nomor_hp" id="nomor_hp" value="{{ $user->nomor_hp }}">
                            @error('nomor_hp')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant</label>
                            <input type="text" class="form-control @error('plant') is-invalid @enderror"
                                name="plant" id="plant" value="{{ $user->plant }}">
                            @error('plant')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                id="jenis_kelamin" value="{{ $user->jenis_kelamin }}">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"
                                id="password" value="{{ $user->password }}">
                            @error('password')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Back -->
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>

                        </br>
                        </br> </br> </br>
                        <!-- Tombol Submit -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection


@section('scripts')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">


@endsection

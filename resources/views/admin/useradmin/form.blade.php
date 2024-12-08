@extends('layouts.admin')
@section('title')
    Tambah User
@endsection

@section('content')
    <div>
        <h2 style="text-align: center;">Tambah User</h2>

        {{-- Tampilkan pesan kesalahan jika ada --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.useradmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama (Nama, NIK, Username, No HP) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" value="{{ old('nik') }}" maxlength="5"
                                oninput="this.value = this.value.slice(0, 5)">
                            @error('nik')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="usertype" class="form-label">Usertype</label>
                            <select class="form-control @error('usertype') is-invalid @enderror" name="usertype"
                                id="usertype">
                                <option value="">-- Pilih Usertype --</option>
                                <option value="admin" {{ old('admin') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('user') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('usertype')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}">
                            @error('nomor_hp')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kedua (Plant, Jenis Kelamin, Password) -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="plant_id" class="form-label">Plant</label>
                            <select name="plant_id" id="plant_id"
                                class="form-control @error('plant_id') is-invalid @enderror">
                                <option value="">-- Pilih Plant --</option>
                                @foreach ($plants as $plant)
                                    <option value="{{ $plant->id }}"
                                        {{ old('plant_id', isset($user) ? $user->plant_id : '') == $plant->id ? 'selected' : '' }}>
                                        {{ $plant->plant }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plant_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                id="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Password Baru dengan icon toggle visibility -->
                        <!-- Input Password Baru dengan icon toggle visibility -->
                        {{-- <div style="position: relative; margin-bottom: 16px;">
                            <label for="password" style="font-size: 14px;">Password</label>
                            <input id="password" name="password" type="password" required
                                class="form-control @error('password') is-invalid @enderror"
                                style="padding-right: 40px; border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
                            <span onclick="togglePasswordVisibility('password')"
                                style="display: flex; align-items: center; position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer;">
                                <i id="toggleIcon_password" class="fas fa-eye"></i>
                            </span>
                            @error('password')
                                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div style="position: relative; margin-bottom: 16px;">
                            <label for="password" style="font-size: 14px;">Password</label>
                            <input id="password" name="password" type="password" required
                                class="form-control @error('password') is-invalid @enderror"
                                style="padding-right: 40px; border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;"
                                value="sasainti" readonly>
                            <span onclick="togglePasswordVisibility('password')"
                                style="display: flex; align-items: center; position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer;">
                                <i id="toggleIcon_password" class="fas fa-eye"></i>
                            </span>
                            @error('password')
                                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            function togglePasswordVisibility(fieldId) {
                                const field = document.getElementById(fieldId);
                                const icon = document.getElementById(`toggleIcon_${fieldId}`);
                                if (field.type === 'password') {
                                    field.type = 'text';
                                    icon.classList.remove('fa-eye');
                                    icon.classList.add('fa-eye-slash');
                                } else {
                                    field.type = 'password';
                                    icon.classList.remove('fa-eye-slash');
                                    icon.classList.add('fa-eye');
                                }
                            }
                        </script>


                    </div>
                </div>

                <!-- Tombol Submit dan Back -->
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
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
@endsection

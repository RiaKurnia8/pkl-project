@extends('layouts.admin')
@section('title')
    Edit User
@endsection

@section('content')
    <div>
        <h2 style="text-align: center;">Edit User</h2>

        <form action="{{ route('admin.useradmin.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <!-- Kolom Pertama (Nama, NIK, Username, No HP) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" style="font-weight: bold;" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ $user->name }}">
                            @error('name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nik" style="font-weight: bold;" class="form-label">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" value="{{ $user->nik }}" maxlength="5"
                                oninput="this.value = this.value.slice(0, 5)" readonly>
                            @error('nik')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="usertype" style="font-weight: bold;">Usertype:</label>
                            <select id="usertype" name="usertype" required
                                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
                                <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>
                                    User
                                </option>
                            </select>
                            @error('usertype')
                                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                                id="username" value="{{ $user->username }}">
                            @error('username')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="nomor_hp" style="font-weight: bold;" class="form-label">No. Hp</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                name="nomor_hp" id="nomor_hp" value="{{ $user->nomor_hp }}">
                            @error('nomor_hp')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Back berada di bawah inputan No HP -->
                        <div class="mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>

                    <!-- Kolom Kedua (Plant, Jenis Kelamin, Password) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="plant_id" style="font-weight: bold;" class="form-label">Plant</label>
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

                        <!-- Input Jenis Kelamin -->
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" style="font-weight: bold;">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="card p-3">

                        <div style="position: relative; margin-bottom: 16px; ">
                            <label for="password" style="font-weight: bold; ">Reset Password</label>
                            <input id="password" name="password" type="password" readonly
                                class="form-control @error('password') is-invalid @enderror"
                                style="padding-right: 40px; border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
                            <span onclick="togglePasswordVisibility('password')"
                                style="display: flex; align-items: center; position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer;">
                                <i id="toggleIcon_password" class="fas fa-eye"></i>
                            </span>
                            @error('password')
                                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Tombol Reset Password Default -->
                        <div class="mb-2">
                            <form action="{{ route('admin.user.resetPassword') }}" method="POST" id="resetPasswordForm">
                                @csrf
                                <input type="hidden" name="password" value="sasainti">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Reset Password Default</button>
                            </form>
                        </div>
                        
                        <!-- Modal Konfirmasi -->
                        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordModalLabel">Konfirmasi Reset Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin mereset password ke default?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-warning" id="confirmResetPasswordBtn">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                        <script>
                            document.getElementById('confirmResetPasswordBtn').addEventListener('click', function () {
                                const passwordField = document.getElementById('password');
                        
                                // Menampilkan password default
                                passwordField.value = 'sasainti';
                        
                                // Tetap read-only setelah reset
                                passwordField.setAttribute('readonly', 'readonly');
                        
                                // Menutup modal sebelum form dikirim
                                const modalElement = document.getElementById('resetPasswordModal');
                                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                                modalInstance.hide(); // Menutup modal langsung
                        
                                // Submit form setelah modal ditutup
                                setTimeout(() => {
                                    document.getElementById('resetPasswordForm').submit();
                                }, 200); // Delay kecil untuk memastikan modal tertutup terlebih dahulu
                            });
                        
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
                        
                        
                        
                        

                        <!-- Tombol Submit sejajar dengan tombol Back -->
                        <div class="mb-12 d-flex justify-content-end" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-success">Simpan</button>
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
@endsection

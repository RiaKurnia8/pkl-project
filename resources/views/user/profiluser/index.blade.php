@extends('userlay.user')

{{-- @section('title','Profil User')

@section('content')

<h1>Profil User</h1>
<section>


    <!-- Form untuk update profile -->
    <form method="POST" action="#" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Input NIK -->
        <div>
            <label for="nik" class="block text-sm font-medium text-gray-700">{{ __('NIK') }}</label>
            <input id="nik" name="nik" type="text" class="mt-1 block w-full" value="{{ old('nik', auth()->user()->nik) }}" readonly>
            @error('nik')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', auth()->user()->name) }}" required>
            @error('name')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" name="username" type="text" class="mt-1 block w-full" value="{{ old('username', auth()->user()->username) }}" required>
            @error('username')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Nomor HP -->
       <div class="mb-3">
        <label for="nomor_hp" class="form-label">No. HP</label>
            <input id="nomor_hp" name="nomor_hp" type="text" class="mt-1 block w-full" value="{{ old('nomor_hp', auth()->user()->nomor_hp) }}" required>
            @error('nomor_hp')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Plant -->
        <div class="mb-3">
            <label for="plant" class="form-label">Plant</label>
            <input id="plant" name="plant" type="text" class="mt-1 block w-full" value="{{ old('plant', auth()->user()->plant) }}" required>
            @error('plant')
            <p style="color: red">{{ $message }}</p>
        @enderror
        </div>

        <!-- Input Jenis Kelamin -->
        <div class="mb-3">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">{{ __('Jenis Kelamin') }}</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

<!-- Tombol Simpan -->
<div class="flex items-center gap-4">
    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
</div>

</form>
</section>

<!-- SweetAlert popup jika profil berhasil diperbarui -->
@if (session('status') === 'profile-updated')
<script>
Swal.fire({
    icon: 'success',
    title: 'Profil berhasil diperbarui!',
    text: 'Informasi profil Anda telah diperbarui.',
    confirmButtonText: 'OK',
    timer: 3000,
});
</script>
@endif

@endsection --}}
@section('title', 'Profil User')

@section('content')

<h1 style="font-size: 30px; font-weight: bold; color: #B91C1C;">Edit Profil</h1>
<section style="background-color: #f3f4f6; padding: 15px; border-radius: 6px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">

    <form method="POST" action="{{ route('profile.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('PATCH')

        <!-- Input NIK -->
        <div class="form-group mb-3">
            <label for="nik" style="font-weight: bold; font-size: 14px; display: block;">NIK:</label>
            <input id="nik" name="nik" type="text" value="{{ old('nik', auth()->user()->nik) }}" readonly
                style="background-color: #d1d5db; border: none; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
            @error('nik')
                <p class="text-sm text-red-600 mt-1" style="font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Nama -->
        <div class="form-group mb-3">
            <label for="name" style="font-weight: bold; font-size: 14px;">Nama:</label>
            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
            @error('name')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Username -->
        <div class="form-group mb-3">
            <label for="username" style="font-weight: bold; font-size: 14px;">Username:</label>
            <input id="username" name="username" type="text" value="{{ old('username', auth()->user()->username) }}" required
                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
            @error('username')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Nomor HP -->
        <div class="form-group mb-3">
            <label for="nomor_hp" style="font-weight: bold; font-size: 14px;">No. HP:</label>
            <input id="nomor_hp" name="nomor_hp" type="text" value="{{ old('nomor_hp', auth()->user()->nomor_hp) }}" required
                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
            @error('nomor_hp')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Plant -->
        <div class="form-group mb-3">
            <label for="plant" style="font-weight: bold; font-size: 14px;">Plant:</label>
            <input id="plant" name="plant" type="text" value="{{ old('plant', auth()->user()->plant) }}" required
                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
            @error('plant')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Jenis Kelamin -->
        <div class="form-group mb-3">
            <label for="jenis_kelamin" style="font-weight: bold; font-size: 14px;">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required
                style="border: 1px solid #d1d5db; padding: 8px; width: 100%; font-size: 14px; border-radius: 4px;">
                <option value="Laki-laki" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Kembali dan Simpan -->
        <div class="flex justify-between mt-4">
            <a href="{{ url()->previous() }}" style="background-color: #dc2626; color: #fff; padding: 8px 16px; font-size: 14px; border-radius: 4px; text-decoration: none; ">BACK</a>
            <button type="submit" style="background-color: #dc2626; color: #fff; padding: 8px 16px; font-size: 14px; border: none; border-radius: 4px;">SAVE</button>
        </div>

    </form>

    <!-- SweetAlert popup jika profil berhasil diperbarui -->
    @if (session('status') === 'profile-updated')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Profil berhasil diperbarui!',
            text: 'Informasi profil Anda telah diperbarui.',
            confirmButtonText: 'OK',
            timer: 3000,
        });
    </script>
    @endif

</section>
@endsection

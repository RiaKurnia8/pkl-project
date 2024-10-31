{{-- @extends('layouts.admin')

@section('title','Update Password')

@section('content')

<h1>Ubah Password</h1>

<!-- Update Password Section -->
<section class="mt-8">

    <!-- Form -->
    <form method="POST" action="{{ route('profile.updatePassword') }}" class="space-y-6">
        @csrf

        <!-- Input Password Lama -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full" required>
            @error('current_password')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Password Baru -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" required>
            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password Baru -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm New Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required>
            @error('password_confirmation')
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
    title: 'Password berhasil diperbarui!',
    text: 'Informasi password Anda telah diperbarui.',
    confirmButtonText: 'OK',
    timer: 3000,
});
</script>
@endif

@endsection --}}
@extends('layouts.admin')

@section('title','Update Password')

@section('content')

<h1 style="font-size: 24px; font-weight: bold; color: #B91C1C;">Reset Password</h1>

<!-- Update Password Section -->
<section style="background-color: #d1d5db; padding: 20px; border-radius: 8px; margin-top: 10px;">

    <!-- Form -->
    <form method="POST" action="{{ route('profile.updatePassword') }}" class="space-y-4">
        @csrf

        <!-- Input Password Lama -->
        <div style="position: relative;">
            <label for="current_password" style="font-weight: bold; font-size: 14px;">Password Awal:</label>
            <input id="current_password" name="current_password" type="password" required
                   style="border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                <!-- Tambahkan ikon mata untuk toggle visibility -->
            </span>
            @error('current_password')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Password Baru -->
        <div style="position: relative;">
            <label for="password" style="font-weight: bold; font-size: 14px;">Password Baru:</label>
            <input id="password" name="password" type="password" required
                   style="border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                
            </span>
            @error('password')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password Baru -->
        <div style="position: relative;">
            <label for="password_confirmation" style="font-weight: bold; font-size: 14px;">Konfirmasi Password:</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   style="border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                
            </span>
            @error('password_confirmation')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Kembali dan Simpan -->
        <div class="flex justify-between mt-4">
            <a href="{{ url()->previous() }}" style="background-color: #dc2626; color: #fff; padding: 10px 24px; font-size: 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">BACK</a>
            <button type="submit" style="background-color: #dc2626; color: #fff; padding: 10px 24px; font-size: 16px; border: none; border-radius: 6px; font-weight: bold;">SAVE</button>
        </div>
    </form>
</section>

<!-- SweetAlert popup jika profil berhasil diperbarui -->
@if (session('status') === 'profile-updated')
<script>
Swal.fire({
    icon: 'success',
    title: 'Password berhasil diperbarui!',
    text: 'Informasi password Anda telah diperbarui.',
    confirmButtonText: 'OK',
    timer: 3000,
});
</script>
@endif

@endsection

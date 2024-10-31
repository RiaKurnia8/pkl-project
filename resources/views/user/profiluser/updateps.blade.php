@extends('userlay.user')

@section('title', 'Update Password')

@section('content')

    <h1 style="font-size: 30px; font-weight: bold; color: #B91C1C;">Edit Password</h1>

    <!-- Update Password Section -->
    <section style="background-color: #d1d5db; padding: 20px; border-radius: 8px; margin-top: 10px;">

        <!-- Form -->
        <form method="POST" action="{{ route('user.profile.updatePassword') }}" class="space-y-4">
            @csrf

            <!-- Input Password Lama -->
            <div style="position: relative;">
                <label for="current_password" style="font-weight: bold; font-size: 14px;">Password Awal:</label>
                <input id="current_password" name="current_password" type="password" required
                    style="border: 1px solid #333; padding: 8px; width: 100%; border-radius: 4px; font-size: 14px;">
                <span onclick="togglePasswordVisibility('current_password')"
                    style="display: flex; align-items: center; position: absolute; right: 10px; top: 10px; height: 100%; cursor: pointer;">
                    <i id="toggleIcon_current_password" class="fas fa-eye"></i>
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
                <span onclick="togglePasswordVisibility('password')"
                    style="display: flex; align-items: center; position: absolute; right: 10px; top: 10px; height: 100%; cursor: pointer;">
                    <i id="toggleIcon_password" class="fas fa-eye"></i>
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
                <span onclick="togglePasswordVisibility('password_confirmation')"
                    style="display: flex; align-items: center; position: absolute; right: 10px; top: 10px; height: 100%; cursor: pointer;">
                    <i id="toggleIcon_password_confirmation" class="fas fa-eye"></i>
                </span>
                @error('password_confirmation')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror
            </div>



            <!-- Tombol Kembali dan Simpan -->
            <div class="flex justify-between mt-4">
                <a href="{{ url()->previous() }}"
                    style="background-color: #dc2626; color: #fff; padding: 10px 24px; font-size: 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">BACK</a>
                <button type="submit"
                    style="background-color: #dc2626; color: #fff; padding: 10px 24px; font-size: 16px; border: none; border-radius: 6px; font-weight: bold;">SAVE</button>
            </div>
        </form>
    </section>

    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggleIcon_' + fieldId);

            // Toggle the input type
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous">
    </script>

</head>

<body style="background-color: #e8f0fe;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card"
            style="width: 500px; border-radius: 15px; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body text-center">
                <!-- Logo -->
                <center><img src="{{ asset('assets/images/sasa.png') }}" alt="Logo" class="mb-3"
                        style="width: 150px;" /></center>
                </br>

                <!-- Title -->

                <h1 class="card-title mb-4" style="font-weight: bold; color: #d93025; font-size: 30px;">LOGIN</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- NIK Address -->
                    {{-- <div class="mb-3">
                        <input id="nik" class="form-control text-center" type="number" name="nik"
                            :value="old('nik')" required autofocus autocomplete="username"
                            placeholder="Masukkan NIK Anda" style="border-radius: 30px; border: 2px solid #d93025;"
                            maxlength="5" oninput="if(this.value.length > 5) this.value = this.value.slice(0, 5);" />
                        @error('nik')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <input id="nik" class="form-control text-center" type="text" name="nik"
                            value="{{ old('nik') }}" required autofocus autocomplete="username"
                            placeholder="Masukkan NIK Anda" style="border-radius: 30px; border: 2px solid #d93025;"
                            maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5);" />
                        @error('nik')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <!-- Password -->
                    {{-- <div class="mb-3">
                        <input id="password" class="form-control text-center" type="text" name="password" required autocomplete="current-password" placeholder="Masukkan Password Anda"
                        style="border-radius: 30px; border: 2px solid #d93025;">
                        <span onclick="togglePasswordVisibility('password')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i id="toggleIcon_password" class="fas fa-eye"></i>
                        </span>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div> --}}


                    <div class="mb-4 position-relative">
                        <input id="password" class="form-control text-center" type="password" name="password" required
                            autocomplete="current-password" placeholder="Masukkan Password Anda"
                            style="border-radius: 30px; border: 2px solid #d93025;" />

                        <span onclick="togglePasswordVisibility('password')"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i id="toggleIcon_password" class="fas fa-eye"></i>
                        </span>

                        <!-- Error Message -->
                        @error('password')
                        <div class="text-danger mt-1" style="position: absolute; bottom: -30px; width: 100%; text-align: center;">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-danger w-100 mt-5 mb-3"
                        style="border-radius: 30px; font-weight: bold; font-size: 20px; background-color: #d93025; color: white;">LOGIN</button>

                    <!-- Register Link -->
                    {{-- <div class="mt-3">
                        Belum punya akun? <a href="{{ route('register') }}" style="color: #d93025; text-decoration: none;">Daftar</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggleIcon_' + fieldId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>

</html>

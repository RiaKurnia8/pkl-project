<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 400px; border-radius: 15px;">
            <div class="card-body text-center">
                <!-- Logo -->
                <center><img src="{{ asset('assets/images/sasa.png') }}" alt="Logo" class="mb-4" style="width: 150px; "  /></center>


                <!-- Title -->
                <h1 class="card-title mb-4" style="font-weight: bold; color: #d93025; font-size: 30px;">LOGIN</h1>


                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- NIK Address -->
                    <div class="mb-3" style="margin-bottom: 20px;">
                        <input id="nik" class="form-control text-center" type="text" name="nik" :value="old('nik')" required autofocus autocomplete="username" placeholder="Masukkan NIK Anda" style="border-radius: 30px; width: 100%;" />
                        <x-input-error :messages="$errors->get('nik')" class="mt-2" /> <!-- Ganti referensi kesalahan -->
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-3" style="margin-bottom: 50px;">
                        <input id="password" class="form-control text-center" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan Password Anda" style="border-radius: 30px; width: 100%;" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-danger w-100" style="border-radius: 30px; font-weight: bold; font-size: 20px; background-color: #d93025; width: 100%; color: white; padding: 6px 0;">LOGIN</button>


                    <!-- Register Link -->
                    <div class="mt-3">
                        Belum punya akun? <a href="{{ route('register') }}" style="color: #d93025; text-decoration: none;">Daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

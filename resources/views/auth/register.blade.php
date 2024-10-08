<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 400px; border-radius: 15px;">
            <div class="card-body text-center">
                <!-- Logo -->
                <center><img src="{{ asset('assets/images/sasa.png') }}" alt="Logo" class="mb-4" style="width: 150px; "  /></center>


                <!-- Title -->
                <h1 class="card-title mb-4" style="font-weight: bold; color: #d93025; font-size: 28px;">REGISTER</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <!-- nik Address -->
         <div class="mt-4">
            <x-input-label for="nik" :value="__('NIK')" /> <!-- Ganti 'Email' dengan 'NIK' -->
            <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required autocomplete="username" /> <!-- Ganti 'email' dengan 'nik' -->
            <x-input-error :messages="$errors->get('nik')" class="mt-2" /> <!-- Ganti referensi kesalahan -->
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

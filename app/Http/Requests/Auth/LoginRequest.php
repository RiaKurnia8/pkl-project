<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'digits:5', 'exists:users,nik'],
            'password' => ['required', 'string'],
        ];
    }

    //pesan error
    public function messages(): array
    {
        return [
            'nik.required' => 'Masukkan NIK Anda.',
            'nik.string' => 'NIK harus berupa string.',
            'nik.digits' => 'NIK harus terdiri dari 5 angka.',
            'nik.exists' => 'NIK yang dimasukkan tidak terdaftar.',
            'password.required' => 'Masukkan Password Anda.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    // Cek apakah NIK yang dimasukkan ada di database
    $user = \App\Models\User::where('nik', $this->nik)->first();

    // Jika NIK tidak ditemukan
    if (! $user) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'nik' => 'NIK yang Anda masukkan salah.',
        ]);
    }

    // Jika NIK ditemukan tapi password salah
    if (! Auth::attempt($this->only('nik', 'password'), $this->boolean('remember'))) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'password' => 'Password yang Anda masukkan salah.',
        ]);
    }

    // Jika NIK dan password keduanya benar
    RateLimiter::clear($this->throttleKey());
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'nik' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('nik')).'|'.$this->ip());
    }
}

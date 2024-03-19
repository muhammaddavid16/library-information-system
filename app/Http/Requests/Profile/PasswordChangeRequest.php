<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class PasswordChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'max:100', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'Kata sandi saat ini',
            'password' => 'Kata sandi baru',
            'password_confirmation' => 'Konfirmasi Kata sandi',
        ];
    }
}

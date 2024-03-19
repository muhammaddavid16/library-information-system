<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UserAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('access-admin');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'username' => ['required', 'max:100', 'unique:users,username'],
            'password' => ['required', 'max:100', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'role' => ['required', 'in:admin,staff'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama lengkap',
            'username' => 'Nama pengguna',
            'password' => 'Kata sandi',
            'role' => 'Peran',
        ];
    }
}

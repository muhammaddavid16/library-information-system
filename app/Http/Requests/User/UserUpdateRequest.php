<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('access-admin');
    }

    public function rules(): array
    {
        $user = $this->route('user');
        $unique = $this->input('username') !== $user->username ? 'unique:users,username' : '';

        return [
            'name' => ['required', 'max:100'],
            'username' => ['required', 'max:100', $unique],
            'role' => ['required', 'in:admin,staff'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama lengkap',
            'username' => 'Nama pengguna',
            'role' => 'Peran',
        ];
    }
}

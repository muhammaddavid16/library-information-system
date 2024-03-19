<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'username' => ['required', 'max:100', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama lengkap',
            'username' => 'Nama pengguna',
        ];
    }
}

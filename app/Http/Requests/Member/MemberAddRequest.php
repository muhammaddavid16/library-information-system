<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'nis' => ['required', 'max:100', 'unique:members,nis'],
            'name' => ['required', 'max:100'],
            'class' => ['required', 'max:100'],
            'phone_number' => ['nullable', 'max:100'],
            'address' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nis' => 'NIS',
            'name' => 'Nama lengkap',
            'class' => 'Kelas',
            'phone_number' => 'Nomor telepon',
            'address' => 'Alamat',
        ];
    }
}

<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $member = $this->route('member');
        $unique = $this->input('nis') !== $member->nis ? 'unique:users,nis' : '';

        return [
            'nis' => ['required', 'max:100', $unique],
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

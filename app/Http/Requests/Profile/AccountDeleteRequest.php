<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AccountDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'old_password' => ['required', 'max:100', 'current_password'],
        ];
    }

    public function attributes(): array
    {
        return [
            'old_password' => 'Kata sandi',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();

        throw ValidationException::withMessages(['error' => $errors['old_password'][0]]);
    }
}

<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class FineSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('access-admin');
    }

    public function rules(): array
    {
        return [
            'is_active' => ['nullable', 'boolean'],
            'fine_rate' => ['required', 'numeric'],
        ];
    }

    public function attributes(): array
    {
        return [
            'is_active' => 'Aktivasi',
            'fine_rate' => 'Tarif denda',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }
}

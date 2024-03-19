<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoanReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'month' => ['required', 'date_format:m/Y'],
        ];
    }

    public function attributes(): array
    {
        return [
            'month' => 'Bulan',
        ];
    }
}

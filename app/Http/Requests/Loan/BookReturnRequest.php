<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $loan = $this->route('loan');
        $max = "max:{$loan->loanTracking->getUnreturnedBook()}";

        return [
            'total_returned' => ['required', 'integer', 'min:1', $max],
        ];
    }

    public function attributes(): array
    {
        return [
            'total_returned' => 'Jumlah buku'
        ];
    }
}

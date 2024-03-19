<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookBorrowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'member_id' => ['required', 'exists:members,id'],
            'book_id' => ['required', 'exists:books,id'],
            'loan_date' => ['required'],
            'due_date' => ['required'],
            'total_borrowed' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'member_id' => 'Anggota',
            'book_id' => 'Buku',
            'loan_date' => 'Tanggal pinjam',
            'total_borrowed' => 'Jumlah buku',
        ];
    }
}

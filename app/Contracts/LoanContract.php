<?php

namespace App\Contracts;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface LoanContract
{
    public function getLoanById(string $id): Loan;
    public function getAllLoans(): Collection;
    public function getBorrowedLoans(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function getReturnedLoans(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createLoan(array $data): Loan;
    public function updateLoan(Loan $loan, array $data): Loan;
}

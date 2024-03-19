<?php

namespace App\Services;

use App\Contracts\BookContract;
use App\Contracts\LoanContract;
use App\Contracts\SettingContract;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LoanService implements LoanContract
{
    protected BookContract $bookService;
    protected SettingContract $settingService;

    public function __construct(BookContract $bookService, SettingContract $settingService)
    {
        $this->bookService = $bookService;
        $this->settingService = $settingService;
    }

    public function getLoanById(string $id): Loan
    {
        return Loan::findOrFail($id);
    }

    public function getAllLoans(): Collection
    {
        return Loan::all();
    }

    public function getBorrowedLoans(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $loans = Loan::latest()
            ->with(['member:id,name', 'book:id,title', 'loanTracking:loan_id,total_borrowed,total_returned'])
            ->filter($keyword)
            ->where('status', 'borrowed')
            ->paginate($perPage)
            ->withQueryString();

        return $loans;
    }

    public function getReturnedLoans(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $loans = Loan::latest()
            ->with(['member:id,name', 'book:id,title', 'loanTracking:loan_id,total_borrowed,total_returned'])
            ->filter($keyword)
            ->where('status', 'returned')
            ->paginate($perPage)
            ->withQueryString();

        return $loans;
    }

    public function createLoan(array $data): Loan
    {
        $loanDate = Carbon::parse($data['loan_date']);
        $dueDate = Carbon::parse($data['due_date']);

        $book = Book::query()->findOrFail($data['book_id']);
        $totalBorrowed = (int)$data['total_borrowed'];

        $this->bookService->validateBookQuantity($book, $totalBorrowed);

        return DB::transaction(function () use ($data, $loanDate, $dueDate, $book, $totalBorrowed) {
            $this->bookService->decrementBookQuantity($book, $totalBorrowed);

            $loan = Loan::create([
                'member_id' => $data['member_id'],
                'book_id' => $data['book_id'],
                'loan_date' => $loanDate->isoFormat('Y-MM-DD HH:mm:ss'),
                'due_date' => $dueDate->isoFormat('Y-MM-DD HH:mm:ss'),
            ]);

            $loan->loanTracking()->create([
                'loan_id' => $loan->id,
                'total_borrowed' => $totalBorrowed,
            ]);

            return $loan;
        });
    }

    public function updateLoan(Loan $loan, array $data): Loan
    {
        $fineSetting = $this->settingService->getFineSetting();
        $loanTracking = $loan->loanTracking;
        $totalReturned = (int)$data['total_returned'];

        $book = $this->bookService->getBookById($loan->book_id);

        return DB::transaction(function () use ($loan, $loanTracking, $book, $totalReturned, $fineSetting) {
            $this->bookService->incrementBookQuantity($book, $totalReturned);

            $loanTracking->increment('total_returned', $totalReturned);

            if ($loanTracking->getUnreturnedBook() === 0) {
                if ($fineSetting->is_active) {
                    $daysOverdue = max(0, $loan->due_date->diffInDays(now(), false));

                    if ($daysOverdue > 0) {
                        $fineAmount = $fineSetting->fine_rate * $daysOverdue;
                    }
                }

                $loan->update([
                    'return_date' => now()->toDateTimeString(),
                    'status' => 'returned',
                    'fine_amount' => $fineAmount ?? 0,
                ]);
            }

            return $loan;
        });
    }
}

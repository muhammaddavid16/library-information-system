<?php

namespace App\Http\Controllers;

use App\Contracts\BookContract;
use App\Contracts\LoanContract;
use App\Contracts\MemberContract;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    protected MemberContract $memberService;
    protected BookContract $bookService;
    protected LoanContract $loanService;

    public function __construct(
        MemberContract $memberService,
        BookContract $bookService,
        LoanContract $loanService
    ) {
        $this->memberService = $memberService;
        $this->bookService = $bookService;
        $this->loanService = $loanService;
    }

    public function index(): Response
    {
        $totalMembers = $this->memberService->getAllMembers()->count();
        $totalBooks = $this->bookService->getAllBooks()->count();
        $totalLoans = $this->loanService->getAllLoans()->where('status', 'borrowed')->count();
        $totalReturns = $this->loanService->getAllLoans()->where('status', 'returned')->count();

        return response()
            ->view('dashboard', [
                'title' => 'Beranda',
                'total_members' => $totalMembers,
                'total_books' => $totalBooks,
                'total_loans' => $totalLoans,
                'total_returns' => $totalReturns,
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Contracts\BookContract;
use App\Contracts\LoanContract;
use App\Contracts\MemberContract;
use App\Http\Requests\Loan\BookBorrowRequest;
use App\Http\Requests\Loan\BookReturnRequest;
use App\Models\Loan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LoanController extends Controller
{
    protected LoanContract $loanService;
    protected MemberContract $memberService;
    protected BookContract $bookService;

    public function __construct(
        LoanContract $loanService,
        MemberContract $memberService,
        BookContract $bookService,
    ) {
        $this->loanService = $loanService;
        $this->memberService = $memberService;
        $this->bookService = $bookService;
    }

    public function index(): Response
    {
        return response()->view('loans.index', [
            'title' => 'Peminjaman Buku',
            'loans' => $this->loanService->getBorrowedLoans(request('cari')),
        ]);
    }

    public function create(): Response
    {
        $members = $this->memberService->getSortedMembers('name');
        $books = $this->bookService->getSortedBooks('title');

        return response()->view('loans.create', [
            'title' => 'Tambah Peminjaman Buku',
            'members' => $members->toArray(),
            'books' => $books->toArray(),
        ]);
    }

    public function store(BookBorrowRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->loanService->createLoan($validated);

        return redirect()->route('loans')->with('success', 'Transaksi berhasil diproses.');
    }

    public function process(Loan $loan): Response
    {
        return response()->view('loans.process', [
            'title' => 'Proses Transaksi',
            'loan' => $loan,
        ]);
    }

    public function update(BookReturnRequest $request, Loan $loan): RedirectResponse
    {
        $validated = $request->validated();

        $this->loanService->updateLoan($loan, $validated);

        return redirect()->route('loans')->with('success', 'Transaksi berhasil diproses.');
    }

    public function history(): Response
    {
        return response()->view('loans.history', [
            'title' => 'Riwayat Peminjaman',
            'loans' => $this->loanService->getReturnedLoans(request('cari')),
        ]);
    }

    public function loanChart(): JsonResponse
    {
        $loans = Loan::all();

        $labels = [];
        $loanData = [];
        $returnData = [];

        for ($i = 5; $i >= 0; $i--) {
            $startDate = now()->subMonths($i)->startOfMonth();
            $endDate = now()->subMonths($i)->endOfMonth();

            $labels[] = $startDate->isoFormat('MMMM');
            $loanData[] = $loans->whereBetween('loan_date', [$startDate, $endDate])->count();
            $returnData[] = $loans->whereBetween('return_date', [$startDate, $endDate])->count();
        }

        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'peminjaman',
                    'data' => $loanData,
                ],
                [
                    'label' => 'pengembalian',
                    'data' => $returnData,
                ],
            ],
        ];

        return response()->json($data);
    }
}

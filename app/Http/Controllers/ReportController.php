<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loan\LoanReportRequest;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function loanReport(): Response
    {
        return response()->view('report.loan.index', [
            'title' => 'Laporan Peminjaman Buku',
        ]);
    }

    public function generateLoanReport(LoanReportRequest $request)
    {
        $validated = $request->validated();

        $date = Carbon::createFromFormat('m/Y', $validated['month']);

        $startDate = $date->copy()->startOfMonth();
        $endDate = $date->copy()->endOfMonth();

        $loans = Loan::with('member', 'book', 'loanTracking')->where('status', 'borrowed')->get()->whereBetween('loan_date', [$startDate, $endDate]);

        return response()->view('report.loan.report', [
            'title' => "Laporan Peminjaman Buku",
            'month' => $date->isoFormat('MMMM Y'),
            'loans' => $loans,
        ]);
    }

    public function returnReport(): Response
    {
        return response()->view('report.return.index', [
            'title' => 'Laporan Pengembalian Buku',
        ]);
    }

    public function generateReturnReport(LoanReportRequest $request)
    {
        $validated = $request->validated();

        $date = Carbon::createFromFormat('m/Y', $validated['month']);

        $startDate = $date->copy()->startOfMonth();
        $endDate = $date->copy()->endOfMonth();

        $loans = Loan::with('member', 'book', 'loanTracking')->where('status', 'returned')->get()->whereBetween('loan_date', [$startDate, $endDate]);

        return response()->view('report.return.report', [
            'title' => "Laporan Pengembalian Buku",
            'month' => $date->isoFormat('MMMM Y'),
            'loans' => $loans,
        ]);
    }
}

<?php

namespace App\Contracts;

use App\Models\LoanTracking;

interface LoanTrackingContract
{
    public function createLoanTracking(array $data): LoanTracking;
}

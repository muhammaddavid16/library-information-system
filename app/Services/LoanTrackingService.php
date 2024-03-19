<?php

namespace App\Services;

use App\Contracts\LoanTrackingContract;
use App\Models\LoanTracking;

class LoanTrackingService implements LoanTrackingContract
{
    public function createLoanTracking(array $data): LoanTracking
    {
        return LoanTracking::create($data);
    }
}

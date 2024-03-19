<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanTracking extends Model
{
    use HasUuids;

    protected $table = 'loan_trackings';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'loan_id',
        'total_borrowed',
        'total_returned',
    ];

    protected $casts = [
        'total_borrowed' => 'integer',
        'total_returned' => 'integer',
    ];

    public function getUnreturnedBook(): int
    {
        return $this->total_borrowed - $this->total_returned;
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
}

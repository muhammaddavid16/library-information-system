<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasUuids;

    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'member_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status',
        'fine_amount',
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
        'fine_amount' => 'integer',
    ];

    public function getFine(): string
    {
        $fineSetting = FineSetting::firstOrFail();
        $daysOverdue = max(0, $this->due_date->diffInDays(now(), false));
        $fineAmount = number_format($fineSetting->fine_rate * $daysOverdue, 2, ',', '.');

        return "Rp. $fineAmount";
    }

    public function scopeFilter(Builder $query, ?string $keyword): void
    {
        $query->when(isset($keyword), function () use ($query, $keyword) {
            $query->whereHas('member', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })->orWhereHas('book', function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            });
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function loanTracking(): HasOne
    {
        return $this->hasOne(LoanTracking::class, 'loan_id', 'id');
    }
}

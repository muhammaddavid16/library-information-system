<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nis',
        'name',
        'class',
        'phone_number',
        'address',
    ];

    public function scopeFilter(Builder $query, ?string $keyword): void
    {
        $query->when(isset($keyword), function () use ($query, $keyword) {
            $query->where('nis', 'like', "%$keyword%")->orWhere('name', 'like', "%$keyword%");
        });
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'member_id', 'id');
    }
}

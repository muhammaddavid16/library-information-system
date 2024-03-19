<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bookshelf extends Model
{
    use HasUuids;

    protected $table = 'bookshelves';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description'
    ];

    public function scopeFilter(Builder $query, ?string $keyword): void
    {
        $query->when(isset($keyword), function () use ($query, $keyword) {
            $query->where('name', 'like', "%$keyword%");
        });
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'bookshelf_id', 'id');
    }
}

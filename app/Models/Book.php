<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasUuids;

    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'bookshelf_id',
        'isbn',
        'title',
        'publisher',
        'publication_year',
        'quantity',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'quantity' => 'integer',
    ];

    public function scopeFilter(Builder $query, ?string $keyword): void
    {
        $query->when(isset($keyword), function () use ($query, $keyword) {
            $query->where('isbn', 'like', "%$keyword%")->orWhere('title', 'like', "%$keyword%");
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function bookshelf(): BelongsTo
    {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id', 'id');
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'book_id', 'id');
    }
}

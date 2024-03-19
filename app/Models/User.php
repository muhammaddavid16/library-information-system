<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function scopeFilter(Builder $query, ?string $keyword): void
    {
        $query->when(isset($keyword), function () use ($query, $keyword) {
            $query->where('name', 'like', "%$keyword%")->orWhere('username', 'like', "%$keyword%");
        });
    }

    public function isAdministrator(): bool
    {
        return $this->role === 'admin';
    }
}

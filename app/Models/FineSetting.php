<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FineSetting extends Model
{
    use HasUuids;

    protected $table = 'fine_settings';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'is_active',
        'fine_rate',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'fine_rate' => 'integer',
    ];
}

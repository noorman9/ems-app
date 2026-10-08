<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'location',
        'status',
        'purchase_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'date',
        ];
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
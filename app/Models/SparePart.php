<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SparePart extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category',
        'stock',
        'unit',
        'minimum_stock',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'decimal:2',
            'minimum_stock' => 'decimal:2',
        ];
    }
    public function maintenances(): BelongsToMany
    {
        return $this->belongsToMany(Maintenance::class, 'maintenance_parts')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
}

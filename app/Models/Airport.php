<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airport extends Model
{
    use HasFactory;
    
    protected $appends = [
        'city'
    ];

    protected $hidden = [
        'id',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the city that owns the Airport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getCityAttribute() {
        return $this->city()->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'country_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $appends = [
        'country'
    ];

    /**
     * Get the country that owns the Airport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getCountryAttribute() {
        return $this->country()->first();
    }
}

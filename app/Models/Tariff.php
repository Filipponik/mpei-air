<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tariff extends Model
{
    use HasFactory;

    protected $appends = [
        'airline',
        'class',
    ];

    protected $hidden = [
        'id',
        'airline_id',
        'class_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the class that owns the Tariff
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassType::class, 'class_type_id', 'id');
    }

    /**
     * Get the airline that owns the Tariff
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }

    public function getClassAttribute() {
        return $this->class()->first()->name;
    }
    public function getAirlineAttribute() {
        return $this->airline()->first()->name;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plane extends Model
{
    use HasFactory;  

    protected $appends = [
        'plane_model',
    ];

    /**
     * Get the plane that owns the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plane_model(): BelongsTo
    {
        return $this->belongsTo(PlaneModel::class, 'plane_model_id', 'id');
    }
    
    public function getPlaneModelAttribute() {
        return $this->plane_model()->first();
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }
    
    public function getAirlineAttribute() {
        return $this->airline()->first();
    }
    
}

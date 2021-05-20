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
        'cols_econom',
        'seats_econom',
        'cols_business',
        'seats_business',
        'cols_first',
        'seats_first',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'airline_id',
        'plane_model_id',
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
        return $this->plane_model()->first()->name;
    }


    public function getColsEconomAttribute() {
        return $this->plane_model()->first()->cols_econom;
    }
    public function getColsBusinessAttribute() {
        return $this->plane_model()->first()->cols_business;
    }
    public function getColsFirstAttribute() {
        return $this->plane_model()->first()->cols_first;
    }

    public function getSeatsEconomAttribute() {
        return $this->plane_model()->first()->seats_econom;
    }
    public function getSeatsBusinessAttribute() {
        return $this->plane_model()->first()->seats_business;
    }
    public function getSeatsFirstAttribute() {
        return $this->plane_model()->first()->seats_first;
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }
    
    public function getAirlineAttribute() {
        return $this->airline()->first();
    }
    
}

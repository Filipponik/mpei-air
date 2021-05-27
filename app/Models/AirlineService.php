<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AirlineService extends Model
{
    use HasFactory;
    protected $appends = [
        'name',
    ];

    public function scopeByAirline($query, $code) {
        if (($air = Airline::where('code', $code)->first())) {
            $air_id = $air->id;
            $query->where('airline_id', $air_id);
        }
        return $query;
    }

    
    public function airline() {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }

    public function service() : BelongsTo {
        return $this->belongsTo(Service::class);
    }

    public function getNameAttribute() {
        return $this->service()->first()->name;
    }
}

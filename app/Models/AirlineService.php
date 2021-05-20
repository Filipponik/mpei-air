<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineService extends Model
{
    use HasFactory;

    public function scopeByAirline($query, $code) {
        $air_id = Airline::where('code', $code)->first()->id;
        $query->where('airline_id', $air_id);
        return $query;
    }

    
    public function airline() {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }
    public function service() {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}

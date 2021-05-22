<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;
    
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function airline_services(): HasMany
    {
        return $this->hasMany(AirlineService::class);
    }
}

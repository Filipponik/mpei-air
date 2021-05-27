<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTicket extends Model
{
    use HasFactory;

    protected $appends = [
        'name',
        'cost'
    ];
    

    /**
     * Get the user that owns the ServiceTicket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function airline_service(): BelongsTo
    {
        return $this->belongsTo(AirlineService::class, 'airline_service_id');
    }

    public function getNameAttribute() {
        return $this->airline_service()->first()->name;
    }
    public function getCostAttribute() {
        return $this->airline_service()->first()->cost;
    }
}

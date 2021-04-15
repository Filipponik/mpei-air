<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;
    
    protected $appends = [
        'status',
        'airport_from',
        'airport_to',
    ];

    protected $hidden = [
        'id',
        'airport_from_id',
        'airport_to_id',
        'flight_status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    /**
     * Get the airport_from that owns the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function airport_from(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_from_id', 'id');
    }

    /**
     * Get the airport_to that owns the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function airport_to(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_to_id', 'id');
    }
    
    /**
     * Get the status that owns the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(FlightStatus::class, 'flight_status_id', 'id');
    }

    public function getAirportFromAttribute() {
        return $this->airport_from()->first();
    }
    public function getAirportToAttribute() {
        return $this->airport_to()->first();
    }
    public function getStatusAttribute() {
        return $this->status()->first()->name;
    }
}

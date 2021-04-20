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

    protected $enabledForSearch = [
        'query' => [
            'type' => 'query'
        ],
        'code' => [
            'type' => 'default'
        ],
        'airport_from' => [
            'type' => 'join'
        ],
        'airport_to' => [
            'type' => 'join'
        ],
        'city_from' => [
            'type' => 'join'
        ],
        'city_to' => [
            'type' => 'join'
        ],
        'date_from' => [
            'type' => 'default'
        ],
        'date_to' => [
            'type' => 'default'
        ],
    ];

    public function scopeCustomSearch($query, $customQuery) {
        $query->select('flights.*');
        foreach ($customQuery as $key => $value) {
            if (!in_array($key, array_keys($this->enabledForSearch)) || !$value || $value === '')
                continue;

            if ($this->enabledForSearch[$key]['type'] == 'join' && $value && $value !== '') {
                $query->join('airports as airport_from', 'flights.airport_from_id', '=', 'airport_from.id');
                $query->join('airports as airport_to', 'flights.airport_to_id', '=', 'airport_to.id');
                break;
            }
        }
        foreach ($customQuery as $key => $value) {
            if (!in_array($key, array_keys($this->enabledForSearch)) || !$value || $value === '')
                continue;

            if ($this->enabledForSearch[$key]['type'] == 'default') {
                $key = ($key == 'code') ? 'flights.code' : $key;
                $query->where($key, $value);
            }
            else if ($this->enabledForSearch[$key]['type'] == 'join') {
                if ($key == 'airport_from' || $key == 'airport_to') {
                    $query->where($key.'.code', $value)
                            ->orWhere($key.'.name', $value);
                }
                else if ($key == 'city_from') {
                    $query->join('cities as city_from', 'airport_from.city_id', '=', 'city_from.id');
                    $query->where('city_from.name', $value);
                }
                else if ($key == 'city_to') {
                    $query->join('cities as city_to', 'airport_to.city_id', '=', 'city_to.id');
                    $query->where('city_to.name', $value);
                }
            }
        }
        return $query;
        
    }
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;
    
    protected $appends = [
        'status',
        'airport_from',
        'airport_to',
        'airline'
    ];

    protected $hidden = [
        'id',
        'airport_from_id',
        'airport_to_id',
        'airline_id',
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
            'type' => 'date'
        ],
        'date_to' => [
            'type' => 'date'
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

            switch ($this->enabledForSearch[$key]['type']) {
                case 'default':
                    $key = ($key == 'code') ? 'flights.code' : $key;
                    $query->where($key, $value);
                    break;
                
                case 'join':
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
                    break;
                
                case 'date':
                    $date = [
                        (new Carbon($value))->addHours(3)->toDateTimeString(),
                        (new Carbon($value))->addHours(27)->toDateTimeString()
                    ];
                    
                    $query->where($key, '>', $date[0])
                        ->where($key, '<', $date[1]);

                    break;
                
                default:
                    break;
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
     * Get the airline that owns the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
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
    public function getAirlineAttribute() {
        return $this->airline()->first();
    }
    public function getStatusAttribute() {
        return $this->status()->first()->name;
    }
}

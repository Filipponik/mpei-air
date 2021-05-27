<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $appends = [
        'services',
        'person'
    ];

    public function get_anon_data() {
        return [
            'row' => $this->row,
            'col' => $this->col,
            'class' => $this->class,
        ];
    }

    /**
     * Get all of the service_tickets for the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_tickets(): HasMany
    {
        return $this->hasMany(ServiceTicket::class);
    }

    /**
     * Get the person that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function getServicesAttribute() {
        return $this->service_tickets()->get();
    }
    public function getPersonAttribute() {
        return $this->person()->first();
    }
}

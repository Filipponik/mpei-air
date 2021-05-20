<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $appends = [
        'type'
    ];

    protected $hidden = [
        'id',
        'service_type_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the service_types that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'id');
    }

    public function getTypeAttribute() {
        return $this->type()->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaneModel extends Model
{
    use HasFactory;
    
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

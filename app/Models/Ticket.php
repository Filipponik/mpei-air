<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function get_anon_data() {
        return [
            'row' => $this->row,
            'col' => $this->col,
            'class' => $this->class,
        ];
    }
}

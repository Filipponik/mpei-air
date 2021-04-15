<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flights() {
        $flights = Flight::all();
        return response()->json($flights, 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flights(Request $req) {
        $query = $req->query();
        if (empty($query) || !$query) {
            $flights = Flight::paginate(1);
        }
        else {
            $flights = Flight::customSearch($query)->paginate(1);
        }
        
        return response()->json($flights, 200);
    }
}

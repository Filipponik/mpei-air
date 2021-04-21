<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flights(Request $req) {
        $query = $req->query();
        $countOnPage = 10;
        if (empty($query) || !$query) {
            $flights = Flight::paginate($countOnPage);
        }
        else {
            $flights = Flight::customSearch($query)->paginate($countOnPage);
        }
        
        return response()->json($flights, 200);
    }
}

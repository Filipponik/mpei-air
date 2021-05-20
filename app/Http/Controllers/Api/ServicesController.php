<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AirlineService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function servicesByCode(Request $req, string $code) {
        $output = [];
        $services = AirlineService::byAirline($code)->get();
        foreach ($services as $service) {
            $output[] = [
                'id' => $service->id,
                'name' => $service->service()->first()->name,
                'cost' => $service->cost,
            ];
        }
        return response()->json($output, 200);
    }
}

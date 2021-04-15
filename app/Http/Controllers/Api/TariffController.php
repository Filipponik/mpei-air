<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function tariffs()
    {
        $tariffs = Tariff::all();
        return response()->json($tariffs, 200);
    }
}

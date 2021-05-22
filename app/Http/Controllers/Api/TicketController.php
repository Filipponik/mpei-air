<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    protected function check_input(Request $req) {
        // TODO Проверить корректность цены
        $req->validate([
            'flight_code' => [
                'required',
                'string'
            ],
            'passenger' => [
                'required',
            ],
            'passengerType' => [
                'required',
                'string',
                Rule::in(['me', 'another']),
            ],
            'type_class' => [
                'required',
                'string',
                Rule::in(['econom', 'business', 'first']),
            ],
            'selected_seat' => [
                'required',
                'array',
            ],
            'optional_services' => [
                'required',
                'array',
            ],
            'cost' => [
                'required',
                'numeric',
            ],
        ]);
        return true;
    }

    public function buyTicket(Request $req) {
        $params = $req->input();
        if ($this->check_input($req) === true) {
            return response()->json($params, 200);
        }
        return response()->json(['code' => 'incorrect input'], 403);
    }
}

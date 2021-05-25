<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    protected function check_input(Request $req) {
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
            'cost' => [
                'required',
                'numeric',
            ],
        ]);
        $params = $req->input();
        $flight = Flight::firstWhere('code', $params['flight_code']);
        if (!$flight)
            return 'Flight was not found by code '.$params['flight_code'];
        
        $is_free_seat = Ticket::where('flight_id', $flight->id)
                    ->where('col', $params['selected_seat']['col'])
                    ->where('row', $params['selected_seat']['row'])
                    ->where('class', $params['type_class'])->first();
        if ($is_free_seat)
            return 'Selected seat is reserved';
        $services_cost = 0;
        if (count($params['optional_services']) > 0) {
            $selected_services = $flight->plane()->first()->airline()->first()->airline_services()->get()->toArray();
            foreach ($params['optional_services'] as $param) {
                foreach ($selected_services as $service) {
                    if ($service['id'] == $param['id']) {
                        $services_cost += $service['cost'];
                        break;
                    }
                }
            }
        }
        $seat_cost = (float)($flight->plane()->first()['cost_' .  $params['type_class']]);

        $expected_cost = $seat_cost + $services_cost;
        if ((float)($params['cost']) != $expected_cost)
            return 'Cost is not correct';

        return true;
    }

    public function buyTicket(Request $req) {
        $params = $req->input();
        $check_results = $this->check_input($req);
        if ($check_results !== true) {
            return response()->json(['code' => $check_results], 400);
        }

        // TODO Покупка билета ( регистрация в базе данных )

        
        // TODO Отправка корректного ответа
        return response()->json($params, 200);
    }
}

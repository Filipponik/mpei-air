<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function buyHistory (Request $req) {
        return response()->json($req->user()->orders()->get(),200);//->get()->tickets, 200);
    }
}

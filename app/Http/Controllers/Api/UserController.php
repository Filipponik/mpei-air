<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function buyHistory (Request $req) {
        $countOnPage = 10;
        return response()->json($req->user()->orders()->paginate($countOnPage), 200);
    }
}

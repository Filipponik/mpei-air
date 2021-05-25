<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function addFeedback(Request $req) {
        $req->validate([
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email'
            ],
            'message' => [
                'required',
                'string'
            ],
        ]);
        
        $feedback = new Feedback();
        $feedback->name = $req->input('name');
        $feedback->email = $req->input('email');
        $feedback->message = $req->input('message');
        
        try {
            $feedback = new Feedback();
            $feedback->name = $req->input('name');
            $feedback->email = $req->input('email');
            $feedback->message = $req->input('message');
            $feedback->save();
            return response()->json(['code' => 'Success'], 201);
        } catch (\Throwable $th) {
            return response()->json(['code' => 'Failed'], 400);
        }
    }

    public function listFeedback(Request $req) {
        if ($req->user()->role !== 'admin')
            abort(404);
            
        $query = $req->query();
        $countOnPage = 10;
        if (empty($query) || !$query) {
            $flights = Feedback::paginate($countOnPage);
        }

        return response()->json($flights, 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Validation\Rule;

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
            abort(403, 'You are not authorized to see this page');
            
        $query = $req->query();
        $countOnPage = 10;
        $feedback_list = Feedback::status($query['status'])->orderBy('created_at', 'desc');
        // if (empty($query) || !$query) {
        $feedback_list = $feedback_list->paginate($countOnPage);
        // }

        return response()->json($feedback_list, 200);
    }

    public function update(Request $req)
    {
        $req->validate([
            'id' => [
                'required',
                'numeric'
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['new', 'inprogress', 'closed'])
            ],
        ]);
        if ($req->user()->role !== 'admin')
            abort(403, 'You are not authorized to see this page');
        
        $feedback = Feedback::find($req->input('id'));
        $feedback->status = $req->input('status');
        $feedback->save();

        return response()->json($feedback, 201);
    }
}

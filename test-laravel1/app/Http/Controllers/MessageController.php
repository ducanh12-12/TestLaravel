<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;

class MessageController extends Controller
{
    public function index (Request $request) {
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;
        $message = Messages::where(['senderId'=>$senderId,'receiverId'=>$receiverId])->orWhere(['receiverId'=>$senderId, 'senderId'=>$receiverId])->get();
        return response()->json([
            'status'=> 'success',
            'messages'=> $message
        ]);
    } 
    public function store(Request $request) {
        $request->validate([
            'senderId' => 'required|integer',
            'receiverId' => 'required|integer',
            'name' => 'required|string',
            'messages' => 'required|string',
        ]);

        $messages = Messages::create([
            'senderId' => $request->senderId,
            'receiverId' => $request->receiverId,
            'name' => $request->name,
            'messages' => $request->messages,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Coaches created successfully',
            'messages' => $messages,
        ]);
    }
}

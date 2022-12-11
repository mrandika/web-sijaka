<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageReceived;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function handler(Request $request)
    {
        $topic = $request->topic;
        $data = $request->data;

        $message = Message::updateOrCreate(
            ['topic' => $topic],
            ['topic' => $topic, 'message' => $data]
        );

        event(new MessageReceived());

        return response()->json([
            'code' => 200,
            'message' => 'Received',
            'data' => $message
        ]);
    }
}

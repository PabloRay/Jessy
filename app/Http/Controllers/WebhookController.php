<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function GetMessage(Request $request)
    {
        $hand = new HandleMessageController;
        $gram = new TelegramController;
        $request = json_decode($request->getContent());

        $gram->sendMessage($request->message->chat->id, $request->message->text);
        $hand->MainHandle($request->message->text);
    }
}

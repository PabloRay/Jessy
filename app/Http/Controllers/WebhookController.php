<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    static protected $chat_id = "1475337310";

    public function GetMessage(Request $request)
    {
        $hand = new HandleMessageController;
        $gram = new TelegramController;
        $request = json_decode($request->getContent());

        if($request->message->chat->id==self::$chat_id)
        {
            $hand->MainHandle($request->message->text);
        }
        else{
            $gram->sendMessage($request->message->chat->id, "Lo siento no estas autorizado");
        }
    }
}

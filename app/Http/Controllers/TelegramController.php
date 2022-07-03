<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TelegramController extends Controller
{
    // public function GetUpdate()
    // {
    //     $apiToken = "5540928888:AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI";
    //     $data = [
    //         'chat_id' => '1475337310',
    //         'text' => 'Hello from PHP!'
    //     ];
    //     $response = Http::post(sprintf('https://api.telegram.org/bot%s/sendMessage?',$apiToken),$data); 
    // }

    function sendMessage($chat_id, $text)
    {
        $apiToken = '5540928888:AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI';
        
        $json = ['chat_id'       => $chat_id,
                'text'          => $text,
                'parse_mode'    => 'HTML'];
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
        http_build_query($json) );
    }

}

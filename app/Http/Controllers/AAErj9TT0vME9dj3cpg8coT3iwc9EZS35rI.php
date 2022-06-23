<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI extends Controller
{
    public function GetUpdate()
    {
        /* $response = Http::get('https://google.com');
        $response = $response->body(); */
        //$request = json_decode($request);
        $apiToken = "5540928888:AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI";
        $data = [
            'chat_id' => '1475337310',
            'text' => 'Hello from PHP!'
        ];
        $response = Http::post(sprintf('https://api.telegram.org/bot%s/sendMessage?',$apiToken),$data); 
    }
}

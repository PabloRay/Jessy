<?php

namespace App\Http\Controllers;

$apiToken = getenv('BOT_TOKEN');
$chatId = getenv('CHAT_ID');
$request = file_get_contents("php://input");
$request = json_decode($request);

sendMessage($request->message->chat->id, $request->message->text);

function sendMessage($chat_id, $text)
  {
    $json = ['chat_id'       => $chat_id,
            'text'          => $text,
            'parse_mode'    => 'HTML'];
    file_get_contents(sprintf("https://api.telegram.org/bot%s/sendMessage?",getenv('BOT_TOKEN')) .
    http_build_query($json) );
}
?>
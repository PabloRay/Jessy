<?php
  $apiToken = "5540928888:AAErj9TT0vME9dj3cpg8coT3iwc9EZS35rI";
  $data = [
      'chat_id' => '1475337310',
      'text' => 'Hello from PHP!'
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );
                                 

  
?>
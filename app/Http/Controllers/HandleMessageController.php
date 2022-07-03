<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandleMessageController extends Controller
{
    public function MainHandle($text)
    {
        $exp = new ExpenseController;
        $log = new LogController;
        $telegram = new TelegramController;
        $partes = explode("|",$text);
        $type = strtolower(trim($partes[0]));
        $chat_id = "1475337310";

        switch($type)
        {
            case "comandos":
                $message = "gasto\n" . "gastos all\n" . "pagar gasto\n" . "gastos -h\n";
                $telegram->sendMessage($chat_id,$message);
                break;

            case "gasto":
                $parts = explode(",",$partes[1]);
                $exp->SaveExpense(trim($parts[0]),trim($parts[1]),trim($parts[2]));
                $log->SaveMessage($type,$text);
                $telegram->sendMessage($chat_id,"Gasto registrado!");
                break;

            case "gastos all":
                $exp->ShowAllExpenses();
                break;

            case "pagar gasto":
                $exp->UpdateExpense($partes[1]);
                $telegram->sendMessage($chat_id,"Gasto actualizado!");
                break;

            case "gastos -h":
                $message = "gasto | descripcion, cantidad, status\n" . "gastos all\n" . "pagar gasto | id\n";
                $telegram->sendMessage($chat_id,$message);
                break;
        }
    }
}

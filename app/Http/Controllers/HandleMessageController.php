<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class HandleMessageController extends Controller
{
    public function MainHandle($text)
    {
        $exp = new ExpenseController;
        $log = new LogController;
        $telegram = new TelegramController;
        $rem = new ReminderController;
        $mlb = new WebScrapingController;
        $partes = explode("|",$text);
        $type = strtolower(trim($partes[0]));
        $chat_id = "1475337310";

        switch($type)
        {
            case "comandos":
                $message = "1. gasto\n" . "2. gastos all\n" . "3. pagar gasto\n" . "4. gastos -h\n";
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
                $message = "1. gasto | descripcion, cantidad, status\n" . "2. gastos all\n" . "3. pagar gasto | id\n";
                $telegram->sendMessage($chat_id,$message);
                break;

            case "reminder":
                $parts = explode(",",$partes[1]);
                $rem->SetReminder($parts[0],$parts[1]);
                $log->SaveMessage($type,$text);
                break;
            
            case "juegos jugados":
                $message = $mlb->GetOldMatches();
                if(!empty($message))
                {
                    $telegram->sendMessage($chat_id,$message);
                }
                else{
                    $telegram->sendMessage($chat_id,"No hay juegos terminados aun");
                }
                break;

            case "juegos actuales":
                $message = $mlb->GetCurrentMatches();
                if(!empty($message))
                {
                    $telegram->sendMessage($chat_id,$message);
                }
                else{
                    $telegram->sendMessage($chat_id,"No hay juegos en este momento");
                }
                break;
        }
    }

}

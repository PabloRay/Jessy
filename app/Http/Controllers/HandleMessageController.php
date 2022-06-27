<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandleMessageController extends Controller
{
    public function MainHandle($text)
    {
        $exp = new ExpenseController;
        $log = new LogController;
        $partes = explode("-",$text);
        $type = strtolower(trim($partes[0]));

        switch($type)
        {
            case "gasto":
                $parts = explode(",",$partes[1]);
                $exp->SaveExpense(trim($parts[0]),trim($parts[1]),trim($parts[2]));
                $log($type,$text);
                break;
        }
    }
}

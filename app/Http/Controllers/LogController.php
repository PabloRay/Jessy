<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function GetLogs()
    {
        return Log::all();
    }


    public function SaveMessage($mensaje)
    {
        $log = new Log;
        $log->text = $mensaje;
        $log->save();
    }
}

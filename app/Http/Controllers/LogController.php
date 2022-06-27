<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function GetLogs()
    {
        return Log::all();
    }

    public function SaveMessage($type,$mensaje)
    {
        $log = new Log;
        $log->type = $type;
        $log->text = $mensaje;
        $log->save();
    }
}

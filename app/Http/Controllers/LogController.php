<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function store(Log $newLog)
    {
        $log = $newLog;
        $log->save();
    }

    public function GetLogs()
    {
        return Log::all();
    }

    public function destroy(log $log)
    {
        //
    }

    public function test(Request $request)
    {
        $log = new Log;
        $log->text = $request->mensaje;
        $log->save();
        return view('index');
    }
}

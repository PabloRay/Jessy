<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class BirthdayController extends Controller
{
    public function SendBirthDayMessage()
    {
        $birth = DB::table('birthday')->where('check','0')->get();
        $mytime = Carbon::now();
        $date = new DateTime($mytime);
        $fecha = date_format($date,'d/m/Y');
        $telegram = new TelegramController;

        if($fecha==$birth->date)
        {
            $telegram->sendMessage($birth->chat_id,sprintf("Felicidades! %s",$birth->person));
            DB::table('birthday')->where('chat_id',$birth->chat_id)->update(['check'=>'1']);
        }
    }
}

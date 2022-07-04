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
        $births = DB::table('birthdays')->where('check','0')->get();
        $mytime = Carbon::now();
        $date = new DateTime($mytime);
        $fecha = date_format($date,'d/m/Y');
        $telegram = new TelegramController;

        foreach($births as $birth)
        {
            
            if($fecha==$birth->date)
            {
                $telegram->sendMessage(trim($birth->chat_id),sprintf("Felicidades! %s",$birth->person));
                DB::table('birthdays')->where('chat_id',$birth->chat_id)->update(['check'=>'1']);
            }
        }
        
    }
}

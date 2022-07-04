<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{

    static protected $chat_id = "1475337310";

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

    public function SetReminder($text,$time)
    {
        
        $reminder = new Reminder;
        $reminder->text = $text;
        $reminder->date = $time;
        $reminder->save();
    }

    public function DoReminder()
    {
        $reminders = DB::table('reminders')->where('check','0')->get();
        $mytime = Carbon::now();
        $date = new DateTime($mytime);
        $fecha = date_format($date,'d/m/Y H:i');
        $telegram = new TelegramController;

        foreach($reminders as $reminder)
        {
            if($fecha==$reminder->date)
            {
                $telegram->sendMessage(self::$chat_id,sprintf("Oye recuerda que...%s",$reminder->text));
            }
        }
    }
}

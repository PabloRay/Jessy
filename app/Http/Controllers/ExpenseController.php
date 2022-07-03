<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    static protected $chat_id = "1475337310";

    public function SaveExpense($desc,$amount,$status)
    {
        $exp = new Expense;
        $exp->description = $desc;
        $exp->amount = $amount;
        $exp->status = $status;
        $exp->save();
    }

    public function ShowAllExpenses()
    {
        $expenses = Expense::all();
        $gram = new TelegramController;
        $message = "";

        foreach($expenses as $expense)
        {
            $date = date("d/m/Y",strtotime($expense['created_at']));
            $message .= sprintf("Id: %s\n Descripcion: %s\n costo: $%s\n status: %s\n dia de registro: %s\n_________________________________________\n",
                    $expense['id'],$expense['description'],$expense['amount'],$expense['status'],$date);
        }
        $gram->sendMessage(self::$chat_id,$message);
    }

    public function GetExpenseNotPayed()
    {
        $expenses = DB::table('expenses')->where('status','se debe')->get();
        $gram = new TelegramController;
        $message = "";

        foreach($expenses as $expense)
        {
            $message .= sprintf("Id: %s\nDescripcion: %s\nCantidad: $%s\n_________________________________________\n",
                        $expense->id,$expense->description,$expense->amount);
        }
        $gram->sendMessage(self::$chat_id,$message);
    }

    public function UpdateExpense($id)
    {
        DB::table('expenses')->where('id',$id)->update(['status'=> 'pagado']);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function SaveExpense($desc,$amount,$status)
    {
        $exp = new Expense;
        $exp->description = $desc;
        $exp->amount = $amount;
        $exp->status = $status;
        $exp->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = "expenses";
    //protected $hidden = ['id'];
    public $fillable = ["description","amount","status"];
}

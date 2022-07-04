<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = "reminders";
    //protected $hidden = ['id'];
    public $fillable = ["text","date"];
}
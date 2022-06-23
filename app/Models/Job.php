<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = "jobs";
    protected $hidden = ['id'];
    protected $fillable = ["nombre","times_used","frequency"];

    public function GetJobs()
    {
        return Job::all();
    }

    public function GetJobId($id)
    {
        return Job::find($id);
    }
}

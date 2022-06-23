<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    
    public function store(Request $request)
    {
        $job = new Job($request->all());
        $job->save();
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->fill($request->all());
        $job->save();
    }

    public function GetJobs()
    {
        return Job::all();
    }

    public function GetJobById($id)
    {
        return Job::find($id);
    }

    public function DeleteJob($id)
    {
        $job = Job::find($id);
        $job->delete();
        return response()->json([
            'message'=>'Success'
        ],204);
    }
}

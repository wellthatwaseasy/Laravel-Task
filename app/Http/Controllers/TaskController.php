<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //index
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index',['tasks' => $tasks]);
    }

    public function edit(Request $request)
    {
        //dd($request);
        $task = Task::findOrFail($request->id);
        return view('tasks.edit',['task' => $task]);
        //dd($task);
    }

    public function create()
    {
        # code...
    }
}

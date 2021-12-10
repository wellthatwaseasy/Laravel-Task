<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //index
    public function index()
    {
        $tasks = Task::all();
        //dd($tasks->whereIn('parent_id', 3));
        return view('tasks.index',['tasks' => $tasks]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        //dd($task->childs);
        $pagetitle = $task->name;
        return view('tasks.show',compact('task','pagetitle'));
    }


    /**
     * Show the form for Editing a resource.
     *
     * @return \Illuminate\Http\Response
     */    public function edit($id, Request $request)
    {
        //dd($id);
        $task = Task::findOrFail($id);
        $allusers = User::all();
        $alltasks = Task::all();
        $allpriorities = Priority::all();
        $pagetitle = $task->name;
        return view('tasks.edit',compact('task','allusers','alltasks','allpriorities','pagetitle'));
        //dd($task);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allusers = User::all();
        $task = new Task;
        $alltasks = Task::all();
        $allpriorities = Priority::all();
        $pagetitle = "Create a new Task";
        return view('tasks.create',compact('task','allusers','alltasks','allpriorities','pagetitle'));
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Task  $task
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Task $task)
//    {
//       $task['start'] = date("F j,Y", strtotime($task['start']));
//       $task['finish'] = date("F j,Y", strtotime($task['finish']));
//       $pagetitle = $task->name;
//       $teams = Teams::all();
//       $alltasks = Task::all();
//       $tasks=$task;
//       //dd($tasks);
//       return view('Tasks.edit',compact('tasks','teams','alltasks','pagetitle'));
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request());
        $valid = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'user_id' => 'required',
            'start' => 'required',
            'finish' => 'required',
            'parent_id' => 'not_in:foo,bar',
            'priorities_id' => 'not_in:foo,bar',
        ]);
        $valid['start'] = date("Y-m-d", strtotime($valid['start']));
        $valid['finish'] = date("Y-m-d", strtotime($valid['finish']));
        //dd($valid);
        $task = Task::create($valid);
        return redirect('tasks')->with('status','Successfully created ' . $task->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //dd($request);
        $valid = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'user_id' => 'required',
            'start' => 'required',
            'finish' => 'required',
            'parent_id' => 'not_in:foo,bar',
            'priorities_id' => 'not_in:foo,bar',
        ]);
        $valid['start'] = date("Y-m-d", strtotime($valid['start']));
        $valid['finish'] = date("Y-m-d", strtotime($valid['finish']));
        //dd('update', $valid);
        $task=Task::findOrFail($id);
        $task->update($valid);
        return redirect('tasks')->with('status','Successfully updated ' . $task->name);
    }

//    private $Dels = array();

//    private function killTask($id){
//       $task=Task::findOrFail($id);
//       $this->Dels[] = $task->name;
//       $task->delete();
//    }

//    private function killKids($iam){
//       $tasks = Task::all();
//       $this->killTask($iam);
//       foreach($tasks as $task){
//          if($task->parent == $iam && $task->id != $iam){
//             $this->killKids($task->id);
//          }
//       }
//    }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Task  $task
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
        dd('delete Task #',$id);
        $task=Task::findOrFail($id);
        //$this->killKids($id);
        return redirect('task')->with('status','Successfully deleted ' . implode(', ',$this->Dels));
        //dd($this->Dels);
   }
}

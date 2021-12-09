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

    public function edit($id, Request $request)
    {
        //dd($id);
        $task = Task::findOrFail($id);
        return view('tasks.edit',['task' => $task]);
        //dd($task);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //   $tasks = Task::all();
    //   $pagetitle = "Tasks";
    //   return view('Tasks.index',compact('tasks','pagetitle'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $tasks = Task::all();
        //dd($task->parents,$id);
        $pagetitle = $task->name;
        return view('Tasks.show',compact('task','tasks','pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltasks = Task::all();
        $tasks = new Task;
        $pagetitle = "Create a new Task";
        return view('Tasks.create',compact('tasks','teams','alltasks','pagetitle'));
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
        dd(request());
        $valid = $request->validate([
            'name' => 'required|max:190',
            'description' => 'required',
            'team_id' => 'required',
            'start' => 'required',
            'finish' => 'required',
            'parent' => 'not_in:foo,bar',
            'sibling' => 'not_in:foo,bar',
        ]);
        $valid['start'] = date("Y-m-d", strtotime($valid['start']));
        $valid['finish'] = date("Y-m-d", strtotime($valid['finish'])) . " 23:59:59";
        dd($valid);
        $task = Task::create($valid);
        return redirect('task')->with('status','Successfully created ' . $task->name);
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
        dd($request);
        $valid = $request->validate([
        'name' => 'required|max:190',
        'description' => 'required',
        'team_id' => 'required',
        'start' => 'required',
        'finish' => 'required',
        'parent' => 'not_in:foo,bar',
        'sibling' => 'not_in:foo,bar',
        ]);
        $valid['start'] = date("Y-m-d", strtotime($valid['start']));
        $valid['finish'] = date("Y-m-d", strtotime($valid['finish'])) . " 23:59:59";
        //dd($valid);
        $task=Task::findOrFail($id);
        $task->update($valid);
        return redirect('task')->with('status','Successfully updated ' . $task->name);
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
        dd($id);
        $task=Task::findOrFail($id);
        $this->killKids($id);
        return redirect('task')->with('status','Successfully deleted ' . implode(', ',$this->Dels));
        //dd($this->Dels);
   }
}

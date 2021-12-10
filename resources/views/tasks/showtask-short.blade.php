<div>
    <div class="bg-blue-100 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">
        <a href="{{ url( '/tasks/' . $task->id )}}" class="text-blue-900">{{$task->name}}</a>
    </div>
    <div class="flex">
        <div class="bg-blue-200 rounded-bl-xl p-1 w-4/12">Assigned to {{$task->user->name}}</div>
        <div class="bg-blue-200 p-1 w-4/12">Start {{ date("F d, Y", strtotime($task->start)) }}</div>
        <div class="bg-blue-200 rounded-br-xl p-1 w-4/12">Finish {{ date("F d, Y", strtotime($task->finish)) }}</div>
    </div>
    @if( $cnt )
       <div>
          @include('tasks.showchild',['iam' => $task->id, 'tasks' => $tasks, 'ul' => 0, 'vh' => 3])
       </div>
    @endif
</div>

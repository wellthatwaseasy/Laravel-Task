{{-- {{ dd($tasks) }} --}}
@if($ul++ == 0) {{-- first call to showchild --}}
    <div class="ml-8">
@endif

@foreach($tasks as $task)
    @if($task->parent_id == $iam && $task->id != $iam)
        <div class="mt-1" ondblclick="window.location.href='{{ url('/task', $task->id) }}'">
            <div class="bg-blue-100 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">
                <a href="{{ url( '/tasks/' . $task->id )}}" class="text-blue-900">{{$task->name}}</a>
            </div>
            <div class="flex">
                <div class="bg-blue-200 rounded-bl-xl p-1 w-4/12">Assigned to {{$task->user->name}}</div>
                <div class="bg-blue-200 p-1 w-4/12">Start {{ date("F d, Y", strtotime($task->start)) }}</div>
                <div class="bg-blue-200 rounded-br-xl p-1 w-4/12">Finish {{ date("F d, Y", strtotime($task->finish)) }}</div>
            </div>
            @if(count($tasks->whereIn('parent_id',$task->id)->all()))
                @include('tasks.showchild',['iam' => $task->id, 'tasks' => $tasks, 'ul' => 0, 'vh' => $vh-0.075])
            @endif
        </div>
    @endif
@endforeach
@if($ul != 0)
    </div>
<!-- #############################################    end Show child  ul={{$ul}}  ##############################################  -->
@endif

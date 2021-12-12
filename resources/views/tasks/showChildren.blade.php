{{-- {{ dd($tasks) }} --}}
@if($ul++ == 0) {{-- first call to showchild --}}
    <div class="ml-8">
@endif

@foreach($tasks as $task)
    @if($task->parent_id == $iam && $task->id != $iam)
        <div class="mt-1 text-{{theme('text')}}-900" ondblclick="window.location.href='{{ url('/task', $task->id) }}'">
            <div class="bg-{{theme('bg')}}-100 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">
                <a href="{{ url( '/tasks/' . $task->id )}}">{{$task->name}}</a>
            </div>
            <div class="flex bg-{{theme('bg')}}-200 text-{{theme('text')}}-900">
                <div class="rounded-bl-xl p-1 w-4/12">Assigned to {{$task->user->name}}</div>
                <div class="p-1 w-4/12">Start {{ date("F d, Y", strtotime($task->start)) }}</div>
                <div class="rounded-br-xl p-1 w-4/12">Finish {{ date("F d, Y", strtotime($task->finish)) }}</div>
            </div>
            @if(count($task->childIds()) )
                @include('tasks.showChildren',['iam' => $task->id, 'ul' => 0])
            @endif
        </div>
    @endif
@endforeach
@if($ul != 0)
    </div>
<!-- #############################################    end Show child  ul={{$ul}}  ##############################################  -->
@endif

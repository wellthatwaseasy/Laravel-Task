@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-{{theme('bg')}}-50 p-6 rounded-lg">
            @foreach($tasks as $task)
                @if($task->parent_id) @continue @endif
                <div class="m-1">
                    <div class="bg-{{theme('bg')}}-100 text-{{theme('text')}}-900 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">
                        <a href="{{ url( '/tasks/' . $task->id )}}">{{$task->name}}</a>
                    </div>
                    <div class="flex bg-{{theme('bg')}}-100 text-{{theme('text')}}-900">
                        <div class="rounded-bl-xl p-1 w-4/12">Assigned to {{$task->user->name}}</div>
                        <div class="p-1 w-4/12">Start {{ date("F d, Y", strtotime($task->start)) }}</div>
                        <div class="rounded-br-xl p-1 w-4/12">Finish {{ date("F d, Y", strtotime($task->finish)) }}</div>
                    </div>
                    @if(count($task->childIds()))
                       <div>
                          @include('tasks.showChildren',['iam' => $task->id, 'ul' => 0])
                       </div>
                    @endif
                </div>
            @endforeach
        @auth
            <div class="flex">
                    <a class="w-2/12 bg-{{theme('bg')}}-200 border-2 border-{{theme('border')}}-700 mt-4 rounded-lg text-center font-bold text-{{theme('text')}}-900"
                    href="{{ url('/tasks/create') }}">Create a New Task</a>
            </div>
        @endauth
        </div>
    </div>

@endsection

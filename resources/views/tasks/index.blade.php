@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @foreach($tasks as $task)
                @if($task->parent_id) @continue @endif
                <div class="m-1">
                    @include('tasks.showtask-short',['task'=> $task , 'cnt' => count($tasks->whereIn('parent_id', $task->id)->all()) , 'tasks'=>$tasks ])
                </div>
            @endforeach
        @auth
            <div class="flex">
                    <a class="w-2/12 bg-yellow-200 border-2 border-yellow-700 mt-4 rounded-lg text-center font-bold text-blue-900"
                    href="{{ url('/tasks/create') }}">Create a New Task</a>
            </div>
        @endauth
        </div>
    </div>

@endsection

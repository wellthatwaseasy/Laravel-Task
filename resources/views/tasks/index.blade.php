@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            {{ $tasks->count() }} tasks
            @foreach($tasks as $task)
                <div class="border-2 m-2">
                    @include('tasks.showtask-short',['task'=> $task ])
                </div>
            @endforeach
        </div>
    </div>
@endsection

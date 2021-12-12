{{-- {{ dd($task->parentOf()) }} --}}
@extends('layouts.app')

	@section('content')
    <div class="w-8/12 bg-{{theme('bg')}}-100 p-6 rounded-lg mx-auto">
        <div class="m-2 text-3xl font-bold text-{{theme('text')}}-900 ">{{ $task->name }}</div>
            <div class="ml-8 mb-4 text-{{theme('text')}}-900 ">
                <strong>Description:</strong>
                {{ $task->description}}<p>
                <strong>Parent Task:</strong>  {{ $task->parent_id ? $task->parent->name : "None"}}<br>
                <strong>Assigned to:</strong>  {{ $task->user->name}}<br>
                <strong>Priority:</strong>  {{$task->priorities->name}}<br>
            	<strong>Starting Date:</strong>  {{$task->start}}<br>
				<strong>Finish Date:</strong>  {{$task->finish}}<p>
			</div class="ml-4">
        <hr>
        <div class="flex">
                <a type="button" class="text-{{theme('text')}}-900 bg-{{theme('bg')}}-50 p-1 m-2 mb-0 border-4 border-{{theme('border')}}-500 rounded-lg "
                href="{{ url('/tasks') }}"'>Return to Tasks</a>
            @auth
                <a type="button" class="text-{{theme('text')}}-900 bg-{{theme('bg')}}-50 p-1 m-2 mb-0 border-4 border-{{theme('border')}}-500 rounded-lg "
                href="{{ url('/tasks/'. $task->id . '/edit') }}"'>EDIT the "{{ $task->name }}" task</a>
                <p>
                    <form action="{{url('/tasks/' . $task->id )}}"
                        class="mr-4" method="POST"
                        onsubmit ='return confirm("Are you sure you want to delete this task and all of the children?")'>
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="text-{{theme('error')}}-800 bg-{{theme('error')}}-50 p-1 m-2 mb-0 border-4 border-{{theme('error')}}-500 rounded-lg">
                            Delete the "{{$task->name}} " task</button>
                    </form>
                </p>
            @endauth
        </div>
    </div>
    @stop


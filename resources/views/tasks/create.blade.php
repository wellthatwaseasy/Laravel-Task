
@extends('layouts.app')

	@section('content')
        <div class="w-8/12 bg-{{theme('bg')}}-50 p-6 rounded-lg mx-auto">
            <form action="{{ url('/tasks',[$task->id]) }}" method="post" class="mb-4">
                @include('tasks.form',['SubmitButton'=>'Create Task'])
            </form>
        </div>
   @stop

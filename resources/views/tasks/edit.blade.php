
@extends('layouts.app')

	@section('content')
        <div class="w-8/12 bg-{{theme('bg')}}-50 p-6 rounded-lg mx-auto">
            <form action="{{ url('/tasks',[$task->id]) }}" method="post" class="mb-4">
                {{ method_field('PATCH') }}
                @include('tasks.form',['SubmitButton'=>'Update Task'])
            </form>
        </div>
   @stop

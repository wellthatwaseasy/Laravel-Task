
@extends('layouts.app')

	@section('content')
        <div class="w-8/12 bg-white p-6 rounded-lg mx-auto">
            <form action="{{ url('/tasks') }}" method="post" class="mb-4">
                @include('tasks.form',['SubmitButton'=>'Update Task'])
            </form>
        </div>
   @stop

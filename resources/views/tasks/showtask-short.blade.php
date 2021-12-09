<div>
    @if ($task->ownedBy(auth()->user()))
        <div class="bg-blue-100 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">
            <a href="{{ url( '/tasks/' . $task->id . '/edit')}}" class="text-green-500">{{$task->name}}</a>
            {{-- <form action=""class="mr-4">
                @csrf
                <button type="submit"</button>
            </form> --}}
        </div>
    @else
        <p class="bg-blue-100 text-xl font-bold rounded-t-xl p-2" title="{{$task->description}} ">{{$task->name}}</p>
    @endif
    <div class="bg-blue-200 rounded-b-xl p-1">Assigned to {{$task->user->name}}</div>
</div>

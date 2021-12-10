        @csrf
        <div class="mb-4">
            <label for="name" class="font-bold">Task Name</label>
            <input type="text" name="name" id="name" placeholder="Task name"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ $task->name }}">
            @error('name')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="font-bold">Description</label>
            <input type="text" name="description" id="description" placeholder="description"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror" value="{{ $task->description }}">
            @error('description')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="user_id" class="font-bold">Assigned to </label>
            <select name="user_id" id="user_id">
                <option value="">----------</option>
            @foreach($allusers as $user)
                @if($user->id == $task->user_id)
                    <option value="{{ $user->id }}" selected="true">{{ $user->name }}</option>
                    @else
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
            @endforeach
            </select>
            @error('user_id')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="parent_id" class="font-bold">Parent Task </label>
            <select name="parent_id" id="parent_id">
                <option value="0">No Parent</option>
            @foreach($alltasks as $parent)
                @if($parent->id == $task->id)
                    @continue
                @endif
                @if($parent->id == $task->parent_id)
                    <option value="{{ $parent->id }}" selected="true">{{ $parent->name }}</option>
                @else
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endif
            @endforeach
            </select>
            @error('parent_id')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="start" class="font-bold">Start Date</label>
            <input type="text" name="start" id="start" placeholder="start"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('start') border-red-500 @enderror" value="{{ $task->start }}">
            @error('start')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="finish" class="font-bold">Expect to finish by</label>
            <input type="text" name="finish" id="finish" placeholder="finish"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('finish') border-red-500 @enderror" value="{{ $task->finish }}">
            @error('finish')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="priorities_id" class="font-bold">Priority </label>
            <select name="priorities_id" id="priorities_id">
                <option value="">----------</option>
            @foreach($allpriorities as $priorities)
                @if($priorities->id == $task->priorities_id)
                    <option value="{{ $priorities->id }}" selected="true">{{ $priorities->name }}</option>
                    @else
                    <option value="{{ $priorities->id }}">{{ $priorities->name }}</option>
                @endif
            @endforeach
            </select>
            {{-- <input type="text" name="priorities_id" id="priorities_id" placeholder="priorities_id"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('priorities_id') border-red-500 @enderror" value="{{ $task->priorities_id }}"> --}}
            @error('priorities_id')
                <div class="text-red-500 mt-2 text-sm" > {{ $message}} </div>
            @enderror
        </div>


        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{$SubmitButton}} </button>
        </div>
{{--
            {{ csrf_field() }}
            <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('description','Description:') !!}
               {!! Form::textarea('description',null,['class' => 'form-control']) !!}
            </div>
            <table width=90%>
               <tr><td>
                  <div class="form-group">
                     <strong>{!! Form::label('team','Team:') !!}</strong>
                      <select name="team_id">
                      @foreach($teams as $team)
                          @if($team->id == $tasks->team_id)
                          <option value="{{ $team->id }}" selected="true">{{ $team->name }}</option>
                          @else
                          <option value="{{ $team->id }}">{{ $team->name }}</option>
                          @endif
                      @endforeach
                      </select>
                  </div>
               </td><td>
                  <div class="form-group">
                     <strong>{!! Form::label('parent','Parent:') !!}</strong>
                      <select name="parent">
                          <option value="">----------</option>
                      @foreach($alltasks as $user)
                          @if($user->id == $tasks->parent)
                          <option value="{{ $user->id }}" selected="true">{{ $user->name }}</option>
                          @else
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endif
                      @endforeach
                      </select>
                  </div>
               </td><td>
                  <div class="form-group">
                     <strong>{!! Form::label('sibling','Sibling:') !!}</strong>
                      <select name="sibling">
                          <option value="">----------</option>
                      @foreach($alltasks as $user)
                         @if($user->id == $tasks->sibling)
                            <option value="{{ $user->id }}" selected="true">{{ $user->name }}</option>
                            @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                         @endif
                      @endforeach
                      </select>
                  </div>
               </td></tr>
               <tr><td>
                  <div class="form-group col-md-9">
                     <div class='input-group date' id='datetimepicker1'>
                        <strong style='vertical-align: middle; line-height: 5vh;'>Starting on:&nbsp;</strong>
                        <input type='text' name="start" class="form-control" value="{{$tasks->start}}">
                        <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                        </span>
                     </div>
                  </div>
               </td><td>
                  <div class="form-group col-md-9">
                     <div class='input-group date' id='datetimepicker2'>
                        <strong style='vertical-align: middle; line-height: 5vh;'>Finishing on:&nbsp;</strong>
                        <input type='text' name="finish" class="form-control" value="{{$tasks->finish}}">
                        <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                        </span>
                     </div>
                  </div>
                  <script type="text/javascript">
                   $(function () {
                        $('#datetimepicker1').datetimepicker({
                        format: 'LL'
                        });
                       $('#datetimepicker2').datetimepicker({
                          useCurrent: false,
                          format: 'LL'
                       });
                       $("#datetimepicker1").on("dp.change", function (e) {
                           $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                       });
                       $("#datetimepicker2").on("dp.change", function (e) {
                           $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                       });
                   });
                  </script>
               </td><td>

            </table>

            <div class="form-group">
            {!! Form::submit($SubmitButton,['class' => 'btn btn-primary form-control']) !!}
            </div>
--}}

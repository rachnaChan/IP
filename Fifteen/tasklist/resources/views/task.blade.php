@extends('layouts.app')
@section('content')

<div class="panel-body m-auto justify-content-center">
    <form action="/task" method="post" class="form-horizontal mb-4">
        {{ csrf_field() }}
        @include('common.errors')

        <div class="form-group w-75 m-auto">
            <label for="task" class="col-sm-3 control-label mt-3">New Task</label>
            <div class="col-sm-6 mb-3">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>


        <div class="col-sm-6 mx-5">
            <button style="background-color: pink; height: 40px; width:160px;" type="submit" class="d-flex justify-content-around m-auto ">

                <div class=" mt-1" style="width: 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-1 h-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>

                <p class="mt-1 ">Add New Task</p>

            </button>
        </div>





    </form>
</div>

@if(count($tasks)>0)
<div class="panel panel-default w-75 m-auto">

    <div class="panel-heading ">
        Current Task
    </div>

    <div class="panel-body mt-3">
        <table class="table table-stripped task-table">

            <thead>
                <th>Task</th>
                <th>&nbsp;</th>
            </thead>

            <tbody>
                @foreach($tasks as $task)


                <tr>
                    <td class="table-text">
                        <div>{{$task->name}}</div>
                    </td>

                    <td>
                        <form action="/task/{{$task->id}}" method="post">
                            {{ csrf_field()}}
                            {{method_field("delete")}}
                            <!-- <input type='hidden' name='_token' value="{{csrf_token()}}">
                            <a href="#" onclick="$(this).closest('form').submit()" style="color:#ff
                            "><i class="fa fa-trash"></i></a> |
                            <a href="/editTask/{!!$task['id']!!}"><i
                            class="fas fa-pencil-alt" title="Edit Task"></i></a> -->

                            <!-- <button class="btn btn-danger">Delete Task</button> -->
                            <button style="background-color:aliceblue; height: 40px; width:160px;" type="submit" class="d-flex justify-content-around m-auto ">

                                <div class=" mt-1" style="width: 30px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>

                                </div>

                                <p class="mt-1 ">Delete</p>

                            </button>


                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endif

@endsection

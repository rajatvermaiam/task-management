<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Task List
                        <center><a href="{{url('task/create')}}">
                                <button type="button" class="btn btn-primary">Add Task</button>
                                <a href="{{url('completed-task')}}">
                                    <button type="button" class="btn btn-success">Completed Task List</button>
                                </a>
                            </a></center>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($tasks as $task)
                            <h3><a href="{{ url('task/'.$task->id)}}"> {{$loop->index+1}}.{{$task->name}}</a></h3>
                            @if($task->assigned->count()!=0)
                                <b>Assigned to:</b>
                                @foreach($task->assigned as $assigned_user)
                                    {{$assigned_user->name}},
                                @endforeach
                                <br>
                            @endif
                            <b>Created By:{{$task->createdBy->name}}</b><br>
                            <a href="{{url('assign/'.$task->id)}}">
                                <button type="button" class="btn btn-primary">Assign Task</button>
                            </a>
                            @if($task->created_by==Auth::user()->id)
                                <form method="post" id="delete-form-{{ $task->id }}"
                                      action="{{ url('task/'.$task->id)}}"
                                      style="display:none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="" onclick="
                                        if(confirm('Are you sure, You Want to delete this?'))
                                        {
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $task->id }}').submit();
                                        }
                                        else{
                                        event.preventDefault();
                                        }">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                                @foreach($task->assigned as $assigned_user)
                                    @if($assigned_user->id==Auth::user()->id)
                                        {{--                                        @foreach($task->assign as $assign_user)--}}
                                        @if($task->assign->status==0)
                                            <a href="{{url('completed/'.$task->id)}}">
                                                <button type="button" class="btn btn-success"
                                                        onclick="confirm('You completed this Task?')">Completed ?
                                                </button>
                                            </a>
                                        @endif
                                        {{--                                        @endforeach--}}
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

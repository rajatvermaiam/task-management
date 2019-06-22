@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Assign Task
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{url('assign/'.$task->id)}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="taskName">Task Name : {{$task->name}}</label>
                            </div>
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <select class="form-control" name="user" required>
                                    <option value="" selected disabled>Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

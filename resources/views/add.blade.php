@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Task
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{url('task')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input type="text" class="form-control" id="taskName" placeholder="Enter Task Name"
                                       name="task_name" required value="{{old('task_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="detail">Task Detail</label>
                                <textarea class="form-control" id="detail" rows="3" name="detail"
                                          placeholder="Enter Task Detail" required value="{{old('detail')}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="subTaskName">Sub-Task Names</label>
                                <input type="text" class="form-control" id="subTaskName"
                                       placeholder="Enter Sub-Task Name" name="sub_task_name"
                                       value="{{old('sub_task_name')}}">
                                <small id="subTaskHelp" class="form-text text-muted">Enter Sub-Task separated by
                                    comma.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" placeholder="Enter Start Date"
                                       name="start_date" required value="{{old('start_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" id="endDate" placeholder="Enter End Date"
                                       name="end_date" required value="{{old('end_date')}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

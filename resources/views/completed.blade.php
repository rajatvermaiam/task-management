@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Completed Task
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Completed By:</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($completed_tasks as $completed_task)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$completed_task->task->name}}</td>
                                    <td>{{$completed_task->user->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

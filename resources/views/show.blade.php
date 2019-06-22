@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Task Detail
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($subTasks->count() !=0)
                            <b>Sub Task: </b><br>
                            @foreach($subTasks as $subTask)
                                {{$loop->index+1}}.{{$subTask->name}}<br>
                            @endforeach
                        @endif
                        <b>Start Date: </b>{{$task->start_date}}<br>
                        <b>End Date: </b>{{$task->end_date}}<br>
                        <b>Detail: </b>{{$task->detail}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

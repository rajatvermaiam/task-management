<?php

namespace App\Http\Controllers;

use App\SubTask;
use App\Task;
use App\TaskUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('subTasks')->with('assigned')->with('createdBy')->with('assign')->get();
        return view('welcome', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->input('task_name');
        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->detail = $request->input('detail');
        $task->created_by = Auth::user()->id;
        $task->save();
        if ($request->input('sub_task_name')) {
            $sub_tasks = explode(',', $request->input('sub_task_name'));
            foreach ($sub_tasks as $sub_task) {
                $subTask = new SubTask();
                $subTask->task_id = $task->id;
                $subTask->name = $sub_task;
                $subTask->save();
            }
        }
        return redirect(url('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $subTasks = Subtask::where('task_id', $task['id'])->get();
        return view('show', compact('task', 'subTasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(url('/'));
    }

    public function assign($id)
    {
        $allReady_assigned_users = TaskUser::where('task_id', $id)->pluck('user_id');
        $users = User::whereNotIn('id', $allReady_assigned_users)->get();
        $task = Task::find($id);
        return view('assign', compact('task', 'users'));
    }

    public function assignStore($id, Request $request)
    {
        $taskUser = new TaskUser();
        $taskUser->task_id = $id;
        $taskUser->user_id = $request->input('user');
        $taskUser->assigned_id = Auth::user()->id;
        $taskUser->save();
        return redirect(url('/'));
    }

    public function completed($id)
    {
        $task = TaskUser::where('user_id', Auth::user()->id)->where('task_id', $id)->first();
        $task->status = 1;
        $task->save();
        return redirect(url('/'));
    }

    public function completedTask()
    {
        $completed_tasks = TaskUser::where('status', 1)
            ->with('task')
            ->with('user')
            ->get();
        return view('completed', compact('completed_tasks'));
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    public function subTasks()
    {
        return $this->hasMany('App\SubTask', 'task_id', 'id');
    }

    public function assigned()
    {
        return $this->hasManyThrough('App\User', 'App\TaskUser', 'task_id', 'id', 'id', 'user_id');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function assign()
    {
        return $this->hasOne('App\TaskUser', 'task_id', 'id')->where('user_id', Auth::user()->id);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index(){
        // Get All Tasks
        $tasks = Task::get();
        if($tasks->count() > 0){
            return TaskResource::collection($tasks);
        } else {
            return response()->json(["message" => "No task available"], 200);
        }
    }

    public function store(){
        // Get All Tasks
    }

    public function show(){
        // Get All Tasks
    }

    public function update(){
        // Get All Tasks
    }

    public function destroy(){
        // Get All Tasks
    }
}

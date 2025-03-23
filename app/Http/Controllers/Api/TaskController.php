<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){
        // Get All Tasks
        $tasks = Task::get();
        if($tasks->count() > 0){
            return response()->json([
                "message" => "Tasks found",
                "data" => TaskResource::collection($tasks)
            ], 200);
        } else {
            return response()->json(["message" => "No tasks available"], 204);
        }
    }

    public function store(Request $request){
        // Store a task function
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|in:low,medium,high',
            'due_date' => 'nullable'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'message' => 'Error creating a task. Check the fields.',
                'error' => $validator->messages()
            ]);
        }

        // if validation passes, create the task
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date
        ]);

        return response()->json([
            'message' => "Task created successfully",
            'data'=> new TaskResource($task)
        ], 201);
    }

    public function show(Task $task){
        // Get Single Task
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task){
        // Update Single Task
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|in:low,medium,high',
            'due_date' => 'nullable'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'message' => 'Error updating the task. Check the fields.',
                'error' => $validator->messages()
            ], 422);
        }

        // if validation passes, update the task
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date
        ]);

        return response()->json([
            'message' => "Task updated successfully",
            'data'=> new TaskResource($task)
        ], 200);

    }

    public function destroy(Task $task){
        // Delete a task
        $task->delete();
        return response()->json([
            "message" => "Task deleted successfully"
        ], 200);
    }
}

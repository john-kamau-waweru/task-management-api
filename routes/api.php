<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;


/*
  GET        api/tasks .................................... tasks.index › Api\TaskController@index
  POST            api/tasks .................................... tasks.store › Api\TaskController@store
  GET        api/tasks/{task} ............................... tasks.show › Api\TaskController@show
  PUT|PATCH       api/tasks/{task} ........................... tasks.update › Api\TaskController@update
  DELETE          api/tasks/{task} ......................... tasks.destroy › Api\TaskController@destroy
*/
Route::apiResource('tasks',TaskController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

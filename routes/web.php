<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Display a list of tasks
//Route::get('test', [TaskController::class, 'test']);   //-- working 
//Route::get('index', [TaskController::class, 'index'])->name('index');   //-- working 
//Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

//Route::resource('tasks', TaskController::class);
// View all tasks
//Route::get('index', [TaskController::class, 'index'])->name('index');   //-- working 
Route::get('create', [TaskController::class, 'create']);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
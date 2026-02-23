<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ---------------------------
// Authentication Routes


Route::get('/', function () {
    return redirect()->route('login');
});
// ---------------------------

// Registration
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// ---------------------------
// Task Routes (CRUD)
// ---------------------------
Route::middleware('auth')->group(function () {

    // Dashboard / List Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Add Task Form
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Store Task
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Edit Task Form
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // Update Task
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    // Delete Task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/','/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'verified'])->controller(TasksController::class)->group(function () {
    Route::get('/tasks', 'index')->name('task.list');
    Route::get('/Add-Tasks', 'create')->name('task.add');
    Route::post('/save-tasks', 'store')->name('task.store');
    Route::get('/delete/{id}', 'destroy')->name('task.delete');
    Route::get('/Tasks/{id}', 'edit')->name('task.edit');
    Route::post('/Tasks/{id}/edit', 'update')->name('task.update');
    Route::post('/tasks/{id}/status', 'updateStatus')->name('task.updateStatus');
    Route::post('/tasks', 'search')->name('task.search');
});

require __DIR__ . '/auth.php';

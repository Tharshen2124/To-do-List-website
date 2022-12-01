<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Route::resource('/', TaskController::class)
    ->only(['index', 'store']); */

Route::get('/', [TaskController::class, 'index'])->name('mainRoute');
Route::post('/saveItemRoute', [TaskController::class, 'saveItem'])->name('saveItem');
Route::post('/markCompleteRoute/{id}', [TaskController::class, 'markComplete'])->name('markComplete');
Route::get('/editRoute/{task}', [TaskController::class, 'editRoute'])->name('editRoute');
Route::patch('/updateRoute/{task}', [TaskController::class, 'updateRoute'])->name('updateRoute');
Route::delete('/deleteRoute/{task}', [TaskController::class, 'deleteRoute'])->name('deleteRoute');
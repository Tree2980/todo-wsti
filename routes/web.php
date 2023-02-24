<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;
use App\Http\Controllers\Days;
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

Auth::routes();



Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('welcome');
    });

Route::get('/', [Todo::class, 'index']);
Route::post('/todos', [Todo::class, 'store']);
Route::put('/todos/{id}', [Todo::class, 'update']);
Route::delete('/todos/{id}', [Todo::class, 'destroy']);
Route::patch('/todos/{id}', [Todo::class, 'change_status']);
Route::any('/todo_clear_all', [Todo::class, 'destroy_all']);
Route::any('/todo_clear_completed', [Todo::class, 'destroy_completed']);



});
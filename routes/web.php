<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function() {
    Route::resource('/tarefa', TarefaController::class);
    Route::patch("/tarefa/mark/{tarefa}", [TarefaController::class, 'updateMarkdown'])->name('tarefa.mark');
    Route::post("/tarefa/restore/{tarefa}", [TarefaController::class, 'restore'])->name('tarefa.restore');
});
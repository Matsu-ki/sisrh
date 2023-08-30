<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncionarioController;
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
    return view('login');
});

/*Route::get('/funcionarios', function () {
    return view('funcionarios.index');
});*/

Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::get('/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}/delete', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

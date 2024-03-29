<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoupancaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/auth', [UserController::class, 'auth'])->name('auth.user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    //DESPESAS
    Route::get('/despesas', [DespesaController::class, 'index'])->name('despesas.index');
    Route::post('/despesas/cadastrar', [DespesaController::class, 'cadastrar'])->name('despesas.cadastrar');
    Route::post('/despesas/deletar', [DespesaController::class, 'deletar'])->name('despesas.deletar');
    Route::get('/teste', [DespesaController::class, 'listarEAgruparDespesas'])->name('teste');
    //TIPOS
    Route::get('/tipos/buscartipos', [\App\Http\Controllers\TipoDespesaController::class, 'buscarTipos'])->name('tipos.buscar');

    //POUPANCA
    Route::get('/poupanca', [PoupancaController::class, 'index'])->name('poupanca.index');
});

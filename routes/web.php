<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
| Agrupadas pelo LoginController para maior organização.
*/
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'create')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.store')->middleware('guest');
    Route::post('/logout', 'destroy')->name('logout')->middleware('auth');
});


/*
|--------------------------------------------------------------------------
| Rotas Protegidas da Aplicação
|--------------------------------------------------------------------------
| Todas as rotas aqui dentro exigem que o usuário esteja logado.
*/
Route::middleware('auth')->group(function () {

    // Grupo de Rotas do Professor
    Route::middleware('role:0')->prefix('professor')->name('professor.')->group(function () {
        Route::get('/relatorios', [ProfessorController::class, 'index'])->name('dashboard');
        // Ex: Route::get('/relatorios/novo', ...)->name('reports.create');
    });

    // Grupo de Rotas do Administrador
    Route::middleware('role:1')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        // Ex: Route::get('/usuarios', ...)->name('users.index');
    });

});
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Documents\DashboardController as DocumentsDashboardController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
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
*/
Route::middleware('auth')->group(function () {

    // Grupo de Rotas de Documentos

    Route::middleware('role:0')->prefix('documents')->name('documents.')->group(function () {

        Route::get('/dashboard', [DocumentsDashboardController::class, 'index'])->name('dashboard');
    });

    // Grupo de Rotas do Administrador
    Route::middleware('role:1')->prefix('admin')->name('admin.')->group(function () {
    
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/professores/{id}', [AdminController::class, 'show'])->name('professores.show');
        Route::get('/professors/{id}/edit', [AdminController::class, 'edit'])->name('professores.edit');
        Route::put('/professores/{id}', [AdminController::class, 'update'])->name('professores.update');
    });

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmpleadoController;

// Raíz → login
Route::get('/', fn() => redirect()->route('login'));

// Autenticación
require __DIR__.'/auth.php';

// Dashboard
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');
    if (!in_array(auth()->user()->rol, ['administrador', 'secretaria'])) abort(403);
    return view('dashboard');
})->name('dashboard');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {

    // Usuarios → Solo admin
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Cargos → Admin + Secretaria
    Route::resource('cargos', CargoController::class)->except(['show']);

    // Empleados → Admin + Secretaria
    Route::resource('empleados', EmpleadoController::class)->except(['show']);
});

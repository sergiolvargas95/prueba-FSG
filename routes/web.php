<?php

use App\Http\Controllers\Seguridad\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad\LoginController;
use App\Http\Controllers\Seguridad\UsuarioController;

Route::get('/', function () {
    return redirect('/seguridad/auth/login');
});

/**SEGURIDAD */
Route::prefix('seguridad')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [LoginController::class, 'login'])->name('login');

        Route::get('/register', [RegisterController::class, 'register'])->name('register');

        Route::post('/acceso', [
            LoginController::class,
            'acceso'
        ])->name('login.acceso');

        Route::post('/register', [
            RegisterController::class,
            'registerUser'
        ])->name('register.registerUser');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    });

    /**USUARIO */
    Route::prefix('usuario')->middleware('check.login')->group(function () {
        Route::get('/catalogo', [
            UsuarioController::class,
            'catalogo'
        ])->name('usuarios.catalogo');

        Route::get('/detalle/{id}', [
            UsuarioController::class,
            'detalle'
        ])->name('usuarios.detalle');

        Route::post('/usuarios/{id}/foto', [
            UsuarioController::class,
            'guardarFoto'
        ])->name('usuarios.foto');
    });
});

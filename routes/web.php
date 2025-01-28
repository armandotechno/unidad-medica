<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('login.login');
});

Route::post('logout', function () {
    Auth::logout();
    Session::flush(); // Elimina todos los datos de la sesión
    return redirect('/');
})->name('logout');

Route::post('/validarLogin', [App\Http\Controllers\LoginController::class, 'validarLogin'])->name('validarLogin');
Route::get('/inicio', function () {
            return view('auth.inicio');
        })->name('inicio');

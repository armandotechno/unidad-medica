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

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::post('/validarLogin', [App\Http\Controllers\LoginController::class, 'validarLogin'])->name('validarLogin');



Route::middleware("auth")->group(function () {
    Route::get('/inicio', function () {
        return view('auth.inicio');
    })->name('inicio');

    // Rutas de usuarios y doctores
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'usuarios'])->name('usuarios');
    Route::get('/nuevoUsuario', [App\Http\Controllers\UsuarioController::class, 'nuevoUsuario'])->name('nuevoUsuario');
    Route::post('/crearUsuario', [App\Http\Controllers\UsuarioController::class, 'crearUsuario'])->name('crearUsuario');
    Route::post('/editarUsuario', [App\Http\Controllers\UsuarioController::class, 'editarUsuario'])->name('editarUsuario');
    Route::post('/editarDatosUsuario', [App\Http\Controllers\UsuarioController::class, 'editarDatosUsuario'])->name('editarDatosUsuario');
    Route::post('/eliminarUsuario', [App\Http\Controllers\UsuarioController::class, 'eliminarUsuario'])->name('eliminarUsuario');

    // Rutas de doctores
    Route::get('/doctores', [App\Http\Controllers\DoctorController::class, 'doctores'])->name('doctores');

    // Rutas de pacientes
    Route::get('/pacientes', [App\Http\Controllers\PacienteController::class, 'pacientes'])->name('pacientes');
    Route::get('/registrarPacientes', [App\Http\Controllers\PacienteController::class, 'registrarPacientes'])->name('registrarPacientes');
    Route::post('/guardarRegistroPaciente', [App\Http\Controllers\PacienteController::class, 'guardarRegistroPaciente'])->name('guardarRegistroPaciente');
    Route::post('/editarPaciente', [App\Http\Controllers\PacienteController::class, 'editarPaciente'])->name('editarPaciente');
    Route::post('/editarDatosPaciente', [App\Http\Controllers\PacienteController::class, 'editarDatosPaciente'])->name('editarDatosPaciente');
    Route::post('/eliminarPaciente', [App\Http\Controllers\PacienteController::class, 'eliminarPaciente'])->name('eliminarPaciente');

    //Rutas de reportes de pacientes
    Route::get('/reportePacientes', [App\Http\Controllers\ReportePacienteController::class, 'reportePacientes'])->name('reportePacientes');

    // Rutas de historial médico
    Route::get('/historialMedico', [App\Http\Controllers\HistorialMedicoController::class, 'historialMedico'])->name('historialMedico');

});

<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CleanController;
use App\Http\Controllers\PlantacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//PLANTATIONS
Route::get('/plantaciones', [PlantacionController::class, 'index'])->name('plantacion.index');

Route::get('/plantaciones/{id}', [PlantacionController::class, 'show'])->name('plantacion.show');

Route::post('/plantaciones/create', [PlantacionController::class, 'store'])->name('plantaciones.store');

Route::put('/plantaciones/update/{id}', [PlantacionController::class, 'update'])->name('plantaciones.update');

Route::delete('/plantaciones/delete/{id}', [PlantacionController::class, 'delete'])->name('plantaciones.delete');

//ACTIVITIES

Route::get('/actividades', [ActivityController::class, 'index'])->name('activity.index');

Route::get('/actividades/{id}', [ActivityController::class, 'show'])->name('activity.show');

Route::post('/actividades/create', [ActivityController::class, 'store'])->name('activities.store');

Route::put('/actividades/update/{id}', [ActivityController::class, 'update'])->name('actividades.update');

Route::delete('/actividades/delete/{id}', [ActivityController::class, 'delete'])->name('actividades.delete');

//CLEANS

Route::get('/limpiezas', [CleanController::class, 'index'])->name('limpiezas.index');

Route::get('/limpiezas/{id}', [CleanController::class, 'show'])->name('limpiezas.show');

Route::post('/limpiezas/create', [CleanController::class, 'store'])->name('activities.store');

Route::put('/limpiezas/update/{id}', [CleanController::class, 'update'])->name('limpiezas.update');

Route::delete('/limpiezas/delete/{id}', [CleanController::class, 'delete'])->name('limpiezas.delete');

// USERS

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show');

Route::post('/usuarios/create', [UserController::class, 'store'])->name('usuario.store');

Route::delete('/usuarios/delete/{id}', [UserController::class, 'delete'])->name('usuarios.delete');

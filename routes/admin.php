<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TipoCambioController;

// rutas para el adminitrador y operador
Route::get('', [HomeController::class,'index'])->name('admin.index');
Route::get('listar', [TipoCambioController::class,'listar'])->middleware('role:admin|operador')->name('admin.listar');
Route::get('editar', [TipoCambioController::class,'editar'])->middleware('role:admin')->name('admin.editar');
Route::get('crear', [TipoCambioController::class,'crear'])->middleware('role:admin')->name('admin.crear');

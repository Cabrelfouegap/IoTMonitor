<?php
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
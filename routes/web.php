<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');
Route::resource('equipment', EquipmentController::class)
    ->middleware('auth');
Route::resource('maintenance', MaintenanceController::class)
    ->middleware('auth');
Route::patch(
    '/maintenance/{maintenance}/start',
    [MaintenanceController::class, 'start']
)->middleware('auth')->name('maintenance.start');
Route::patch(
    '/maintenance/{maintenance}/complete',
    [MaintenanceController::class, 'complete']
)->middleware('auth')->name('maintenance.complete');
Route::resource('spare-parts', SparePartController::class)
    ->middleware('auth');
Route::get('/stock-movements/create', [StockMovementController::class, 'create'])
    ->middleware('auth')
    ->name('stock-movements.create');

Route::post('/stock-movements', [StockMovementController::class, 'store'])
    ->middleware('auth')
    ->name('stock-movements.store');
Route::get('/stock-movements', [StockMovementController::class, 'index'])
    ->middleware('auth')
    ->name('stock-movements.index');
Route::post(
    '/maintenance/{maintenance}/spare-parts',
    [MaintenanceController::class, 'addSparePart']
)->middleware('auth')
    ->name('maintenance.spare-parts.store');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
Route::get('/reports', [ReportController::class, 'index'])
    ->middleware('auth')
    ->name('reports.index');

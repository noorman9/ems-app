<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Semua halaman di bawah ini memerlukan login.
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Laporan: semua role boleh melihat.
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');


    // Equipment: semua role boleh melihat daftar.
    Route::get('/equipment', [EquipmentController::class, 'index'])
        ->name('equipment.index');

    // Equipment: hanya admin yang boleh mengelola data.
    Route::middleware('role:admin')->group(function () {
        Route::get('/equipment/create', [EquipmentController::class, 'create'])
            ->name('equipment.create');

        Route::post('/equipment', [EquipmentController::class, 'store'])
            ->name('equipment.store');

        Route::get('/equipment/{equipment}/edit', [EquipmentController::class, 'edit'])
            ->name('equipment.edit');

        Route::put('/equipment/{equipment}', [EquipmentController::class, 'update'])
            ->name('equipment.update');

        Route::patch('/equipment/{equipment}', [EquipmentController::class, 'update']);

        Route::delete('/equipment/{equipment}', [EquipmentController::class, 'destroy'])
            ->name('equipment.destroy');
    });

    // Detail Equipment diletakkan setelah route statis.
    Route::get('/equipment/{equipment}', [EquipmentController::class, 'show'])
        ->whereNumber('equipment')
        ->name('equipment.show');


    // Maintenance: semua role boleh melihat.
    Route::get('/maintenance', [MaintenanceController::class, 'index'])
        ->name('maintenance.index');



    // Admin dan technician boleh menjalankan pekerjaan maintenance.
    Route::middleware('role:admin,technician')->group(function () {
        Route::get('/maintenance/create', [MaintenanceController::class, 'create'])
            ->name('maintenance.create');


        Route::post('/maintenance', [MaintenanceController::class, 'store'])
            ->name('maintenance.store');

        Route::patch(
            '/maintenance/{maintenance}/start',
            [MaintenanceController::class, 'start']
        )->name('maintenance.start');

        Route::patch(
            '/maintenance/{maintenance}/complete',
            [MaintenanceController::class, 'complete']
        )->name('maintenance.complete');

        Route::post(
            '/maintenance/{maintenance}/spare-parts',
            [MaintenanceController::class, 'addSparePart']
        )->name('maintenance.spare-parts.store');
    });
    Route::get('/maintenance/{maintenance}', [MaintenanceController::class, 'show'])
        ->name('maintenance.show');

    // Perubahan jadwal/data maintenance dan penghapusan: admin saja.
    Route::middleware('role:admin')->group(function () {
        Route::get('/maintenance/{maintenance}/edit', [MaintenanceController::class, 'edit'])
            ->name('maintenance.edit');

        Route::put('/maintenance/{maintenance}', [MaintenanceController::class, 'update'])
            ->name('maintenance.update');

        Route::patch('/maintenance/{maintenance}', [MaintenanceController::class, 'update']);

        Route::delete('/maintenance/{maintenance}', [MaintenanceController::class, 'destroy'])
            ->name('maintenance.destroy');
    });

    // Spare parts: semua role boleh melihat.
    Route::get('/spare-parts', [SparePartController::class, 'index'])
        ->name('spare-parts.index');


    // Spare parts: hanya admin yang boleh mengelola katalog.
    Route::middleware('role:admin')->group(function () {
        Route::get('/spare-parts/create', [SparePartController::class, 'create'])
            ->name('spare-parts.create');

        Route::post('/spare-parts', [SparePartController::class, 'store'])
            ->name('spare-parts.store');

        Route::get('/spare-parts/{spare_part}/edit', [SparePartController::class, 'edit'])
            ->name('spare-parts.edit');

        Route::put('/spare-parts/{spare_part}', [SparePartController::class, 'update'])
            ->name('spare-parts.update');

        Route::patch('/spare-parts/{spare_part}', [SparePartController::class, 'update']);

        Route::delete('/spare-parts/{spare_part}', [SparePartController::class, 'destroy'])
            ->name('spare-parts.destroy');
    });

    Route::get('/spare-parts/{spare_part}', [SparePartController::class, 'show'])
        ->name('spare-parts.show');

    // Riwayat stok: semua role boleh melihat.
    Route::get('/stock-movements', [StockMovementController::class, 'index'])
        ->name('stock-movements.index');

    // Admin dan technician boleh mencatat transaksi stok.
    Route::middleware('role:admin,technician')->group(function () {
        Route::get('/stock-movements/create', [StockMovementController::class, 'create'])
            ->name('stock-movements.create');

        Route::post('/stock-movements', [StockMovementController::class, 'store'])
            ->name('stock-movements.store');
    });
});

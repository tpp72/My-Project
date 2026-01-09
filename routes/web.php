<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

use App\Http\Controllers\Admin\ParkingLotController as AdminParkingLotController;
use App\Http\Controllers\Admin\ParkingSlotController as AdminParkingSlotController;
use App\Http\Controllers\Admin\ParkingLogController as AdminParkingLogController;

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/parking-lots/create', [AdminParkingLotController::class, 'create'])->name('parking-lots.create');
        Route::post('/parking-lots', [AdminParkingLotController::class, 'store'])->name('parking-lots.store');

        Route::get('/parking-slots/create', [AdminParkingSlotController::class, 'create'])->name('parking-slots.create');
        Route::post('/parking-slots', [AdminParkingSlotController::class, 'store'])->name('parking-slots.store');

        Route::get('/parking-logs', [AdminParkingLogController::class, 'index'])->name('parking-logs.index');
    });

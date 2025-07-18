<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\ManKursusController;
use App\Models\Kursus;

// Route utama yang dapat diakses guest dan user yang sudah login
Route::get('/', [KursusController::class, 'index'])->name('kursus.index');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/kursus/{kursus}', [KursusController::class, 'show'])->name('kursus.show');
// Rute untuk proses pendaftaran/transaksi (akan dibuat nanti)
Route::post('/kursus/{kursus}/enroll', [KursusController::class, 'enroll'])->name('kursus.enroll')->middleware('auth');

// Rute untuk upload bukti pembayaran - Updated untuk mendukung AJAX
Route::get('/transaction/{transaction}/upload-proof', [KursusController::class, 'showUploadPaymentProofForm'])->name('transactions.upload_proof_form');
Route::post('/transaction/{transaction}/upload-proof', [KursusController::class, 'uploadPaymentProof'])->name('transactions.upload_proof')->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    // Route admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Route untuk CRUD Kursus
    Route::prefix('admin/kursus')->name('admin.kursus.')->group(function () {
        Route::get('/', [ManKursusController::class, 'index'])->name('index');
        Route::get('/create', [ManKursusController::class, 'create'])->name('create');
        Route::post('/', [ManKursusController::class, 'store'])->name('store');
        Route::get('/{kursus}', [ManKursusController::class, 'show'])->name('show');
        Route::get('/{kursus}/edit', [ManKursusController::class, 'edit'])->name('edit');
        Route::put('/{kursus}', [ManKursusController::class, 'update'])->name('update');
        Route::delete('/{kursus}', [ManKursusController::class, 'destroy'])->name('destroy');
    });
    
    // Route untuk manajemen transaksi
    Route::prefix('admin/transaksi')->name('admin.transaksi.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('index');
        Route::get('/{transaction}', [App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('show');
        Route::patch('/{transaction}/approve', [App\Http\Controllers\Admin\TransactionController::class, 'approve'])->name('approve');
        Route::patch('/{transaction}/reject', [App\Http\Controllers\Admin\TransactionController::class, 'reject'])->name('reject');
        Route::delete('/{transaction}', [App\Http\Controllers\Admin\TransactionController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-update', [App\Http\Controllers\Admin\TransactionController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [App\Http\Controllers\Admin\TransactionController::class, 'export'])->name('export');
        Route::get('/api/statistics', [App\Http\Controllers\Admin\TransactionController::class, 'statistics'])->name('statistics');
    });
});

require __DIR__.'/auth.php';
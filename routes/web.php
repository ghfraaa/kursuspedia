<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KursusController;

// Route utama yang dapat diakses guest dan user yang sudah login
Route::get('/', function () {
    if (auth()->check()) {
        // User sudah login, arahkan berdasarkan role
        if (auth()->user()->role === 'admin') {
            return app(AdminController::class)->index();
        } else {
            return app(UserController::class)->index();
        }
    } else {
        // Guest, tampilkan halaman welcome/landing page
        return view('home.index'); // atau view landing page untuk guest
    }
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Route khusus admin
    Route::get('/admin', [AdminController::class, 'index'])->middleware('admin')->name('admin.index');
    
    // Resource route untuk kursus
    Route::resource('kursus', KursusController::class);
});

require __DIR__.'/auth.php';
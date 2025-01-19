<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PinjamController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'role:1', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('notifikasi', function () {
        return view('admin.notifikasi');
    })->name('admin.notifikasi');

    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::get('/admin/barang', [BarangController::class, 'index'])->name('admin.barang');
    Route::get('/admin/barang/create', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/admin/barang', [BarangController::class, 'store'])->name('admin.barang.store');
    Route::get('/admin/barang/{barang}/edit', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/admin/barang/{barang}', [BarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/admin/barang/{barang}', [BarangController::class, 'destroy'])->name('admin.barang.destroy');
    Route::get('/admin/barang/{barang}', [BarangController::class, 'show'])->name('admin.barang.show');

    Route::get('/admin/pinjam', [PinjamController::class, 'showDaftarPeminjam'])->name('admin.pinjam');
    Route::get('/admin/pinjam/{username}/{created_at}', [PinjamController::class, 'show'])->name('admin.pinjam.show');
    Route::post('/admin/barang/update-all', [PinjamController::class, 'updateAll'])->name('admin.barang.updateAll');
    Route::get('/admin/pinjam/create', [PinjamController::class, 'create'])->name('admin.pinjam.create');
    Route::post('/admin/pinjam', [PinjamController::class, 'store'])->name('admin.pinjam.store');

});


Route::middleware(['auth', 'role:0', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.index');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');
    
    Route::get('/user/pinjam', [PinjamController::class, 'userindex'])->name('user.pinjam');
    Route::post('/user/meminjam', [PinjamController::class, 'store'])->name('user.pinjam.store');
    Route::get('/user/pinjam/list', [PinjamController::class, 'listpinjam'])->name('user.pinjam.list');

    Route::get('/user/pinjam/create', [PinjamController::class, 'create'])->name('user.pinjam.create');
    Route::get('/user/pinjam/{pinjam}/edit', [PinjamController::class, 'edit'])->name('user.pinjam.edit');
    Route::get('/user/pinjam/{username}/{created_at}', [PinjamController::class, 'showdetail'])->name('user.pinjam.show');
    Route::put('/user/pinjam/{pinjam}', [PinjamController::class, 'update'])->name('user.pinjam.update');
    Route::delete('/user/pinjam/{pinjam}', [PinjamController::class, 'destroy'])->name('user.pinjam.destroy');

});


Route::middleware(['auth', 'role:2', 'verified'])->group(function () {
    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

Route::middleware('auth')->group(function () {

});

require __DIR__.'/auth.php';

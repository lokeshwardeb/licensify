<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



use App\Http\Controllers\Admin\LicenseAdminController;

Route::middleware(['auth'])->group(function(){
    Route::get('/admin/licenses',[LicenseAdminController::class,'index'])->name('licenses.index');
    Route::get('/admin/licenses/create',[LicenseAdminController::class,'create'])->name('licenses.create');
    Route::post('/admin/licenses',[LicenseAdminController::class,'store'])->name('licenses.store');
    Route::get('/admin/licenses/{license}/edit',[LicenseAdminController::class,'edit'])->name('licenses.edit');
    Route::post('/admin/licenses/{license}/update',[LicenseAdminController::class,'update'])->name('licenses.update');
    Route::post('/admin/licenses/{license}/delete',[LicenseAdminController::class,'destroy'])->name('licenses.destroy');
});



require __DIR__.'/auth.php';

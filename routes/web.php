<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FlatController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', GuestHomeController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rotte per le operazioni CRUD
Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', AdminHomeController::class)->middleware(['auth', 'verified'])->name('home');
    Route::resource('flats', FlatController::class);
});

require __DIR__ . '/auth.php';

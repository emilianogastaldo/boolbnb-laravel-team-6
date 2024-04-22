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

Route::get('/', [GuestHomeController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', AdminHomeController::class)->middleware(['auth', 'verified'])->name('home'); // Rotta per la home di un admin

    // Rotte per implementare la Soft Delete
    Route::get('/flats/trash', [FlatController::class, 'trash'])->name('flats.trash')->withTrashed(); // Rotta per la pagina dove vedere i flat eliminati
    Route::delete('/flats/{flat}/drop', [FlatController::class, 'drop'])->name('flats.drop')->withTrashed(); // Rotta per la strong delete
    Route::patch('/flats/{flat}/restore', [FlatController::class, 'restore'])->name('flats.restore')->withTrashed(); //  Rotta per il restore


    Route::get('/flats', [FlatController::class, 'index'])->name('flats.index'); // Rotta per la lista dei flats
    Route::post('/flats', [FlatController::class, 'store'])->name('flats.store'); // Rotta per il salvataggio su db di un flat
    Route::get('/flats/create', [FlatController::class, 'create'])->name('flats.create'); // Rotta per la creazione di un flat
    Route::get('/flats{flat}', [flatController::class, 'show'])->name('flats.show')->withTrashed(); // Rotta visualizzare il singolo flat
    Route::put('/flats{flat}', [FlatController::class, 'update'])->name('flats.update')->withTrashed(); // Rotta per il salvataggio su db delle modifiche apportate
    Route::delete('/flats{flat}', [FlatController::class, 'destroy'])->name('flats.destroy'); // Rotta per eliminare un flat
    Route::get('/flats/{flat}/edit', [FlatController::class, 'edit'])->name('flats.edit')->withTrashed(); // Rotta per il form di modifica
});


require __DIR__ . '/auth.php';

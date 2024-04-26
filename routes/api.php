<?php

use App\Http\Controllers\Api\FlatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rotte api per la home e per la show
Route::get('/flats', [FlatController::class, 'index']);
// http://localhost:8000/api/flats/?address={address}&rooms={room}&bathrooms={bathroom}&services={services}
Route::get('/flats/?address={address}', [FlatController::class, 'filteredIndex']);
Route::get('/flats/{slug}', [FlatController::class, 'show']);

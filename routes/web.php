<?php

use App\Http\Controllers\MapController;
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

use App\Http\Controllers\LocationController;

Route::resource('locations', LocationController::class);

// Route ke halaman dashboard dengan middleware auth
Route::get('/', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('home');

// Route::get('/', [])->middleware('auth')->name('home');
Route::get('/mapCreate', [LocationController::class, 'index'])->name('mapCreate');
Route::get('/map', [MapController::class, 'index'])->name('map');
Route::post('/api/nearest-route', [MapController::class, 'nearestRoute']);

// Route untuk logout
// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__ . '/auth.php';

require __DIR__ . '/auth.php';

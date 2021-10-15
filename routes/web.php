<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LifeCoachController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/d', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', [LifeCoachController::class, 'index']);
Route::get('/', [DashboardController::class, 'index']);
Route::get('/create', [DashboardController::class, 'create']);

require __DIR__.'/auth.php';

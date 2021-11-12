<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowupTargetController;
use App\Http\Controllers\LifeCoachController;
use App\Http\Controllers\LifeCoachTargetController;
use App\Http\Controllers\ReportController;
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
Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::get('/all-life-coach', [LifeCoachController::class, 'list'])->name('all-life-coach');

Route::get('/create-life-coach', [DashboardController::class, 'createCoach'])->name('create-life-coach');

Route::post('/store-life-coach', [LifeCoachController::class, 'store'])->name('store-life-coach');

Route::get('/show-life-coach/{LifeCoach}', [LifeCoachController::class, 'show'])->name('show-life-coach');

Route::get('/edit-life-coach/{LifeCoach}', [LifeCoachController::class, 'edit'])->name('edit-life-coach');

Route::put('/update-life-coach/{LifeCoach}', [LifeCoachController::class, 'update'])->name('update-life-coach');

Route::delete('/delete-life-coach/{LifeCoach}', [LifeCoachController::class, 'destroy'])->name('delete-life-coach');

Route::get('/assign-target', [LifeCoachTargetController::class, 'create'])->name('assign-target-form');

Route::post('/assign-target/save', [LifeCoachTargetController::class, 'store'])->name('assign-target');

Route::get('life-coach/coach-targets', [LifeCoachTargetController::class, 'index'])->name('coach-targets');



Route::get('/all-target', [FollowupTargetController::class, 'index'])->name('all-target');

Route::get('/create-target', [FollowupTargetController::class, 'create'])->name('create-target');

Route::post('/store-target', [FollowupTargetController::class, 'store'])->name('store-target');

Route::get('/show-target/{target}', [FollowupTargetController::class, 'show'])->name('show-target');

Route::get('/edit-target/{target}', [FollowupTargetController::class, 'edit'])->name('edit-target');

Route::put('/update-target/{target}', [FollowupTargetController::class, 'update'])->name('update-target');

Route::delete('/delete-target/{target}', [FollowupTargetController::class, 'destroy'])->name('delete-target');



Route::get('life-coach/coach-targets/{target}/reports', [ReportController::class, 'index'])->name('all-reports');

Route::get('life-coach/coach-targets/reports/create', [ReportController::class, 'create'])->name('create-report');

Route::post('life-coach/coach-targets/reports/store', [ReportController::class, 'store'])->name('store-report');

Route::get('life-coach/coach-targets/reports/show', [ReportController::class, 'show'])->name('show-report');

Route::get('life-coach/coach-targets/reports/edit', [ReportController::class, 'edit'])->name('edit-report');

Route::put('life-coach/coach-targets/reports/update', [ReportController::class, 'update'])->name('update-report');

Route::delete('life-coach/coach-targets/reports/delete', [ReportController::class, 'destroy'])->name('delete-report');


require __DIR__.'/auth.php';

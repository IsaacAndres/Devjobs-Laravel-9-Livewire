<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VacancyController;
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

Route::get('/', HomeController::class)->name('home');


Route::controller(VacancyController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', 'index')->middleware(['userRole'])->name('vacancy.index');
    Route::get('/vacancy/create', 'create')->name('vacancy.create');
    Route::get('/vacancy/{vacancy}/edit', 'edit')->name('vacancy.edit');
    
    Route::get('/notificaciones', NotificationController::class)->middleware(['userRole'])->name('notifications');
});

Route::controller(CandidateController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/candidates/{vacancy}', 'index')->name('candidates.index');
});

Route::get('/vacancy/{vacancy}', [VacancyController::class, 'show'])->name('vacancy.show');


require __DIR__.'/auth.php';

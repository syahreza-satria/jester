<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [AppController::class, 'index'])->name('index');
Route::get('/about', [AppController::class, 'about'])->name('about');
Route::get('/contact', [AppController::class, 'contact'])->name('contact');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::put('/dashboard/photos/{photo}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/photos/{photo}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/photos/{photo}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

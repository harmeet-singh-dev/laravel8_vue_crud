<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');


});

Route::get('/data',[Controller::class, 'index'])->name('data');
Route::post('/store',[Controller::class, 'store'])->name('store');
Route::get('/all-data',[Controller::class, 'getData'])->name('data.all');
Route::get('/single-data/{id}',[Controller::class,'singleData']);
Route::get('/update/{detail}',[Controller::class, 'update'])->name('update');
Route::post('/update/{detail}', [Controller::class, 'edit'])->name('edit');



<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
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
Route::get('/dashboard',[TaskController::class, 'index'])->name('index');
Route::get('/topic',[TaskController::class, 'topic'])->name('topic');
Route::post('topic/create',[TaskController::class, 'create'])->name('create');
Route::get('/speaker',[TaskController::class, 'speaker'])->name('speaker');
Route::post('speaker/create',[TaskController::class, 'speaker_create'])->name('speaker_create');
Route::get('/course',[TaskController::class, 'course'])->name('course');
Route::post('course/create',[TaskController::class, 'course_create'])->name('course_create');
Route::get('/course-speaker',[TaskController::class, 'course_speaker'])->name('course-speaker');
Route::post('course-speaker/create',[TaskController::class, 'course_speaker_create'])->name('course_speaker_create');
Route::post('topic/search/{id}',[TaskController::class, 'search'])->name('search');



});





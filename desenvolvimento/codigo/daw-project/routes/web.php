<?php

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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;


//Login

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'signin'])->name('login-post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Students
Route::get('/students/', [StudentsController::class, 'index'])->name('students');
Route::post('/students/', [StudentsController::class, 'register'])->name('register');

//Teachers
Route::get('/teachers/', [TeachersController::class, 'index'])->name('teachers');
Route::post('/teachers/schedule', [TeachersController::class, 'schedule'])->name('teachers-scheduler');
Route::get('/teachers/assessments/evaluate/{id}', [TeachersController::class, 'evaluate']);
Route::post('/teachers/assessments/evaluate/{id}', [TeachersController::class, 'grade']);
Route::get('/teachers/assessments/results/{id}', [TeachersController::class, 'results']);

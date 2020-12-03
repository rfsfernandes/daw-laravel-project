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

Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'signin']);

//Students
Route::get('/students/', [StudentsController::class, 'index']);
Route::post('/students/', [StudentsController::class, 'register']);

//Teachers
Route::get('/teachers/', [TeachersController::class, 'index']);
Route::post('/teachers/schedule', [TeachersController::class, 'schedule']);
Route::get('/teachers/assessments/evaluate/{id}', [TeachersController::class, 'evaluate']);
Route::post('/teachers/assessments/evaluate/{id}', [TeachersController::class, 'grade']);
Route::get('/teachers/assessments/results/{id}', [TeachersController::class, 'results']);

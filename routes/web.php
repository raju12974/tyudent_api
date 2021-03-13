<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FakeData;
use \App\Http\Controllers\AttendanceController;
use \App\Http\Controllers\TestController;
use \App\Http\Controllers\HomeworkController;
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
    return view('welcome');
});

Route::prefix('fake')->group(function () {
    Route::get('/teachers', [FakeData::class, 'teachers']);
});

Route::get('/get/sections/{id}', [AttendanceController::class, 'get_sections']);
Route::get('get/students', [AttendanceController::class, 'get_students']);
Route::get('get/subjects', [AttendanceController::class, 'get_subjects']);
Route::get('get/tests', [TestController::class, 'get_tests']);
Route::get('get/homeworks', [HomeworkController::class, 'get_homeworks']);
Route::get('get/teacher/classes', [AttendanceController::class, 'get_teacher_sections']);

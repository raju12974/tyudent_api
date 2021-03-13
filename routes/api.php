<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get/sections/{id}', [AttendanceController::class, 'get_sections']);
Route::get('get/students', [AttendanceController::class, 'get_students']);
Route::get('get/subjects', [AttendanceController::class, 'get_subjects']);
Route::post('add/test', [TestController::class, 'add_test']);
Route::get('get/tests', [TestController::class, 'get_tests']);
Route::get('get/teacher/classes', [AttendanceController::class, 'get_teacher_sections']);
Route::get('get/homeworks', [HomeworkController::class, 'get_homeworks']);

<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['auth:sanctum', 'verified'])->group(function () {});
Route::apiResource('course', CourseController::class)->names('course')->only('store', 'update', 'destroy');
Route::apiResource('lesson', LessonController::class)->names('lesson');
Route::apiResource('assignment', AssignmentController::class)->names('assignment');
Route::apiResource('grade', GradeController::class)->names('grade');
Route::apiResource('enrollment', EnrollmentController::class)->names('enrollment');
Route::apiResource('quiz', QuizController::class)->names('quiz');

Route::apiResource('course', CourseController::class)->only(['index', 'show']);
Route::apiResource('lesson', LessonController::class)->names('lesson');

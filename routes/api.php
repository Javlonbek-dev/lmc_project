<?php

use App\{Http\Controllers\AssignmentController,
    Http\Controllers\CourseController,
    Http\Controllers\EnrollmentController,
    Http\Controllers\GradeController,
    Http\Controllers\LessonController,
    Http\Controllers\QuizController};

use Illuminate\Http\Request;
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
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

Route::apiResource('course', CourseController::class)->names('course')->only('store','update','destroy');
Route::apiResource('lesson', LessonController::class)->names('lesson');
Route::apiResource('assignment', AssignmentController::class)->names('assignment');
Route::apiResource('grade', GradeController::class)->names('grade');
Route::apiResource('enrollment', EnrollmentController::class)->names('enrollment');
Route::apiResource('quiz', QuizController::class)->names('quiz');

});
Route::apiResource('course', CourseController::class)->only(['index', 'show']);


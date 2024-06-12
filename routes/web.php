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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});
//Route::get('assignment.index',[AssignmentController::class, 'index'])->name('assignment.index');
//Route::get('enrollment.index',[EnrollmentController::class, 'index'])->name('enrollment.index');
//Route::get('lesson.index',[LessonController::class, 'index'])->name('lesson.index');
//Route::get('grade.index',[GradeController::class, 'index'])->name('grade.index');
//Route::get('quiz.index',[QuizController::class, 'index'])->name('quiz.index');
//Route::apiResource('course', CourseController::class)->names('course');
//


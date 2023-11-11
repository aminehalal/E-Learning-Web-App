<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/' , [StudentController::class , 'home']);
Route::get('/login' , [StudentController::class , 'loginPage']) -> name('login');
Route::post('/loginUser' , [StudentController::class , 'login']);
Route::get('/signup' , [StudentController::class , 'signupPage']);
Route::post('/store' , [StudentController::class , 'store']);

Route::post('/logout' , [StudentController::class , 'logout']);
Route::get('/profile/{username}' , [StudentController::class , 'find']);
Route::get('/courses' , [StudentController::class , 'allCourses']);
Route::get('/course/{id}' , [StudentController::class , 'courseView']);
Route::get('/course/{id}/watch' , [StudentController::class , 'courseWatch'])->middleware('auth');
Route::post('/course/{id}/markWatched' , [StudentController::class , 'courseMarkWatched'])->middleware('auth');
Route::post('/course/{id}/rate' , [StudentController::class , 'courseRate'])->middleware('auth');
Route::post('/course/{id}/comment' , [StudentController::class , 'courseComment'])->middleware('auth');

Route::get('/teacher' , [TeacherController::class , 'index']) ->middleware('isTeacher');
Route::get('/profile/{username}/becomeTeacher' , [TeacherController::class  , 'becomeTeacher'])->middleware('auth');
Route::post('/profile/{id}/becomeTeacherDemande' , [TeacherController::class  , 'becomeTeacherDemande'])->middleware('auth');
Route::get('/teacher/addCourse' , [TeacherController::class , 'addCourse'])->middleware('auth');
Route::post('/teacher/store' , [TeacherController::class , 'store'])->middleware('auth');
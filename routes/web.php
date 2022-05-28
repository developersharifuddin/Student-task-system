<?php

use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentResultController;
use App\Http\Controllers\Admin\SubjectController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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

 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
Route::group(['prefix'=>'admin', 'Middleware'=>'auth'], function(){
 
    //Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index' ])->name('admin.dashboard');
    Route::resource('student', StudentController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('student_result', StudentResultController::class);

   
});
 Route::get('/student/viewdata{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('student.views');
 
Route::get('admin/edit/{id}', [App\Http\Controllers\Admin\StudentviewController::class, 'view'])->name('sub.view');
 


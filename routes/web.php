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

Route::view('/test','admin.layouts.main');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users',[App\Http\Controllers\UserController::class, 'index'])->middleware('auth');

Route::get('/products/create',[App\Http\Controllers\ProductController::class, 'create']);
Route::post('/products/create',[App\Http\Controllers\ProductController::class, 'store']);

Route::get('/trainings',[App\Http\Controllers\TrainingController::class, 'index'])->name('training:list');
Route::get('/trainings/create',[App\Http\Controllers\TrainingController::class, 'create'])->name('training:create');
Route::post('/trainings/create',[App\Http\Controllers\TrainingController::class, 'store'])->name('training:store');
Route::get('/trainings/{training}',[App\Http\Controllers\TrainingController::class, 'show'])->name('trainings:show');
Route::get('/trainings/{training}/edit',[App\Http\Controllers\TrainingController::class, 'edit'])->name('trainings:edit');
Route::post('/trainings/{training}/edit',[App\Http\Controllers\TrainingController::class, 'update'])->name('trainings:update');
Route::get('/trainings/{training}/delete',[App\Http\Controllers\TrainingController::class, 'delete'])->name('trainings:delete');
Route::get('/trainings/{training}/force-delete',[App\Http\Controllers\TrainingController::class, 'forceDelete'])->name('trainings:forceDelete');

Route::get('/admin/audits',[App\Http\Controllers\AuditController::class, 'audit'])->middleware('auth','admin');

Route::get('/language/{locale}',[App\Http\Controllers\LocalizationController::class, 'changeLocale']);
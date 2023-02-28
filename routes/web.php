<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;

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

// Route::get('/practice', function () {
//     return response('practice');
// });

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

// Route::get('/admin/movies', [AdminMovieController::class, 'index']);
// Route::resource('admin/movies', AdminMovieController::class);
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');



// Route::prefix('admin/')->group(function (){
//     Route::resource('movies', AdminMovieController::class)->names([
//         'index' => 'admin.movies.index',
//         'create' => 'admin.movies.create',
//         'store' => 'admin.movies.store'
//     ]);
// });
// Route::prefix('admin')->group(function (){
//     Route::resource('/movies', AdminMovieController::class);
// });
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
Route::get('/admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
// patchはgetルーティングを取得しておかないと失敗する
Route::get('/admin/movies/{id}/update', [AdminMovieController::class, 'update']);
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::delete('/admin/movies/{id}/destroy',[AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');
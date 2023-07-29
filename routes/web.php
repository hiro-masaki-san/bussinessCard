<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/list', 'App\Http\Controllers\PersonManageController@index');
Route::post('/search', 'App\Http\Controllers\PersonManageController@search');
Route::get('/add', 'App\Http\Controllers\PersonManageController@displayAddPage');
Route::get('/edit/{pId}', 'App\Http\Controllers\PersonManageController@displayEditPage');
Route::post('/store', 'App\Http\Controllers\PersonManageController@store');
Route::post('/update', 'App\Http\Controllers\PersonManageController@update');
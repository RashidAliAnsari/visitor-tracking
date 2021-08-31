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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/profile1', 'App\Http\Controllers\ProfileController@profile1')->name('profile1');
Route::post('/sessionOut', 'App\Http\Controllers\ProfileController@sessionOut')->name('sessionOut');

Route::get('/history', 'App\Http\Controllers\ProfileController@history')->name('history');


Route::get('/commands', function () {
    \Artisan::call('migrate');
    \Artisan::call('config:cache');
});

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\ProfileController@land');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@profile')->name('profile');

Route::post('/sessionOut', 'App\Http\Controllers\ProfileController@sessionOut')->name('sessionOut');

Route::get('/profile/dashboard/{id}', 'App\Http\Controllers\ProfileController@dashboard');

Route::post('/ajax/record', 'App\Http\Controllers\ProfileController@ajaxRecord')->name('ajaxRecord');

// Route::get('/history', 'App\Http\Controllers\ProfileController@history')->name('history');


Route::get('/commands', function () {
    \Artisan::call('migrate:fresh');
    \Artisan::call('config:cache');
});

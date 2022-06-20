<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
Route::middleware(['auth', 'auth'])->group(function () {
  Route::get('/', '\App\Http\Controllers\Controller@app');
});


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
require __DIR__ . '/auth.php';

Route::get('/', '\App\Http\Controllers\Controller@index')->middleware(['auth']);

Route::get('/user', '\App\Http\Controllers\Controller@user');

Route::get('/uss', function () {
  return auth()->guard('web')->user();
});

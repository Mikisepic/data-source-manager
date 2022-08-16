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
  return view('layouts.app');
})->middleware(['auth'])->name('dashboard');

Route::get('/library', function () {
  return view('layouts.app');
})->middleware(['auth'])->name('library');

Route::get('/collections', function () {
  return view('layouts.app');
})->middleware(['auth'])->name('collections');

Route::get('/groups', function () {
  return view('layouts.app');
})->middleware(['auth'])->name('groups');

Route::get('/profile', function () {
  return view('layouts.app');
})->middleware(['auth'])->name('profile');

Route::get('/settings', function () {
  return view('layouts.app');
})->middleware(['auth'])->name('settings');

require __DIR__ . '/auth.php';

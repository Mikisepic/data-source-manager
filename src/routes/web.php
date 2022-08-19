<?php

use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\DataSourceController;
use App\Http\Controllers\API\GroupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Views/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/library', [DataSourceController::class, 'index'])->middleware(['auth', 'verified'])->name('libraryIndex');
Route::post('/library/new', [DataSourceController::class, 'store'])->middleware(['auth', 'verified'])->name('libraryStore');
Route::get('/library/{id}', [DataSourceController::class, 'show'])->middleware(['auth', 'verified'])->name('libraryShow');
Route::patch('/library/{id}', [DataSourceController::class, 'update'])->middleware(['auth', 'verified'])->name('libraryUpdate');
Route::delete('/library/{id}', [DataSourceController::class, 'destroy'])->middleware(['auth', 'verified'])->name('libraryDestroy');

Route::get('/collections', [CollectionController::class, 'index'])->middleware(['auth', 'verified'])->name('collections');
Route::get('/groups', [GroupController::class, 'index'])->middleware(['auth', 'verified'])->name('groups');

Route::get('/profile', function () {
  return Inertia::render('Views/Profile', [
    'data' => Auth::user()
  ]);
})->middleware(['auth', 'verified'])->name('profile');

Route::get('/settings', function () {
  return Inertia::render('Views/Settings');
})->middleware(['auth', 'verified'])->name('settings');

require __DIR__ . '/auth.php';

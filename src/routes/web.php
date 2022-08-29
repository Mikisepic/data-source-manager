<?php

use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

// Library
Route::get('/library', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryIndex');

Route::get('/library/{id}', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openPreviewDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryShow');

// Collections
Route::get('/collections', function () {
  return Inertia::render('Views/Collections/CollectionsIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collections');
Route::get('/collections/{id}', function () {
  return Inertia::render('Views/Collections/CollectionsIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collectionsShow');

// Groups
Route::get('/groups', [GroupController::class, 'index'])
  ->middleware(['auth', 'verified'])
  ->name('groupsIndex');
Route::get('/groups/{id}', [GroupController::class, 'show'])
  ->middleware(['auth', 'verified'])
  ->name('groupsShow');

// Profile
Route::get('/profile', [RegisteredUserController::class, 'show'])
  ->middleware(['auth', 'verified'])
  ->name('profileShow');
Route::patch('/profile', [RegisteredUserController::class, 'update'])
  ->middleware(['auth', 'verified'])
  ->name('profileUpdate');

Route::get('/settings', function () {
  return Inertia::render('Views/Settings');
})
  ->middleware(['auth', 'verified'])
  ->name('settings');

require __DIR__ . '/auth.php';

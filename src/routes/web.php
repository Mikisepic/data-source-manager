<?php

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
})
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

// Library
Route::get('/library', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryIndex');

Route::get('/library/{id}/preview', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openPreviewDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryPreview');

Route::get('/library/{id}/delete', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openDeleteConfirmationDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryDelete');

Route::get('/library/{id}/add_to_collection', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openAddToCollectionDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryAddToCollection');

Route::get('/library/{id}/share_with_group', function () {
  return Inertia::render('Views/Library/LibraryIndex', [
    'openShareWithGroupDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('libraryShareWithGroup');

// Collections
Route::get('/collections', function () {
  return Inertia::render('Views/Collections/CollectionsIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collectionIndex');

Route::get('/collections/{id}/preview', function () {
  return Inertia::render('Views/Collections/CollectionsIndex', [
    'openPreviewDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collectionPreview');

Route::get('/collections/{id}/delete', function () {
  return Inertia::render('Views/Collections/CollectionsIndex', [
    'openDeleteConfirmationDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collectionDelete');

Route::get('/collections/{id}', function () {
  return Inertia::render('Views/Collections/CollectionsShow');
})
  ->middleware(['auth', 'verified'])
  ->name('collectionShow');

Route::get('/collections/{id}/remove_from_collection/{dataSourceId}', function () {
  return Inertia::render('Views/Collections/CollectionsShow', [
    'openRemoveFromCollectionDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('collectionRemoveFromCollection');

// Groups
Route::get('/groups', function () {
  return Inertia::render('Views/Groups/GroupsIndex', [
    'openPreviewDialog' => false
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('groupIndex');

Route::get('/groups/{id}/preview', function () {
  return Inertia::render('Views/Groups/GroupsIndex', [
    'openPreviewDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('groupPreview');

Route::get('/groups/{id}/delete', function () {
  return Inertia::render('Views/Groups/GroupsIndex', [
    'openDeleteConfirmationDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('groupDelete');

Route::get('/groups/{id}', function () {
  return Inertia::render('Views/Groups/GroupsShow');
})
  ->middleware(['auth', 'verified'])
  ->name('groupShow');

Route::get('/groups/{id}/remove_from_group/{dataSourceId}', function () {
  return Inertia::render('Views/Groups/GroupsShow', [
    'openRemoveFromGroupDialog' => true
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('groupRemoveFromGroup');

// Profile
Route::get('/profile', function () {
  return Inertia::render('Views/Profile');
})
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

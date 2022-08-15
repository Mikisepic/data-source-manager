<?php

use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\DataSourceController;
use App\Http\Controllers\API\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::apiResource('data_sources', DataSourceController::class);
Route::apiResource('collections', CollectionController::class);
Route::apiResource('groups', GroupController::class);

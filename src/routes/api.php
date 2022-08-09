<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\ReferenceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LabelController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ShareController;

Route::apiResource('collections', CollectionController::class);
Route::apiResource('groups', GroupController::class);
Route::apiResource('references', ReferenceController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('favorites', FavoriteController::class);
Route::apiResource('labels', LabelController::class);
Route::apiResource('shares', ShareController::class);

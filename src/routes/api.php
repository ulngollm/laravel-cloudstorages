<?php

use Illuminate\Support\Facades\Route;
use Ully\Cloudstorages\Controllers\StorageController;
use Ully\Cloudstorages\Middleware\CheckStorageAccess;

//без middleware api не будет работать route-model binding


Route::get('/types', [StorageController::class, 'getTypeList']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/', [StorageController::class, 'addStorage']);
    Route::get('/', [StorageController::class, 'getList']);
});

Route::middleware(['auth:sanctum', CheckStorageAccess::class])
    ->group(function () {
        Route::get('{storage}', [StorageController::class, 'getStorage']);
        Route::patch('{storage}', [StorageController::class, 'renameStorage']);
        Route::delete('{storage}', [StorageController::class, 'deleteStorage']);
        Route::get('{storage}/files/folder', [StorageController::class, 'getFolderFiles']);
        Route::get('{storage}/files/{type}', [StorageController::class, 'filterByType']);
        Route::get('{storage}/files/', [StorageController::class, 'getFile']);
    });

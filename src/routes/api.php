<?php

use Illuminate\Support\Facades\Route;
use Ully\Cloudstorages\Controllers\StorageController;
use Ully\Cloudstorages\Middleware\CheckStorageAccess;

Route::middleware(['auth:sanctum', CheckStorageAccess::class])->group(function () {
    Route::get('/storages/{storage}', [StorageController::class, 'getStorage']);
    Route::patch('/storages/{storage}', [StorageController::class, 'renameStorage']);
    Route::delete('/storages/{storage}', [StorageController::class, 'deleteStorage']);
    Route::get('/storages/{storage}/files/folder', [StorageController::class, 'getFolderFiles']);
    Route::get('/storages/{storage}/files/{type}', [StorageController::class, 'filterByType']);
    Route::get('/storages/{storage}/files/', [StorageController::class, 'getFile']);
});

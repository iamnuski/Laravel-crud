<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get("product/create", [ProductController::class, 'create']);
Route::post("product/store", [ProductController::class, 'store']);
Route::get("product/{id}/show", [ProductController::class, 'show']);
Route::get("product/{id}/edit", [ProductController::class, 'edit']);
Route::put("product/{id}/update", [ProductController::class, 'update']);
Route::get("product/{id}/delete", [ProductController::class, 'destroy']);

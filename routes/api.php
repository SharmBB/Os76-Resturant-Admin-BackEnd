<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuSubcategoryController;

// --------------------
// ✅ Test Route
// --------------------
Route::get('/', function () {
    return response()->json(['message' => 'API is working ✅']);
});

// --------------------
// 🍔 Menu Item Routes
// --------------------
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
Route::post('/menu-items', [MenuItemController::class, 'store']);
Route::put('/menu-items/{id}', [MenuItemController::class, 'update']);
Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);

// --------------------
// 🍽️ Menu Category Routes
// --------------------
Route::get('/categories/test', function () {
    return response()->json(['message' => 'Category API working ✅']);
});
Route::get('/categories', [MenuCategoryController::class, 'index']);
Route::get('/categories/{id}', [MenuCategoryController::class, 'show']);
Route::post('/categories', [MenuCategoryController::class, 'store']);
Route::put('/categories/{id}', [MenuCategoryController::class, 'update']);
Route::delete('/categories/{id}', [MenuCategoryController::class, 'destroy']);

// --------------------
// 🍴 Menu Subcategory Routes
// --------------------
// Subcategory Routes


Route::get('/subcategories', [MenuSubcategoryController::class, 'index']);
Route::get('/subcategories/{id}', [MenuSubcategoryController::class, 'show']);
Route::post('/subcategories', [MenuSubcategoryController::class, 'store']);
Route::put('/subcategories/{id}', [MenuSubcategoryController::class, 'update']);
Route::delete('/subcategories/{id}', [MenuSubcategoryController::class, 'destroy']);
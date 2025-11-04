<?php

use App\Http\Controllers\InventoryConsumptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemOutletInventoryController;
use App\Http\Controllers\MenuManagementListController;
use App\Http\Controllers\MenuSubcategoryController;
use App\Http\Controllers\MenuVariantController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UnitMeasurementController;
use App\Models\InventoryConsumption;

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

// --------------------
// 🍱 Menu Variant Routes
// --------------------
Route::get('/variants/test', function () {
    return response()->json(['message' => 'Menu Variant API working ✅']);
});
Route::get('/variants', [MenuVariantController::class, 'index']);
Route::get('/variants/{id}', [MenuVariantController::class, 'show']);
Route::post('/variants', [MenuVariantController::class, 'store']);
Route::put('/variants/{id}', [MenuVariantController::class, 'update']);
Route::delete('/variants/{id}', [MenuVariantController::class, 'destroy']);

// --------------------
// 🚚 Order Items Routes
// --------------------
Route::get('/orderItems/test', function () {
    return response()->json(['message' => 'Order Items API working ✅']);
});
Route::get('/orderItems', [OrderItemController::class, 'index']);
Route::get('/orderItems/{id}', [OrderItemController::class, 'show']);
Route::post('/orderItems', [OrderItemController::class, 'store']);
Route::put('/orderItems/{id}', [OrderItemController::class, 'update']);
Route::delete('/orderItems/{id}', [OrderItemController::class, 'destroy']);

// --------------------
// 📃 Menu Management List Routes
// --------------------
Route::get('/menuList/test', function () {
    return response()->json(['message' => 'Menu Management List API working ✅']);
});
Route::get('/menuLists', [MenuManagementListController::class, 'index']);
Route::get('/menuLists/{id}', [MenuManagementListController::class, 'show']);
Route::post('/menuLists', [MenuManagementListController::class, 'store']);
Route::put('/menuLists/{id}', [MenuManagementListController::class, 'update']);
Route::delete('/menuLists/{id}', [MenuManagementListController::class, 'destroy']);

// --------------------
// 📦 Unit Measurement List Routes
// --------------------
Route::get('/menuList/test', function () {
    return response()->json(['message' => 'Unit Measurement List API working ✅']);
});
Route::get('/unit-measurements', [UnitMeasurementController::class, 'index']);
Route::get('/unit-measurements/{id}', [UnitMeasurementController::class, 'show']);
Route::post('/unit-measurements', [UnitMeasurementController::class, 'store']);
Route::put('/unit-measurements/{id}', [UnitMeasurementController::class, 'update']);
Route::delete('/unit-measurements/{id}', [UnitMeasurementController::class, 'destroy']);


// --------------------
// 📝 Inventory Management List Routes
// --------------------
Route::get('/inventories/test', function () {
    return response()->json(['message' => 'inventories List API working ✅']);
});
Route::get('/inventories', [MenuItemOutletInventoryController::class, 'index']);
Route::get('/inventories/{id}', [MenuItemOutletInventoryController::class, 'show']);
Route::post('/inventories', [MenuItemOutletInventoryController::class, 'store']);
Route::put('/inventories/{id}', [MenuItemOutletInventoryController::class, 'update']);
Route::delete('/inventories/{id}', [MenuItemOutletInventoryController::class, 'destroy']);

// --------------------
// 📝 Inventory Consumption List Routes
// --------------------
Route::get('/inventory-consumptions/test', function () {
    return response()->json(['message' => 'consumptions List API working ✅']);
});
Route::get('/inventory-consumptions', [InventoryConsumptionController::class, 'index']);
Route::get('/inventory-consumptions/{id}', [InventoryConsumptionController::class, 'show']);
Route::post('/inventory-consumptions', [InventoryConsumptionController::class, 'store']);
// route to get consumption by outlet
Route::post('/inventories-consumptions/showByOutlet', [InventoryConsumptionController::class, 'showByOutlet']);
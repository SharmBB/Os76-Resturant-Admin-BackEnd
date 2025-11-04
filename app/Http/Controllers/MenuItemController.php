<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuItemOutletInventory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MenuItemController extends Controller
{
    // ✅ Create new menu item
    public function store(Request $request)
    {
       try {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_visible' => 'boolean',
            'category_id' => 'required|exists:menu_categories,id',
            'subcategory_id' => 'nullable|exists:menu_subcategories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'type' => 'required|in:Veg,Non_veg',
            'product_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'track_inventory_enabled' => 'boolean',
            // Inventory fields
            'sku' => 'nullable|string|max:100',
            'available_quantity' => 'nullable|numeric|min:0',
            'allow_out_of_stock_sales' => 'nullable|boolean',
            'outlet_id' => 'required|exists:outlets,id',
        ]);
        
        $menuItem = MenuItem::create($validated);
        
        // Initialize inventory as null
        $inventory = null;

        if ($menuItem->track_inventory_enabled) {
            
            $inventory = MenuItemOutletInventory::create([
                'product_name' => $menuItem->name,
                'sku' => $validated['sku'] ?? null,
                'available_quantity' => $validated['available_quantity'] ?? 0,
                'allow_out_of_stock_sales' => $validated['allow_out_of_stock_sales'] ?? false,
                'menu_item_id' => $menuItem->id,
                'outlet_id' => $validated['outlet_id'], 
                'menu_variant_id' => null,
            ]);
        }
        
    
        // ✅ Return 201 Created
        return response()->json([
            'status' => 201,
            'message' => 'Menu item added successfully',
            'data' => [
                'menu_item' => $menuItem->fresh()->load('inventories'),
            ],
        ], 201);

       } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage(),
            ]);
        }
    }

    // ✏️ Update menu item
    public function update(Request $request, $id)
    {
        try {
            $menuItem = MenuItem::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'is_visible' => 'boolean',
                'category_id' => 'sometimes|exists:menu_categories,id',
                'subcategory_id' => 'nullable|exists:menu_subcategories,id',
                'price' => 'sometimes|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'type' => 'sometimes|in:Veg,Non_veg',
                'product_code' => 'nullable|string|max:100',
                'description' => 'nullable|string',
                'track_inventory_enabled' => 'sometimes|boolean',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'menu_variant_id' => 'nullable|exists:menu_variants,id',
                'outlet_id' => 'required|exists:outlets,id',
            ]);

            $menuItem->update($validated);

            $inventory = null;

            if ($menuItem->track_inventory_enabled) {
                // Try to find existing inventory record
                $inventory = MenuItemOutletInventory::where('menu_item_id', $menuItem->id)
                    ->where('outlet_id', $validated['outlet_id'])
                    ->first();

                if ($inventory) {
                    // Update existing inventory
                    $inventory->update([
                        'product_name' => $menuItem->name,
                        'sku' => $validated['sku'] ?? $inventory->sku,
                        'available_quantity' => $validated['available_quantity'] ?? $inventory->available_quantity,
                        'allow_out_of_stock_sales' => $validated['allow_out_of_stock_sales'] ?? $inventory->allow_out_of_stock_sales,
                    ]);
                } else {
                    // Create inventory if not found
                    $inventory = MenuItemOutletInventory::create([
                        'product_name' => $menuItem->name,
                        'sku' => $validated['sku'] ?? null,
                        'available_quantity' => $validated['available_quantity'] ?? 0,
                        'allow_out_of_stock_sales' => $validated['allow_out_of_stock_sales'] ?? false,
                        'menu_item_id' => $menuItem->id,
                        'outlet_id' => $validated['outlet_id'],
                        'menu_variant_id' => null,
                    ]);
                }
            } else {
                // If tracking is disabled, delete inventory record
                MenuItemOutletInventory::where('menu_item_id', $menuItem->id)
                    ->where('outlet_id', $validated['outlet_id'])
                    ->delete();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Menu item updated successfully',
                'data' => [
                    'menu_item' => $menuItem->fresh()->load('inventories'),
                ],
            ], 200);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating Product Item for inventory");
        }
    }

    // ❌ Delete menu item
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Menu item deleted successfully',
        ], 200);
    }

    // 📋 Get all menu items
    public function index()
    {
        $menuItems = MenuItem::with(['category', 'subcategory', 'variants'])->get();

        return response()->json([
            'status' => 200,
            'data' => [
                'menu_item' => $menuItems->fresh()->load('inventories'),
            ],
        ]);
    }

    // 🔍 Get single menu item
    public function show($id)
    {
        $menuItem = MenuItem::with(['category', 'subcategory', 'variants'])->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => [
                'menu_item' => $menuItem->fresh()->load('inventories'),
            ],
        ]);
    }

    // reusable private function for response

    // function 1
    private function validationErrorResponse(ValidationException $e)
    {
        return response()->json([
            'status' => 422,
            'errors' => $e->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    // function 2
    private function NotFoundResponse(ModelNotFoundException $e, $message = 'Not Found')
    {
        return response()->json([
            'status' => 404,
            'message' => $message . ': ' . $e->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }

    // function 3
    private function errorResponse(\Exception $e, $message = 'An error occurred')
    {
        return response()->json([
            'status' => 500,
            'message' => $message . ': ' . $e->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

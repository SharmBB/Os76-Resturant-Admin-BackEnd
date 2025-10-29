<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // ✅ Create new menu item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_visible' => 'boolean | default:true',
            'category_id' => 'required|exists:menu_categories,id',
            'subcategory_id' => 'nullable|exists:menu_subcategories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'type' => 'required|in:Veg,Non_veg',
            'product_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'track_inventory_enabled' => 'boolean',
        ]);

        $menuItem = MenuItem::create($validated);

        // ✅ Return 201 Created
        return response()->json([
            'status' => 201,
            'message' => 'Menu item added successfully',
            'data' => $menuItem,
        ], 201);
    }

    // ✏️ Update menu item
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'is_visible' => 'boolean | default:true',
            'category_id' => 'sometimes|exists:menu_categories,id',
            'subcategory_id' => 'nullable|exists:menu_subcategories,id',
            'price' => 'sometimes|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'type' => 'sometimes|in:Veg,Non_veg',
            'product_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'track_inventory_enabled' => 'boolean',
        ]);

        $menuItem->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Menu item updated successfully',
            'data' => $menuItem,
        ], 200);
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
            'data' => $menuItems,
        ]);
    }

    // 🔍 Get single menu item
    public function show($id)
    {
        $menuItem = MenuItem::with(['category', 'subcategory', 'variants'])->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $menuItem,
        ]);
    }
}

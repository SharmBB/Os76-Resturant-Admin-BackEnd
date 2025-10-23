<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    // 📋 List all categories
    public function index()
    {
        $categories = MenuCategory::with('subcategories')->get();

        return response()->json([
            'status' => 200,
            'data' => $categories,
        ]);
    }

    // 🔍 Show single category
    public function show($id)
    {
        $category = MenuCategory::with('subcategories')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $category,
        ]);
    }

    // ✅ Create new category with image
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menu_categories,name',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image
        ]);

        // Handle image upload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $filename);
            $validated['img'] = 'uploads/categories/' . $filename;
        }

        $category = MenuCategory::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    // ✏️ Update existing category with image
    public function update(Request $request, $id)
    {
        $category = MenuCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:menu_categories,name,' . $id,
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $filename);
            $validated['img'] = 'uploads/categories/' . $filename;
        }

        $category->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    // ❌ Delete category
    public function destroy($id)
    {
        $category = MenuCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MenuSubcategory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MenuSubcategoryController extends Controller
{
    // List all subcategories
    public function index()
    {
        try {
            $subcategories = MenuSubcategory::with('category')->get();

            return response()->json([
                'status' => 200,
                'data' => $subcategories,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    // Show single subcategory
    public function show($id)
    {
        try {
            $subcategory = MenuSubcategory::with('category')->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $subcategory,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, "Subcategory not found");
        }
    }

    // Create new subcategory with image
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:menu_subcategories,name',
                'category_id' => 'required|exists:menu_categories,id',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/subcategories'), $filename);
                $validated['img'] = 'uploads/subcategories/' . $filename;
            }

            $subcategory = MenuSubcategory::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Subcategory created successfully',
                'data' => $subcategory,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return $this->errorResponse($e, "Failed to create subcategory");
        }
    }

    // Update subcategory with optional image upload
    public function update(Request $request, $id)
    {
        try {
            $subcategory = MenuSubcategory::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255|unique:menu_subcategories,name,' . $id,
                'category_id' => 'sometimes|exists:menu_categories,id',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/subcategories'), $filename);
                $validated['img'] = 'uploads/subcategories/' . $filename;
            }

            $subcategory->update($validated);

            return response()->json([
                'status' => 200,
                'message' => 'Subcategory updated successfully',
                'data' => $subcategory,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return $this->errorResponse($e, "Failed to update subcategory");
        }
    }

    // Delete subcategory
    public function destroy($id)
    {
        try {
            $subcategory = MenuSubcategory::findOrFail($id);
            $subcategory->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Subcategory deleted successfully',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "Failed to delete subcategory");
        }
    }

    // Centralized error response
    private function errorResponse($e, $customMessage = "An error occurred")
    {
        if ($e instanceof QueryException) {
            $message = $e->getMessage();
        } else {
            $message = $customMessage;
        }

        return response()->json([
            'status' => 500,
            'message' => $message,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

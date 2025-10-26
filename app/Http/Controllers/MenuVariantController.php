<?php

namespace App\Http\Controllers;

use App\Models\MenuVariant;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MenuVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $variant = MenuVariant::with('menuItem')->get();

            return response()->json([
                'status' => 200,
                'data' => $variant
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
             return $this->errorResponse($e, "An error occurred");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'menu_item_id' => 'required|exists:menu_items,id',
                'variant_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'track_inventory_enabled' => 'required|boolean',
                'variant_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('variant_img')) {
                $file = $request->file('variant_img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/variant'), $filename);
                $validated['variant_img'] = 'uploads/variant/' . $filename;
            }

            $variant = MenuVariant::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'variant created successfully',
                'data' => $variant,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e){
            return $this->validationErrorResponse($e);

        }catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating variant");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $variant = MenuVariant::with('menuItem')->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $variant,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " variant Not Found");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $variant = MenuVariant::with('menuItem')->findOrFail($id);

            $validated = $request->validate([
                'menu_item_id' => 'required|exists:menu_items,id',
                'variant_name' => 'required|string|max:255|unique:menu_variants,variant_name',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'track_inventory_enabled' => 'required|boolean',
                'variant_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('variant_img')) {
                $file = $request->file('variant_img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/variant'), $filename);
                $validated['variant_img'] = 'uploads/variant/' . $filename;
            }

            $variant->update($validated);

            return response()->json([
                'status' => 200,
                'message' => 'variant update successfully',
                'data' => $variant,
            ], Response::HTTP_OK);

        } catch (ValidationException $e) {
           return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While updating variant");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $variant = MenuVariant::findOrFail($id);

            // Delete associated image file if exists
            if ($variant->variant_img && file_exists(public_path($variant->variant_img))) {
                unlink(public_path($variant->variant_img));
            }

            $variant->delete();

            return response()->json([
                'status' => 200,
                'message' => 'variant deleted successfully',
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " variant Not Found");

        } catch (Exception $e) {
            return $this->errorResponse($e, " Failed to delete Variant");
        }
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

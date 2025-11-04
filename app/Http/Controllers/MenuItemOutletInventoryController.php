<?php

namespace App\Http\Controllers;

use App\Models\MenuItemOutletInventory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MenuItemOutletInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $inventories = MenuItemOutletInventory::with(['menuItem', 'variant', 'outlet'])->get();

            return response()->json([
                'status' => 200,
                'data' => $inventories
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
             return $this->errorResponse($e, "An error occurred");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'nullable|exists:outlets,id',
            ]);

            // Set default outlet_id if not provided
            $validated['outlet_id'] = $validated['outlet_id'] ?? 1;

            $inventory = MenuItemOutletInventory::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Product Item created successfully for inventory',
                'data' => $inventory,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating Product Item for inventory");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $inventories = MenuItemOutletInventory::with(['menuItem', 'variant', 'outlet'])->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $inventories
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
             return $this->errorResponse($e, "An error occurred");
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

            $inventory = MenuItemOutletInventory::with(['menuItem', 'variant', 'outlet'])->findOrFail($id);

            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'nullable|exists:outlets,id',
            ]);

            // Set default outlet_id if not provided
            $validated['outlet_id'] = $validated['outlet_id'] ?? 1;

            $inventory->update($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Product Item Updated successfully for inventory',
                'data' => $inventory,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While updating Product Item for inventory");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $inventory = MenuItemOutletInventory::findOrFail($id);
            $inventory->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Product Item deleted successfully',
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " Product Item Not Found");

        } catch (\Exception $e) {
            return $this->errorResponse($e, " Failed to delete Product Item");
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

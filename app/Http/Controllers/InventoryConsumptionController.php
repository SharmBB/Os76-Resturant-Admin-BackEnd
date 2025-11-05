<?php

namespace App\Http\Controllers;

use App\Models\InventoryConsumption;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class InventoryConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $consumptions = InventoryConsumption::all();

            return response()->json([
                'status' => 200,
                'data' => $consumptions,
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
                'consumed_quantity' => 'required|numeric|min:0',
                'remark' => 'nullable|string|max:255',
                'menu_item_outlet_inventory_id' => 'required|exists:menu_item_outlet_inventories,id',
                'outlet_id' => 'required|exists:outlets,id',
            ]);

            $consumption = InventoryConsumption::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Inventory consumption recorded successfully',
                'data' => $consumption,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "Failed to record inventory consumption");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $consumptions = InventoryConsumption::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => [
                    'consumptions' => $consumptions->fresh()->load('inventory'),
                ],
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
             return $this->errorResponse($e, "An error occurred");
        }
    }

    // show products items by outlet id
   public function showByOutlet(Request $request)
    {
        try {
            $validated = $request->validate([
                'outlet_id' => 'required|exists:outlets,id',
            ]);

            // Get all consumption records with inventory for the given outlet
            $consumptions = InventoryConsumption::with('inventory')
                ->where('outlet_id', $validated['outlet_id'])
                ->get();

            // Extract only the inventory details
            $inventoryDetails = $consumptions->pluck('inventory')->filter()->values();

            return response()->json([
                'status' => 200,
                'message' => 'Outlet product items retrieved successfully',
                'data' => $inventoryDetails,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return $this->errorResponse($e, 'Failed to load outlet product items');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

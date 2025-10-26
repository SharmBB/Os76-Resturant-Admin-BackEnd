<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orderItem = OrderItem::with('order')->get();

            return response()->json([
                'status' => 200,
                'data' => $orderItem
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
                'item_name' => 'required|string|max:255',
                'qty' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
                'order_id' => 'required|exists:orders,id',
            ]);

            $orderItem = OrderItem::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Order Item created successfully',
                'data' => $orderItem,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating variant");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $orderItem = OrderItem::with('order')->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $orderItem,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " Order Item Not Found");

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating variant");
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

            $orderItem = OrderItem::findOrFail($id);

            $validated = $request->validate([
                'item_name' => 'required|string|max:255',
                'qty' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
                'order_id' => 'required|exists:orders,id',
            ]);

            $orderItem->update($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Order Item updated successfully',
                'data' => $orderItem,
            ], Response::HTTP_CREATED);

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
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Order Item deleted successfully',
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " Order Item Not Found");

        } catch (Exception $e) {
            return $this->errorResponse($e, " Failed to delete Order Item");
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

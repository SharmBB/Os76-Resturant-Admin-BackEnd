<?php

namespace App\Http\Controllers;

use App\Models\UnitMeasurement;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UnitMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $measurements = UnitMeasurement::all();

            return response()->json([
                'status' => 200,
                'data' => $measurements
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
                'measurement_name' => 'required|string|max:255',
            ]);

            $measurement = UnitMeasurement::create($validated);

            return response()->json([
                'status' => 201,
                'message' => 'Unit Measurement created successfully',
                'data' => $measurement,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating measurement");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $measurement = UnitMeasurement::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $measurement,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " measurement Not Found");

        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While showing measurement");
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

            $measurement = UnitMeasurement::findOrFail($id);

            $validated = $request->validate([
                'measurement_name' => 'required|string|max:255',
            ]);

            $measurement->update($validated);

            return response()->json([
                'status' => 200,
                'message' => 'Unit Measurement updated successfully',
                'data' => $measurement,
            ], Response::HTTP_OK);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e);
            
        } catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating measurement");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $measurement = UnitMeasurement::findOrFail($id);
            $measurement->delete();

            return response()->json([
                'status' => 200,
                'message' => 'measurement deleted successfully',
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " measurement Not Found");

        } catch (\Exception $e) {
            return $this->errorResponse($e, " Failed to delete measurement");
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

<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuManagementList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MenuManagementListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // GET all menu lists with items and outlets
            $menuList = MenuManagementList::with(['menuItems', 'outlets'])->get();
             
            return response()->json([
                'status' => 200,
                'data' => $menuList
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
                'name' => 'required|string|max:255',
                'menu_item_ids' => 'required|array',
                'menu_item_ids.*' => 'exists:menu_items,id',
                'outlet_ids' => 'required|array',
                'outlet_ids.*' => 'exists:outlets,id',
            ]);

            // Create new Menu Management List
            $menuList = MenuManagementList::create([
                'name' => $validated['name'],
            ]);

            // Saves the relationship in the pivot table (menu_list_menu_items table)
            $menuList->menuItems()->attach($validated['menu_item_ids']);
            // Saves the relationship in the pivot table (menu_list_outlets table)
            $menuList->outlets()->attach($validated['outlet_ids']);

            // loads the related data immediately after creation
            $menuList->load(['menuItems', 'outlets']);

            return response()->json([
                'status' => 201,
                'message' => 'Menu List created and menu items and outlets assigned successfully',
                'data' => $menuList,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e){
            return $this->validationErrorResponse($e);

        }catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating Menu Managemen List");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $menuList = MenuManagementList::with(['menuItems','outlets'])->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $menuList,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return $this->NotFoundResponse($e, " Menu Management List Not Found");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuManagementList $menuManagementList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'menu_item_ids' => 'required|array',
            'menu_item_ids.*' => 'exists:menu_items,id',
            'outlet_ids' => 'required|array',
            'outlet_ids.*' => 'exists:outlets,id',
        ]);

        // Find the Menu Management List
        $menuList = MenuManagementList::findOrFail($id);

        $menuList->update([
            'name' => $validated['name'],
        ]);

        // Sync relationships (this updates pivot tables)
        $menuList->menuItems()->sync($validated['menu_item_ids']);
        $menuList->outlets()->sync($validated['outlet_ids']);

        $menuList->load(['menuItems', 'outlets']);

        return response()->json([
            'status' => 200,
            'message' => 'Menu List updated successfully with menu items and outlets',
            'data' => $menuList,
        ], Response::HTTP_OK);

        } catch (ValidationException $e){
            return $this->validationErrorResponse($e);

        }catch (\Exception $e) {
            return $this->errorResponse($e, "An error occurred While creating Menu Managemen List");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $menuList = MenuManagementList::findOrFail($id);
        $menuList->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Menu List Item deleted successfully'
        ], Response::HTTP_OK);

    } catch (ModelNotFoundException $e) {
        return $this->NotFoundResponse($e, "Menu List Item Not Found");

    } catch (\Exception $e) {
        return $this->errorResponse($e, "An error occurred while deleting Menu List Item");
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

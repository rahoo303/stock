<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

    }

    public function getItemMaster()
    {
        $items = Item::all();
        return response()->json([
            'items' => $items,
        ], 200);
    }

    public function searchItem(Request $request)
    {
        $name = $request->get('s');
        if (!empty($name)) {
            $items = Item::where('name', 'like', "%".$name."%")->get();
            return response()->json([
                'items' => $items,
            ], 200);
        } else {
            return $this->index();
        }
       
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        Item::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
        ]);

        return response()->json([
            'message' => 'Item created',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Item::where('id', $id)->first();

        return response()->json([
            'data' => $data,
        ], 200);
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
        
    }
}

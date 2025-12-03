<?php

namespace App\Http\Controllers;

use App\Models\ItemInformation;
use Illuminate\Http\Request;

class ItemInformationController extends Controller
{
    public function store(Request $request)
    {
        $addItem = ItemInformation::create([
            "ItemId" => $request->ItemId,
            "Size" => $request->Size,
            "Quantity" => $request->Quantity
        ]);
        if ($addItem) {
            return response()->json(["message" => "you are added new Item"], 201);
        } else {
            return response()->json(["message" => "Item creation failed"], 404);
        }
    }
    public function show($InfoId)
    {
        $getItemById = ItemInformation::findOrFail($InfoId);
        if (!$getItemById) {
            return response()->json(["message" => "Item not found"], 404);
        } else {
            return response()->json($getItemById, 200);
        }
    }
    public function showAllItmes(){
        $getAllItems = ItemInformation::all();
        if ( !$getAllItems ) {
            return response()->json(["message" => "No Item found"], 404);
        }
        return response()->json( $getAllItems , 200);
    }
    public function update (Request $request , $InfoId)
    {
        $getItemById = ItemInformation::findOrFail($InfoId);
        if ( !$getItemById ) {
            return response()->json(["message" => "Item not found"], 404);
        }
        else {
            $getItemById->update([
                $getItemById->ItemId = $request->ItemId === null ? $getItemById->ItemId : $request->ItemId,
                $getItemById->Size = $request->Size === null ? $getItemById->Size : $request->Size,
                $getItemById->Quantity = $request->Quantity === null ? $getItemById->Quantity : $request->Quantity,
            ]);
            return response()->json(["message"=>"you are updated Item"] , 200); 
        }
    }

    public function destroy ( $InfoId) {
        $getItemById = ItemInformation::findOrFail($InfoId);
        if ( !$getItemById ) {
            return response()->json(["message"=>"The Item not found"] , 404);
        }
        else {
            $getItemById->delete(); 
            return response()->json(["message"=>"you are deleted Item"] , 200);
        }
    }

    public function showByItemId($ItemId)
    {
        $getItemInfoByItemId = ItemInformation::where('ItemId', $ItemId)->get();
        if (!$getItemInfoByItemId) {
            return response()->json(["message" => "Item Information not found"], 404);
        } else {
            return response()->json($getItemInfoByItemId, 200);
        }
    }
}

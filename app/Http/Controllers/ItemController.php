<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function stroe(Request $request)
    {
        $addItem = Item::create([
            "ItemName" => $request->ItemName,
            "ItemDescription" => $request->ItemDescription,
            "ItemPrice" => $request->ItemPrice,
            "ItemColor" => $request->ItemColor,
            "CategoryId" => $request->CategoryId,
            "ChildCategoryId" => $request->ChildCategoryId
        ]);
        if ($addItem) {
            return response()->json(["message" => "you are added new Item"], 201);
        } else {
            return response()->json(["message" => "Item creation failed"], 404);
        }
    }
    public function show($ItemId)
    {
        $getItemById = Item::findOrFail($ItemId);
        if (!$getItemById) {
            return response()->json(["message" => "Item not found"], 404);
        } else {
            return response()->json($getItemById, 200);
        }
    }
    public function showAllItmes(){
        $getAllItems = Item::all();
        if ( !$getAllItems ) {
            return response()->json(["message" => "No Item found"], 404);
        }
        return response()->json( $getAllItems , 200);
    }
    public function update (Request $request , $ItemId)
    {
        $getItemById = Item::findOrFail($ItemId);
        if ( !$getItemById ) {
            return response()->json(["message" => "Item not found"], 404);
        }
        else {
            $getItemById->update([
                $getItemById->ItemName = $request->ItemName === null ? $getItemById->ItemName : $request->ItemName,
                $getItemById->ItemDescription = $request->ItemDescription === null ? $getItemById->ItemDescription : $request->ItemDescription,
                $getItemById->ItemPrice = $request->ItemPrice === null ? $getItemById->ItemPrice : $request->ItemPrice,
                $getItemById->ItemColor = $request->ItemColor === null ? $getItemById->ItemColor : $request->ItemColor,     
                $getItemById->CategoryId = $request->CategoryId === null ? $getItemById->CategoryId : $request->CategoryId,
                $getItemById->ChildCategoryId = $request->ChildCategoryId === null ? $getItemById->ChildCategoryId : $request->ChildCategoryId,
            ]);
            return response()->json(["message"=>"you are updated Item"] , 200); 
        }
    }

    public function destroy ( $ItemId) {
        $getItemById = Item::findOrFail($ItemId);
        if ( !$getItemById ) {
            return response()->json(["message"=>"The Item not found"] , 404);
        }
        else {
            $getItemById->delete(); 
            return response()->json(["message"=>"you are deleted Item"] , 200);
        }
    }
}

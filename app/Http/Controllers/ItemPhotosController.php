<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhotos;
use Illuminate\Http\Request;

class ItemPhotosController extends Controller
{
    public function store(Request $request)
    {
        $getItem = Item::where("ItemId" , $request->ItemId)->first();
        if ( !$getItem) {
            return response()->json(["message"=>"Fiald to add because the item not define"],404);
        }
        else {
            $addItem = ItemPhotos::create([
                "ItemId" => $request->ItemId,
                "PhotoUrl" => $request->PhotoUrl,
            ]);
            if ($addItem) {
                return response()->json(["message" => "you are added new Item"], 201);
            } else {
                return response()->json(["message" => "Item creation failed"], 404);
            }
        }
    }
    public function show($PhotoId)
    {
        $getItemById = ItemPhotos::where("PhotoId",$PhotoId)->first();
        if ($getItemById) {
            return response()->json($getItemById, 200);
        } else {
            return response()->json(["message" => "Item not found"], 404);
        }
    }
    public function showAllItmes(){
        $getAllItems = ItemPhotos::all();
        if ( !$getAllItems ) {
            return response()->json(["message" => "No Item found"], 404);
        }
        return response()->json( $getAllItems , 200);
    }
    public function update (Request $request , $PhotoId)
    {   
        $getItem = Item::where("ItemId" , $request->ItemId)->first();
        if ( !$getItem) {
            return response()->json(["message"=>"Fiald to add because the item not define"],404);
        }
        else {
            $getItemById = ItemPhotos::where("PhotoId",$PhotoId)->first();
            if ( !$getItemById ) {
                return response()->json(["message" => "Item not found"], 404);
            }
            else {
                $getItemById->update([
                    $getItemById->ItemId = $request->ItemId === null ? $getItemById->ItemId : $request->ItemId,
                    $getItemById->PhotoUrl = $request->PhotoUrl === null ? $getItemById->PhotoUrl : $request->PhotoUrl,
                ]);
                return response()->json(["message"=>"you are updated Item"] , 200); 
            }
        }

    }

    public function destroy ( $PhotoId) {
        $getItemById = ItemPhotos::where("PhotoId",$PhotoId)->first();
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
        $getItemInfoByItemId = ItemPhotos::where('ItemId', $ItemId)->get();
        if (!$getItemInfoByItemId) {
            return response()->json(["message" => "Item Information not found"], 404);
        } else {
            return response()->json($getItemInfoByItemId, 200);
        }
    }

}

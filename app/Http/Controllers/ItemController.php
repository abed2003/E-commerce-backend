<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ChildCategories;
use App\Models\Item;
use App\Models\ItemInformation;
use App\Models\ItemPhotos;
use App\Models\Order;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function stroe(Request $request)
    {
        $getCategory = Categories::where("CategoryId",$request->CategoryId)->first();
        $getChildCategory = ChildCategories::where("CategoryId",$request->ChildCategoryId)->first();

        if (!$getCategory || !$getChildCategory) {
            return response()->json(["message" => "The Category or Child Category or both not found"],
        404);
        }
        else {
            $valedationItem = $request->validate([
                "ItemName" => "required|string|max:255",
                "ItemDescription" => "required|string",
                "ItemPrice" => "required|numeric",
                "ItemColor" => "required|string|max:100",
                "CategoryId" => "required|integer",
                "ChildCategoryId" => "required|integer",
            ]);
            $addItem = Item::create([
                "ItemName" => $valedationItem["ItemName"],
                "ItemDescription" => $valedationItem["ItemDescription"],
                "ItemPrice" => $valedationItem["ItemPrice"],
                "ItemColor" => $valedationItem["ItemColor"],
                "CategoryId" => $valedationItem["CategoryId"],
                "ChildCategoryId" => $valedationItem["ChildCategoryId"],
            ]);
            if ($addItem) {
                return response()->json(["message" => "you are added new Item"], 201);
            } else {
                return response()->json(["message" => "Item creation failed"], 404);
            }
        }
    }
    public function show($ItemId)
    {
        $getItemById = Item::where("ItemId", $ItemId)->first();
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
        $getItemById = Item::where("ItemId",$ItemId)->first();
         $getCategory = Categories::where("CategoryId",$request->CategoryId)->first();
        $getChildCategory = ChildCategories::where("CategoryId",$request->ChildCategoryId)->first();

        if (!$getCategory || !$getChildCategory) {
            return response()->json(["message" => "The Category or Child Category or both not found"],
        404);
        }
        else { 
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
    }

    public function destroy ( $ItemId) {
        $getItemById = Item::where("ItemId",$ItemId)->first();
        if ( !$getItemById ) {
            return response()->json(["message"=> "The Item not found"] , 404);
        }
        else {
            $valedationForDeleteItemFromItemPhotosModel = ItemPhotos::where("ItemId",$ItemId)->exists();
            $valedationForDeleteItemFromItemInformationModel = ItemInformation::where("ItemId",$ItemId)->exists();
            $valedationForDeleteItemFromOrderModel = Order::where("ItemId",$ItemId)->exists();
            if ( $valedationForDeleteItemFromItemInformationModel || $valedationForDeleteItemFromItemPhotosModel
            || $valedationForDeleteItemFromOrderModel) {
                return response()->json(["message"=> "you didn't delete this item becuse it is related whith other table"] , 404);
            }
            else { 
                $getItemById->delete(); 
                return response()->json(["message"=>"you are delete item "] , 200);
                
            }
        }
    }
}   

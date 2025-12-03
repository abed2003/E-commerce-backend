<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function store(Request $request)
    {
        $addOrder = OrderList::create([
            "OrderId"=>$request->OrderId,
            "ItemId"=>$request->ItemId,
            "Quantity"=>$request->Quantity,
            "ItemPrice"=>$request->ItemPrice,
            "Size"=>$request->Size
        ]);
        if ($addOrder) {
            return response()->json(["message" => "you are added new Order"], 201);
        } else {
            return response()->json(["message" => "Order creation failed"], 404);
        }
    }
    public function show($OrderListId)
    {
        $getOrderById = OrderList::findOrFail($OrderListId);
        if (!$getOrderById) {
            return response()->json(["message" => "Order not found"], 404);
        } else {
            return response()->json($getOrderById, 200);
        }
    }
    public function showAllOrder(){
        $getOrderById = OrderList::all();
        if ( !$getOrderById ) {
            return response()->json(["message" => "No Order found"], 404);
        }
        return response()->json( $getOrderById , 200);
    }
    public function update (Request $request , $OrderListId)
    {
        $getOrderById = OrderList::findOrFail($OrderListId);
        if ( !$getOrderById ) {
            return response()->json(["message" => "Order not found"], 404);
        }
        else {
            $getOrderById->update([
                $getOrderById->OrderId = $request->OrderId === null ? $getOrderById->OrderId : $request->OrderId,
                $getOrderById->ItemId = $request->ItemId === null ? $getOrderById->ItemId : $request->ItemId,
                $getOrderById->Quantity = $request->Quantity === null ? $getOrderById->Quantity : $request->Quantity,        
                $getOrderById->ItemPrice = $request->ItemPrice === null ? $getOrderById->ItemPrice : $request->ItemPrice,        
                $getOrderById->Size = $request->Size === null ? $getOrderById->Size : $request->Size,        
            ]);
            return response()->json(["message"=>"you are updated Order"] , 200); 
        }
    }

    public function destroy ( $OrderListId) {
        $getOrderById = OrderList::findOrFail($OrderListId);
        if ( !$getOrderById ) {
            return response()->json(["message"=>"The Order not found"] , 404);
        }
        else {
            $getOrderById->delete(); 
            return response()->json(["message"=>"you are deleted Order"] , 200);
        }
    }
}

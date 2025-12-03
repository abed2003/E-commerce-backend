<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $addOrder = Order::create([
            "UserId"=>$request->UserId
            ,"ItemId"=>$request->ItemId
            ,"FullName"=>$request->FullName
            ,"Phone"=>$request->Phone
            ,"Email"=>$request->Email
            ,"cityId"=>$request->cityId
            ,"addressId"=>$request->addressId
            ,"street"=>$request->street
            ,"OrderDate"=>new \DateTime()
            ,"PriceDelevery"=>$request->PriceDelevery
            ,"ProductPrice"=>$request->ProductPrice
            ,"TotalAmount"=>$request->TotalAmount
            ,"Status"=>$request->Status
            ,"Note"=>$request->Note
        ]);
        if ($addOrder) {
            return response()->json(["message" => "you are added new Item"], 201);
        } else {
            return response()->json(["message" => "Item creation failed"], 404);
        }
    }
    public function show($OrderId)
    {
        $getOrderById = Order::findOrFail($OrderId);
        if (!$getOrderById) {
            return response()->json(["message" => "Item not found"], 404);
        } else {
            return response()->json($getOrderById, 200);
        }
    }
    public function showAllOrder(){
        $getOrderById = Order::all();
        if ( !$getOrderById ) {
            return response()->json(["message" => "No Item found"], 404);
        }
        return response()->json( $getOrderById , 200);
    }
    public function update (Request $request , $OrderId)
    {
        $getOrderById = Order::findOrFail($OrderId);
        if ( !$getOrderById ) {
            return response()->json(["message" => "Item not found"], 404);
        }
        else {
            $getOrderById->update([
                $getOrderById->UserId = $request->UserId === null ? $getOrderById->UserId : $request->UserId,
                $getOrderById->ItemId = $request->ItemId === null ? $getOrderById->ItemId : $request->ItemId,
                $getOrderById->FullName = $request->FullName === null ? $getOrderById->FullName : $request->FullName,
                $getOrderById->Phone = $request->Phone === null ? $getOrderById->Phone : $request->Phone,
                $getOrderById->Email = $request->Email === null ? $getOrderById->Email : $request->Email,
                $getOrderById->cityId = $request->cityId === null ? $getOrderById->cityId : $request->cityId,
                $getOrderById->addressId = $request->addressId === null ? $getOrderById->addressId : $request->addressId,   
                $getOrderById->street = $request->street === null ? $getOrderById->street : $request->street,   
                // $getOrderById->cityId = $request->cityId === null ? $getOrderById->cityId : $request->cityId,   
                // $getOrderById->addressId = $request->addressId === null ? $getOrderById->addressId : $request->addressId,   
                $getOrderById->OrderDate = $request->OrderDate === null ? $getOrderById->OrderDate : $request->OrderDate,   
                $getOrderById->PriceDelevery = $request->PriceDelevery === null ? $getOrderById->PriceDelevery : $request->PriceDelevery,   
                $getOrderById->ProductPrice = $request->ProductPrice === null ? $getOrderById->ProductPrice : $request->ProductPrice,   
                $getOrderById->TotalAmount = $request->TotalAmount === null ? $getOrderById->TotalAmount : $request->TotalAmount,   
                $getOrderById->Status = $request->Status === null ? $getOrderById->Status : $request->Status,   
                $getOrderById->Note = $request->Note === null ? $getOrderById->Note : $request->Note,                   
            ]);
            return response()->json(["message"=>"you are updated Item"] , 200); 
        }
    }

    public function destroy ( $OrderId) {
        $getOrderById = Order::findOrFail($OrderId);
        if ( !$getOrderById ) {
            return response()->json(["message"=>"The Item not found"] , 404);
        }
        else {
            $getOrderById->delete(); 
            return response()->json(["message"=>"you are deleted Item"] , 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    function store(Request $request)
    {
        if ($request->street !== null && $request->cityId !== null) {
            $AddAddress = Address::create([
                "street" => $request->street,
                "cityId" => $request->cityId,
            ]);

            $result = $AddAddress->save();
            return response()->json(["message"=>"you are added new Address"], 201);
            
        }
    }

    function show ($addressId) {
        $getAddressById = Address::findOrFail($addressId);
        if ( !$getAddressById ) {
            return response()->json(["message" => "Address not found"], 404);
        }
        else { 
            return response()->json( $getAddressById , 200);
        }
    }

    function showAllAddress (){
        $getAllAddress = Address::all();
        if ( !$getAllAddress ) {
            return response()->json(["message" => "No Address found"], 404);
        }
        return response()->json( $getAllAddress , 200);
    }
    function showAddressByCityId ($cityId ){
        $getAddressByCityId = Address::where('cityId', $cityId)->get();
        if ( !$getAddressByCityId ) {
            return response()->json(["message" => "Address not found"], 404);
        }
        else {
            return response()->json( $getAddressByCityId , 200);
        }
    }

    function update (Request $request, $addressId ){
        $getAddress = Address::findOrFail($addressId);
        if ( !$getAddress ) {
            return response()->json(["message" => "Address not found"], 404);
        }
        else {
            $getAddress->update([
                $getAddress->street = $request->street === null ? $getAddress->street : $request->street,
                $getAddress->cityId = $request->cityId === null ? $getAddress->cityId : $request->cityId,
            ]);
            return response()->json(["message" => "Successfully update"] , 200);
        }
    }
    
    function deleteAddress ($addressId){
        $getAddress = Address::findOrFail($addressId);
        if ( !$getAddress ) {
            return response()->json(["message" => "Address not found"], 404);
        }
        else {
            $getAddress->delete();
            return response()->json(["message" => "Address deleted successfully"], 200);
        }
    }
}

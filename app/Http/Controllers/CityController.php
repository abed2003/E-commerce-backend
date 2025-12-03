<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function store(Request $request){
        if ( $request->cityName !== null && $request->deliveryFees !== null ) {
            $AddCity = Cities::create([
            "cityName"=> $request->cityName,
            "deliveryFees"=> $request->deliveryFees,
            ]);
            
            return response()->json( $AddCity, 201) ;
            // return response()->json(["message"=> "City created successfully"] , 201);
        } 
        else {
            return response()->json(["message"=> "City creation failed"] , 500);
        }
    }

    function delete ($id ){
        $deleteCity = Cities::where('cityId', $id)->first();
        if ( !$deleteCity ) {
            return response()->json(["message" => "City not found"], 404);
        }
        else {
            $deleteCity->delete();
            return response()->json(["message" => "City deleted successfully"], 200);
        }
    }

    function getAllCities (){
        $AllCities = Cities::all();
        if ( !$AllCities ) {
            return response()->json(["message" => "No cities found"], 404);
        }
        return response()->json( $AllCities , 200);
    }

    function show ($id ){
        $getCityById = Cities::where('cityId', $id)->first();
        if ( !$getCityById ) {
            return response()->json(["message" => "City not found"], 404);
        }
        else {
            return response()->json( $getCityById , 200);
        }
    }

    function update (Request $request, $cityId ){
        $getCity = Cities::findOrFail($cityId);
        if ( !$getCity ) {
            return response()->json(["message" => "City not found"], 404);
        }
        else {
            $getCity->update([
                $getCity->cityName = $request->cityName === null ? $getCity->cityName : $request->cityName,
                $getCity->deliveryFees = $request->deliveryFees === null ? $getCity->deliveryFees : $request->deliveryFees,
            ]);
            return response()->json(["message" => "Successfully update"] , 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Users;
use DB;
use Illuminate\Http\Request;

class UesrController extends Controller
{
    public function index()
    {
        return "User Controller";
    }   
    public function store(Request $request)
    {
        if ( $request->FullName !== null && $request->Phone !== null && $request->Password !== null 
            && $request->Email !== "" && $request->Role !== "" && $request->street !== "" 
            && $request->cityId !== "" && $request->addressId !== "" ) {
            $Adduser = Users::create([
            "FullName"=> $request->FullName,
            "Phone"=> $request->Phone,
            "Email"=> $request->Email === null ? "" : $request->Email, 
            "Role"=> $request->Role === null ? "user" : $request->Role ,
            "Password"=> $request->Password,
            "street"=> $request->street ,
            "cityId"=> $request->cityId ,
            "addressId"=> $request->addressId ,
            ]);
            $Adduser->save();
            return response()->json( $Adduser, 201) ;
            // return response()->json(["message"=> "User created successfully"] , 201);
        } 
        else {
            return response()->json(["message"=> "User creation failed"] , 500);
        }
        
    }

    public function showAllDataAboutUsers()
    {
        $AllUsers = DB::table('users')
        ->join('Cities','users.cityId','=','Cities.cityId')
        ->join('Address','users.addressId','=','Address.addressId')
        ->select('users.*','Cities.cityName','Cities.deliveryFees' , 'Address.street')
        ->get();
        if ( !$AllUsers ) {
            return response()->json(["message" => "No users found"], 404);
        }
        else { 
            return response()->json( $AllUsers , 200);
        }
        
    } 
    public function show($UserId)
    {
        $User = Users::where('UserId' , $UserId)->first();
        if ( !$User ) {
            return response()->json(["message" => "User not found"], 404);
        }
        else {
            return response()->json($User , 200);
        }
        
    }
    public function getAllUsers ()
    {
        $AllUsers = Users::all();
        if ( !$AllUsers ) {
            return response()->json(["message" => "No users found"], 404);
        }
        return response()->json( $AllUsers , 200);
    }
    public function update(Request $request, $id)
    {
        $getUser = Users::where('UserId', $id)->first();
        if ( !$getUser ) {
            return response()->json(["message" => "User not found"], 404);
        }
        $getUser->FullName = $request->input('FullName', $getUser->FullName);
        $getUser->Phone = $request->input('Phone', $getUser->Phone);
        $getUser->Email = $request->input('Email', $getUser->Email);
        $getUser->Role = $request->input('Role', $getUser->Role);
        $getUser->Password = $request->input('Password', $getUser->Password);
        $getUser->save();
        $getUserAfterUpdate = Users::where('UserId', $id)->first();


        return response()->json(["message"=> $getUserAfterUpdate] , 200);

    }
    public function destroy($id){
        $deleteUser = Users::where('UserId' , $id)->delete();
        if ( !$deleteUser ) {
            return response()->json( ["message" => "User not found" ], 404);
        }
        return response()->json(["message"=> "User deleted successfully"], 200);
    }
}

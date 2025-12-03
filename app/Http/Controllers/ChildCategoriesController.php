<?php

namespace App\Http\Controllers;

use App\Models\ChildCategories;
use Illuminate\Http\Request;

class ChildCategoriesController extends Controller
{
    public function store (Request $request){
        $addData = ChildCategories::create(
            [
                "ParentCategoryId"=> $request->ParentCategoryId,
                "CategoryName"=> $request->CategoryName
            ]
        );
        if ($addData){
            return response()->json(["message"=>"you are added new Child Category"], 201);
        } 
        return response()->json(["message"=> "field to add data"],404);
    }

    public function destroy ($childCategoryId)
    {
        $childCategory = ChildCategories::findOrFail($childCategoryId);
        if ( !$childCategory ) {
            return response()->json(["message"=>"The Child Category not found"] , 404);
        }
        else {
            $childCategory->delete();
            return response()->json(["message"=>"you are deleted Child Category"] , 200);
        }
    }

    public function  update (Request $request , $CategoryId){
        $childCategory = ChildCategories::findOrFail($CategoryId);
        if ( !$childCategory ) {
            return response()->json(["message"=>"The Child Category not found"] , 404);
        }
        else {
            $childCategory->update([
                $childCategory->ParentCategoryId = $request->ParentCategoryId === null ? $childCategory->ParentCategoryId : $request->ParentCategoryId,
                $childCategory->CategoryName = $request->CategoryName === null ? $childCategory->CategoryName : $request->CategoryName,
            ]);
            return response()->json(["message"=>"you are updated Child Category"] , 200);
        }
        
    }

    public function showAllChildCategories (){
        $allChildCategories = ChildCategories::all();
        if ( !$allChildCategories ) {
            return response()->json(["message" => "No Child Category found"], 404);
        }
        return response()->json( $allChildCategories , 200);
    }

    public function show ($CategoryId) { 
        $getChildCategoryById = ChildCategories::findOrFail($CategoryId);
        if ( !$getChildCategoryById ) {
            return response()->json(["message" => "Child Category not found"], 404);
        }
        else { 
            return response()->json( $getChildCategoryById , 200);
        }
    }

    public function showByParentCategoryId ($parentCategoryId ){
        $getChildCategoryByParentId = ChildCategories::where('ParentCategoryId', $parentCategoryId)->get();
        if ( !$getChildCategoryByParentId ) {
            return response()->json(["message" => "Child Category not found"], 404);
        }
        else {
            return response()->json( $getChildCategoryByParentId , 200);
        }
    }
}

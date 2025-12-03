<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $categories = Categories::create([
            "CategoryName" => $request->CategoryName 
        ]);
        if ( $categories){

            return response()->json(["message"=>"you are added new Category"], 201);
        }
        else {
            return response()->json(["message"=>"Category creation failed"] , 404);
        }

    }
    public function show ($categoryId) { 
        $getCategoriesById = Categories::findOrFail($categoryId);
        if ( !$getCategoriesById ) {
            return response()->json(["message" => "Category not found"], 404);
        }
        else { 
            return response()->json( $getCategoriesById , 200);
        }
    }
    public function showAllCategories (){
        $getAllCategories = Categories::all();
        if ( !$getAllCategories ) {
            return response()->json(["message" => "No Category found"], 404);
        }
        return response()->json( $getAllCategories , 200);
    }   
    public function update (Request $request , $categoryId){
        $getCategoriesById = Categories::findOrFail($categoryId);
        if ( !$getCategoriesById ) {
            return response()->json(["message" => "Category not found"], 404);
        }
        else {
            $getCategoriesById->update([
                $getCategoriesById->CategoryName = $request->CategoryName === null ? $getCategoriesById->CategoryName : $request->CategoryName,
                $getCategoriesById->CategoryDescription = $request->CategoryDescription === null ? $getCategoriesById->CategoryDescription : $request->CategoryDescription,
            ]);
            return response()->json(["message"=>"you are updated Category"] , 200);
        }
    }
    public function destroy ( $categoryId) {
        $getCategoriesById = Categories::findOrFail($categoryId);
        if ( !$getCategoriesById ) {
            return response()->json(["message"=>"The Category not found"] , 404);
        }
        else {
            $getCategoriesById->delete();
            return response()->json(["message"=>"you are deleted Category"] , 200);
        }
    }

}

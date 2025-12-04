<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ChildCategories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $valedationCategories = $request->validate([
            "CategoryName" => "required|string|max:255",
        ]);
        if (!$valedationCategories) {
            return response()->json(["message" => "Category creation failed"], 404);
        } 
        else {
            $categories = Categories::create([
                "CategoryName" => $valedationCategories["CategoryName"]
            ]);
            if ($categories) {

                return response()->json(["message" => "you are added new Category"], 201);
            } else {
                return response()->json(["message" => "Category creation failed"], 404);
            }
        }

    }
    public function show($categoryId)
    {
        $getCategoriesById = Categories::findOrFail($categoryId);
        if (!$getCategoriesById) {
            return response()->json(["message" => "Category not found"], 404);
        } else {
            return response()->json($getCategoriesById, 200);
        }
    }
    public function showAllCategories()
    {
        $getAllCategories = Categories::all();
        if (!$getAllCategories) {
            return response()->json(["message" => "No Category found"], 404);
        }
        return response()->json($getAllCategories, 200);
    }
    public function update(Request $request, $categoryId)
    {
        $valedationCategories = $request->validate([
            "CategoryName" => "required|string|max:255",
        ]);
        if (!$valedationCategories) {
            return response()->json(["message" => "Category update failed"], 404);
        } else {
        $getCategoriesById = Categories::where("CategoryId",$categoryId)->first();
        if (!$getCategoriesById) {
            return response()->json(["message" => "Category not found"], 404);
        } else {
            $getCategoriesById->update([
                $getCategoriesById->CategoryName = $request->CategoryName === null ? $getCategoriesById->CategoryName : $valedationCategories["CategoryName"],
            ]);
            return response()->json(["message" => "you are updated Category"], 200);
        }
    }
    }
    public function destroy($categoryId)
    {
        $getCategoriesById = Categories::where("categoryId", $categoryId)->first();
        if (!$getCategoriesById) {
            return response()->json(["message" => "The Category not found"], 404);
        } else {
            $getChildren = ChildCategories::where("parentCategoryId", $categoryId)->get();
            if ($getChildren->count() > 0) {
                return response()->json(["message" => "This Ctegore have a child categoreis"], 404);
            } else {
                $getCategoriesById->delete();
                return response()->json(["message" => "you are deleted Category"], 200);
            }
        }
    }

}

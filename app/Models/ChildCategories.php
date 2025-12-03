<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategories extends Model
{
    protected $table = "childcategories";
    protected $primaryKey = "CategoryId";
    public $incrementing = true;
    protected $fillable = [
        "ParentCategoryId",
        "CategoryName"
    ];
}

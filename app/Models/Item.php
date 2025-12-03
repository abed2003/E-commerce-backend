<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "Item";
    protected $primaryKey = "ItemId";
    public $incrementing = true;
    protected $fillable = [
        "ItemName", 
        "ItemDescription",
        "ItemPrice",
        "ItemColor",
        "CategoryId",
        "ChildCategoryId"];

}

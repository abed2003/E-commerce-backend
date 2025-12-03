<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $primaryKey = "CategoryId";
    public $incrementing = true;
    protected $fillable = [
        "CategoryName"
    ];
}

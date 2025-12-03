<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPhotos extends Model
{
    protected $table = "ItemPhotos";
    protected $primaryKey = "PhotoId";
    public $incrementing = true;
    protected $fillable = [
        "ItemId",
        "PhotoUrl"
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInformation extends Model
{
    protected $table = "ItemInformation";
    protected $primaryKey = "InfoId";
    public $incrementing = true;
    protected $fillable = [
        "ItemId",
        "Size",
        "Quantity"
    ];

}

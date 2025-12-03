<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $table = "OrderList";
    protected $primaryKey = "OrderListId";
    public $incrementing = true;
    protected $fillable = [
        "OrderId",
        "ItemId",
        "Quantity",
        "ItemPrice",
        "Size"
    ];
}

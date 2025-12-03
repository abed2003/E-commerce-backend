<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "Order";
    protected $primaryKey = "OrderId";
    public $incrementing = true;
    protected $fillable = [
    "UserId"
    ,"ItemId"
    ,"FullName"
    ,"Phone"
    ,"Email"
    ,"cityId"
    ,"addressId"
    ,"street"
    ,"OrderDate"
    ,"PriceDelevery"
    ,"ProductPrice"
    ,"TotalAmount"
    ,"Status"
    ,"Note"];
} 



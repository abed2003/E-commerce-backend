<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "Address";
    protected $primaryKey = "addressId";
    public $incrementing = true;
    protected $fillable = [
        "street",
        "cityId"
    ];
}

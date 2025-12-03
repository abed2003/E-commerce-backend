<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = "Cities";
    protected $primaryKey = "cityId";
    public $incrementing = true;
    protected $fillable = [
        "cityName",
        "deliveryFees"
    ];
}

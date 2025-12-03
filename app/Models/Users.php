<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $primaryKey = 'UserId';
    public $incrementing = true;
    protected $fillable = [
        "FullName",
        "Email",
        "Phone",
        "Role",
        "Password",
        "street",
        "cityId",
        "addressId"
    ];
    public function users()
    {
        return $this->hasMany(Users::class, 'UserId', 'UserId');
    }
    
}

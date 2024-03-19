<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

// class ShopLeader extends Model
class ShopLeader extends Model implements AuthenticatableContract
{
    use HasFactory;

    use Authenticatable;

    protected $table = 'shopleaders';

    protected $fillable = ['user_id', 'shop_id', 'role_id',  'name', 'email', 'password'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

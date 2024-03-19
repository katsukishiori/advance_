<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\Models\Favorite;
use App\Models\Reservation;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'shop_name',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // role_id のデフォルト値を設定
    protected $attributes = [
        'role_id' => 3,
    ];

    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'user_id');
    }

    // お気に入りのハートの色を保持
    public function favoriteShops()
    {
        return $this->belongsToMany(Shop::class, 'favorites', 'user_id', 'shop_id', 'role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function isShopLeader()
    {
        return $this->role_id === 2;
    }
}

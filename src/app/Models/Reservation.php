<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function user()
    {
        // return $this->hasMany(Reservation::class);
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    protected $fillable = [
        'user_id',
        'shop_id',
        'datetime',
        'reservation_count',
    ];



    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'shop_reservation', 'reservation_id', 'shop_id');
    }
}

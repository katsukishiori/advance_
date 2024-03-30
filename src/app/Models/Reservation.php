<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'shop_id',
        'datetime',
        'reservation_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'shop_reservation', 'reservation_id', 'shop_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($reservation) {
            $changes = $reservation->getChanges();
            $reservation->recordChangedReservation($changes);
        });
    }
}

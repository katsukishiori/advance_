<?php

namespace App\Models;

use App\Mail\AnnouncementEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail; //メール
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserShop;
use App\Models\Favorite;
use App\Models\Reservation;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shops()
    {
        return $this
            ->belongsToMany(Shop::class, 'user_shops')
            ->using(UserShop::class)
            ->withPivot(['role_id']);
    }




    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
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

    //店舗更新画面へ移動する時に必要なコード
    public function userShop()
    {
        return $this->hasOne(UserShop::class);
    }

    public function sendEmailVerificationNotification()
    {
        Mail::to($this->email)->send(new AnnouncementEmail($this));
    }
}

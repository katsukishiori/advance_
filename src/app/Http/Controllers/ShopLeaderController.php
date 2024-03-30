<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class ShopLeaderController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('confirm_reservation', compact('reservations'));
    }

    public function dashboard()
    {
        $reservations = Reservation::all();

        // ビューに変数 $reservations を渡して表示する
        return view('confirm_reservation', ['reservations' => $reservations]);
    }
}

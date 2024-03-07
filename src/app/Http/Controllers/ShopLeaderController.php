<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ShopLeaderController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('shopleader', compact('reservations'));
    }
}

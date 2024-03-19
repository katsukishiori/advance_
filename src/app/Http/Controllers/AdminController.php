<?php

namespace App\Http\Controllers;

use App\Models\Shop;


class AdminController extends Controller
{


    public function index()
    {
        $shops = Shop::all();

        return view('create_shopleaders', ['shops' => $shops]);
    }

    public function dashboard()
    {
        return view('create_shopleaders.dashboard');
    }
}

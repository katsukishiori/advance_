<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanksController extends Controller
{
    public function store(Request $request)
    {
        $contact = $request->only(['name', 'email', 'password']);

        return view('thanks');
    }

    public function access(Request $request)
    {
        return redirect('/login'); //redirectでログインできるようにする
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (Gate::allows('admin', $user)) {
            return view('admin');
        } else {
            return redirect('/')->with('error', '権限がありません。');
        }
    }
}

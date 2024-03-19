<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store()
    {
        if(request('image')) {
            $name=request()->file('image')->getClientOriginalName();
            $file=request()->file('image')->move('storage/images', $name);
            $post->image=$name;
        }
    }
}

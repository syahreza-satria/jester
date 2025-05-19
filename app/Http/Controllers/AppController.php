<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('index', compact('photos'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}

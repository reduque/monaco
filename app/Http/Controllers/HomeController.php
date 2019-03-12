<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners=Banner::inRandomOrder()->get();
        return view('home',['seccion' => 'home', 'banners' => $banners]);
    }
}

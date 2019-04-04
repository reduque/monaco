<?php

namespace App\Http\Controllers;

use App\Tip;

class TipController extends Controller
{
    public function index()
    {
        $tips=Tip::get();
        return view('tips',['seccion' => 'tips', 'tips' => $tips]);
    }
}

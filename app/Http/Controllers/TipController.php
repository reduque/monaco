<?php

namespace App\Http\Controllers;

use App\Tip;

class TipController extends Controller
{
    public function index()
    {
        $tips=Tip::where('active',1)->whereDate('publication_date','<=',date('Y-m-d'))->get();
        return view('tips',['seccion' => 'tips', 'tips' => $tips]);
    }
}

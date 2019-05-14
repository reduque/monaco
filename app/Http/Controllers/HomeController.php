<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Tip;
use App\Recipe;
use App\Line;
use App\Product;
use View;


class HomeController extends Controller
{
    public function index()
    {
        $banners=Banner::where('active',1)->inRandomOrder()->get();
        $tip=Tip::inRandomOrder()->first();
        $recipe=Recipe::where('active',1)->whereDate('publication_date','<=',date('Y-m-d'))->orderby('publication_date','desc')->first();
        return view('home',['seccion' => 'home', 'banners' => $banners, 'tip' => $tip, 'recipe' => $recipe]);
    }

    public function buscar_ajax(Request $request)
    {
        $products=Product::where('name_en','like','%' . $request->q . "%")->get();
        $recipes=Recipe::where('title_en','like','%' . $request->q . "%")->get();
        $view=View::make('ajax.buscar_ajax', ['q'=>$request->q, 'products'=>$products, 'recipes' => $recipes]);
        $data=$view->render();
        return ['status' => 'exito', "data" => $data];
    }

    public function our_story()
    {
        return view('our_story',['seccion' => 'our_story']);
    }

    public function divisions()
    {
        $lines=Line::get();
        return view('divisions',['seccion' => 'divisions', 'lines' => $lines]);
    }

    public function reach_us()
    {
        return view('reach_us',['seccion' => 'reach_us']);
    }
    public function reach_us_enviar(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $data=[
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'country' => $request->country,
                'comment' => $request->comment,
            ];

            if(config('app.env') <> 'local'){
                Mail::send('emails.reachus', $data, function($message) use ($data) {
                    $message->to('sales@monacofoods.com', 'Sales')->subject('Web contact');
                });
            }else{
                //return view('emails.reachus',$data);
            }
    
            return redirect()->route('reach_us')->with("notificacion", 'Enviado' );
    
        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }
    public function tyc()
    {
        return view('tyc',['seccion' => 'home']);
    }
}

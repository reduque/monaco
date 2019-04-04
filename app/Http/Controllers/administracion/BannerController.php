<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Banner;

class BannerController extends Controller
{

    public function index()
    {
        $banners=Banner::paginate(25);
        return view('administracion.banners.index',['banners' => $banners]);
    }

    public function create()
    {
        return view('administracion.banners.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $fileName = "";
            if($request->img_en){
                $fileName = $this->saveFile($request->img_en, 'banners/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $banner=Banner::create([
                'title_en' => $request->title_en,
                'link' => $request->link,
                'img_en' => $fileName,
            ]);
            return redirect()->route('banners.edit', codifica($banner->id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id=decodifica($id);
        $banner=Banner::find($id);
        session(['project_id' => $id]);
        return view('administracion.banners.edit',['banner' => $banner]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'title_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $banner=Banner::find($id);
            $fileName = $banner->img_en;
            if($request->img_en){
                if($fileName<>'')
                    $this->deleteFile('banners/' . $fileName);
                $fileName = $this->saveFile($request->img_en, 'banners/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $banner->update([
                'title_en' => $request->title_en,
                'link' => $request->link,
                'img_en' => $fileName,
            ]);
            return redirect()->route('banners.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $banner=Banner::find($id);
            $fileName = $banner->img_en;
            if($fileName<>'')
                $this->deleteFile('banners/' . $fileName);

            $banner->delete();
            return redirect()->route('banners.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}

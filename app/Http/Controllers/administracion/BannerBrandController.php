<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BannerBrand;

class BannerBrandController extends Controller
{

    public function index()
    {
        $banners_brands=BannerBrand::paginate(25);
        return view('administracion.banners_brands.index',['banners_brands' => $banners_brands]);
    }

    public function create()
    {
        return view('administracion.banners_brands.create');
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
            $img_en = "";
            if($request->img_en){
                $img_en = $this->saveFile($request->img_en, 'banners_brands/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $img_es = "";
            if($request->img_es){
                $img_es = $this->saveFile($request->img_es, 'banners_brands/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $active = ($request->active == 1) ? 1 : 0 ;
            $banner=BannerBrand::create([
                'title_en' => $request->title_en,
                'title_es' => $request->title_es,
                'link' => $request->link,
                'active' => $active,
                'img_en' => $img_en,
                'img_es' => $img_es,
            ]);
            return redirect()->route('banners_brands.edit', codifica($banner->id))->with("notificacion", __('administracion.grabado_exito') );

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
        $banner=BannerBrand::find($id);
        session(['project_id' => $id]);
        return view('administracion.banners_brands.edit',['banner' => $banner]);
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
            $banner=BannerBrand::find($id);
            $img_en = $banner->img_en;
            if($request->img_en){
                if($img_en<>'')
                    $this->deleteFile('banners_brands/' . $img_en);
                $img_en = $this->saveFile($request->img_en, 'banners_brands/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $img_es = $banner->img_es;
            if($request->img_es){
                if($img_es<>'')
                    $this->deleteFile('banners/' . $img_es);
                $img_es = $this->saveFile($request->img_es, 'banners_brands/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $active = ($request->active == 1) ? 1 : 0 ;
            $banner->update([
                'title_en' => $request->title_en,
                'title_es' => $request->title_es,
                'link' => $request->link,
                'active' => $active,
                'img_en' => $img_en,
                'img_es' => $img_es,
            ]);
            return redirect()->route('banners_brands.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $banner=BannerBrand::find($id);
            $img_en = $banner->img_en;
            if($img_en<>'')
                $this->deleteFile('banners_brands/' . $img_en);
            $img_es = $banner->img_es;
            if($img_es<>'')
                $this->deleteFile('banners_brands/' . $img_es);

            $banner->delete();
            return redirect()->route('banners_brands.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}

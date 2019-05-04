<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tip;

class TipController extends Controller
{

    public function index()
    {
        $tips=Tip::paginate(25);
        return view('administracion.tips.index',['tips' => $tips]);
    }

    public function create()
    {
        return view('administracion.tips.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'tip_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            if(!$request->active) $request->request->add(['active' => 0]);
            $tip=Tip::create($request->toArray());
            return redirect()->route('tips.edit', codifica($tip->id))->with("notificacion", __('administracion.grabado_exito') );

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
        $tip=Tip::find($id);
        return view('administracion.tips.edit',['tip' => $tip]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'tip_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            if(!$request->active) $request->request->add(['active' => 0]);
            $id=decodifica($id);
            $tip=Tip::find($id);

            $tip->update($request->toArray());
            return redirect()->route('tips.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $tip=Tip::find($id);
            $tip->delete();
            return redirect()->route('tips.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historia;
use Laracasts\Flash\Flash;
use File;

class HistoriaController extends Controller
{
    public function index()
    {
        $timeline = Historia::orderBy('epoca')->get();

        return view('adm.timeline.index')->with ('timeline',$timeline);
    }

    public function form($id = null)
    {
        $timeline = Historia::find($id);

        return view('adm.timeline.form')->with ('timeline',$timeline);
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
                $timeline = Historia::findOrFail($request->id);
                $timeline->fill($request->all());
                $timeline->save();

                Flash::success("Se ha actualizado el timeline!!");          
        }

        else{
            $timeline= new Historia($request->all());
            $timeline->save();
            Flash::success("Se ha creado el timeline!!");         
        } 
        return redirect()->route('timeline.index');
    }

    public function destroy($id)
    {
        $timeline = Historia::findOrFail($id);
        $timeline->delete();
        
        Flash::error("Se ha eliminado el timeline!!");         

        return redirect()->route('timeline.index');

    }
}

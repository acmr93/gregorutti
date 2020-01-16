<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Multimedia;
use Laracasts\Flash\Flash;
use File;

class MultimediaController extends Controller
{
    public function SliderHome()
    {   
        $items = Multimedia::where([['seccion', 'home'],['tipo', 'slider']])->orderBy('orden')->get();
        $seccion = 'home';
        $tipo = 'slider';
        return view('adm.multimedia.index',compact('items','seccion','tipo'));
    }

    public function SliderHomeID($id = null)
    {   
        $item = Multimedia::find($id);
        $seccion = 'home';
        $tipo = 'slider';
        return view('adm.multimedia.form',compact('item','seccion','tipo'));
    }

    public function SliderEmpresa()
    {   
        $items = Multimedia::where([['seccion', 'empresa'],['tipo', 'slider']])->orderBy('orden')->get();
        $seccion = 'empresa';
        $tipo = 'slider';
        return view('adm.multimedia.index',compact('items','seccion','tipo'));
    }

    public function store(Request $request)
    {   
        if (isset($request->id)) {
            $this->validate($request, 
            [
                "archivo"  => "nullable|mimes:jpeg,png",
            ]);
            $item = Multimedia::findOrFail($request->id);
            $item->fill($request->all());
            //$item->orden = $request->orden;
        	//$item->setTranslations('texto1', (array) $request->texto1);
        	//$item->setTranslations('texto2', (array) $request->texto2);
            $item->save();

            if ($request->hasfile('archivo')){

                if ($item->nombre != null) {
                    $filename= $item->nombre;
                    $file = public_path().'/loaded/'.$request->seccion.'/'.$filename;
                    File::delete($file);
                }

                if ($item->seccion == 'extra'){
                    $data = getimagesize($request->file('archivo'));
                    $item->orden = '-';
                    $item->texto1 = $data[0].'px x '.$data[1].'px';
                    $item->texto2 = 'loaded/'.$extension;         
                }

                $extension = $request->file('archivo')->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $path_file = public_path().'/loaded/'.$request->seccion.'/';

                $request->file('archivo')->move($path_file,$file_name);
                $item->nombre=$file_name;
                $item->save();
            }

            Flash::success("Se ha actualizado el archivo!!");          
        }

        else{
            $this->validate($request, 
            [
                "archivo"  => "required|mimes:jpeg,png",
            ]);
            
            $item= new Multimedia($request->all());
            $item->setTranslations('texto1', (array) $request->texto1);
        	$item->setTranslations('texto2', (array) $request->texto2);
            $item->save();       

            if ($request->hasfile('archivo')){
                $extension = $request->file('archivo')->getClientOriginalExtension();
                $file_name = time().'.'.$extension;

                if ($item->seccion == 'extra'){
                    $data = getimagesize($request->file('archivo'));
                    $item->orden = '-';
                    $item->texto1 = $data[0].'px x '.$data[1].'px';
                    $item->texto2 = 'loaded/'.$extension;         
                }
                $path_file = public_path().'/loaded/'.$request->seccion.'/';
                $request->file('archivo')->move($path_file,$file_name);
                $item->nombre=$file_name;
                $item->save();
                Flash::success("Se ha subido el archivo!!");         
            } 
        }
        
        return redirect()->route(''.$item->seccion.'.'.$item->tipo.'');  
    }

    public function destroy($id)
    {
        $imagen = Multimedia::findOrFail($id);
        $seccion = $imagen->seccion;
        $tipo = $imagen->tipo;

        if ($imagen->nombre != null) {
            $filename= $imagen->nombre;
            $file = public_path().'/loaded/'.$seccion.'/'.$filename;
            File::delete($file);
        }

        $imagen->delete();

        Flash::error("Se ha eliminado el archivo!!");         
        return redirect()->route(''.$seccion.'.'.$tipo.'');  
        
        //Flash::error("Se ha eliminado la imagen!!");         

        //return redirect()->route('imagen.extra');
    }
}

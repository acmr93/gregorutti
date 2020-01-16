<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contenido;
use Laracasts\Flash\Flash;
use File;

class ContenidoController extends Controller
{   
    public function Sectores()
    {   
        $contenido = Contenido::where('seccion','sectores')->orderBy('orden')->get();
        $seccion = 'sectores';
        return view('adm.contenido.index')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function SectoresID($id = null)
    {   
        $contenido = Contenido::find($id);
        $seccion = 'sectores';
        return view('adm.contenido.form')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function ContenidoEmpresa()
    {   
        $contenido = Contenido::where('seccion','empresa')->orderBy('orden')->get();
        $seccion = 'empresa';
        return view('adm.contenido.index')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function ContenidoEmpresaID($id = null)
    {   
        $contenido = Contenido::find($id);
        $seccion = 'empresa';
        return view('adm.contenido.form')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $this->validate($request, 
            [
                "archivo"    => "nullable",
                "archivo.*"  => "nullable|mimes:jpeg,png",
            ]);

            $contenido = Contenido::findOrFail($request->id);
            $contenido->fill($request->all());
            $contenido->save();

            if ($request->hasfile('archivo')){
                if ($contenido->img != null) {
                	foreach ($contenido->img as $key => $value) {
                		$filename= $value['nombre'];
                    	$file = public_path().'/loaded/contenido/'.$filename;
                    	File::delete($file);
                	}
                }

                foreach ($request->archivo as $archivo) {

                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/contenido/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/contenido/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }

                $contenido->img = $imagenes;
                $contenido->save();
            }

            Flash::success("Se ha actualizado el contenido!!");          
        }

        else{

            $this->validate($request, 
            [
                "archivo"    => "required",
                "archivo.*"  => "required|mimes:jpeg,png",
            ]);

            $contenido= new Contenido($request->all());
            $contenido->save();

            if ($request->hasfile('archivo')){
                foreach ($request->archivo as $archivo) {
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/contenido/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/contenido/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $contenido->img = $imagenes;
                $contenido->save();
            }

            Flash::success("Se ha creado el contenido!!");         
        }

        return redirect()->route(''.$contenido->seccion.'.contenido');
    }

    public function destroy($id)
    {
        $contenido = Contenido::findOrFail($id);
        $seccion = $contenido->seccion;
        if ($contenido->img != null) {
        	foreach ($contenido->img as $key => $value) {
        		$filename= $value['nombre'];
            	$file = public_path().'/loaded/contenido/'.$filename;
            	File::delete($file);
        	}
        }
        $contenido->delete();

        Flash::error("Se ha eliminado el contenido!!");         
        return redirect()->route(''.$contenido->seccion.'.contenido');
    }
}

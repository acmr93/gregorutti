<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use Laracasts\Flash\Flash;
use File;

class ServiciosController extends Controller
{
	public function index()
    {   
        $servicios = Servicio::all();
        return view('adm.servicios.index',compact('servicios'));
    }

    public function FormServiciosID($id = null)
    {   
        $servicio = Servicio::find($id);
        //dd($servicio);
        return view('adm.servicios.form')->with('servicio',$servicio);
    }

    public function store(Request $request)
    {	
        if (isset($request->id)) {

            $this->validate($request, 
            [
                "imagen"  => "nullable",
                "imagen.*"  => "nullable|mimes:jpeg,png",
                "icono"  => "nullable",
                "icono.*"  => "nullable|mimes:jpeg,png",
            ]);

            $servicio = Servicio::findOrFail($request->id);
            $servicio->fill($request->all());
            $servicio->save();

            if ($request->hasfile('imagen')){
                if ($servicio->img != null) {
                	foreach ($servicio->img as $key => $value) {
                		$filename= $value['nombre'];
                    	$file = public_path().'/loaded/servicios/'.$filename;
                    	File::delete($file);
                	}
                }
                foreach ($request->imagen as $imagen) {
                    $nombre_original = $imagen->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $imagen->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->img = $imagenes;
                $servicio->save();
            }

            if ($request->hasfile('icono')){
                if ($servicio->icon != null) {
                    foreach ($servicio->icon as $key => $value) {
                        $filename= $value['nombre'];
                        $file = public_path().'/loaded/servicios/'.$filename;
                        File::delete($file);
                    }
                }
                foreach ($request->icono as $icono) {
                    $nombre_original = $icono->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= 'icon'.time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $icono->move($path_file,$nombre_interno);
                    $iconos[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->icon = $iconos;
                $servicio->save();
            }

            Flash::success("Se ha actualizado el servicio!!");          
        }

        else{
            $this->validate($request, 
            [
                "imagen"    => "required",
                "imagen.*"  => "required|mimes:jpeg,png",
                "icono"    => "nullable",
                "icono.*"  => "nullable|mimes:jpeg,png",
            ]);

            $servicio= new Servicio($request->all());
            $servicio->save();

            if ($request->hasfile('imagen')){
                foreach ($request->imagen as $imagen) {
                    $nombre_original = $imagen->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $imagen->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->img = $imagenes;
                $servicio->save();
            }

            if ($request->hasfile('icono')){
                foreach ($request->icono as $icono) {
                    $nombre_original = $icono->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= 'icon'.time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $icono->move($path_file,$nombre_interno);
                    $iconos[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->icon = $iconos;
                $servicio->save();
            }


            Flash::success("Se ha creado el servicio!!");         
        }

        return redirect()->route('servicios.index');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        if ($servicio->img != null) {
        	foreach ($servicio->img as $key => $value) {
        		$filename= $value['nombre'];
            	$file = public_path().'/loaded/servicios/'.$filename;
            	File::delete($file);
        	}
        }

        if ($servicio->icon != null) {
            foreach ($servicio->icon as $key => $value) {
                $filename= $value['nombre'];
                $file = public_path().'/loaded/servicios/'.$filename;
                File::delete($file);
            }
        }

        $servicio->delete();

        Flash::error("Se ha eliminado el servicio!!");         
        return redirect()->route('servicios.index');
    }

    public function getServicios()
    {
        $servicios = Servicio::where('icon','!=', null)->orderby('titulo', 'asc')->select('id', 'titulo', 'icon')->get();

        return response()->json($servicios); 
    }
}

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
                "archivo"  => "nullable",
                "archivo.*"  => "nullable|mimes:jpeg,png",
            ]);

            $servicio = Servicio::findOrFail($request->id);
            $servicio->fill($request->all());
            $servicio->save();

            if ($request->hasfile('archivo')){
                if ($servicio->img != null) {
                	foreach ($servicio->img as $key => $value) {
                		$filename= $value['nombre'];
                    	$file = public_path().'/loaded/servicios/'.$filename;
                    	File::delete($file);
                	}
                }
                foreach ($request->archivo as $archivo) {
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->img = $imagenes;
                $servicio->save();
            }

            $i=0;


            if ($request->id_sub){
				$actual_texto = $servicio->texto;

				//para eliminar
				foreach ($actual_texto as $key => $value) {
					$del[] =  $value['id'];
				}

				$result = array_diff($del, $request->id_sub);

				foreach ($result as $key) {
					$filter = array_filter($actual_texto, function ($var) use ($key) {
		                return ($var['id'] == $key);
		            });
					$filter=array_values($filter);
					if ($filter[0]['img'] != null) {
            			$filename= $filter[0]['img'];
                    	$file = public_path().'/loaded/servicios/'.$filename;
                    	File::delete($file);
            		}
				} 

				//para modificar
				foreach ($request->id_sub as $id_sub => $value1) {
					foreach ($actual_texto as $key => $value) {
						if ($value1 == $value['id']) {
							$i++;
							$nombre_interno = $value['img'];
							$sub_ser = $value['subservicio'];
		                	if (!empty($request->file_subservicio[$id_sub])) {
		                		if (isset($value['img'])) {
		                			$filename= $value['img'];
			                    	$file = public_path().'/loaded/servicios/'.$filename;
			                    	File::delete($file);
		                		}
			                    $nombre_original = $request->file_subservicio[$id_sub]->getClientOriginalName();
			                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
			                    $nombre_interno= $i.''.time().'.'.$extension;
			                    $path_file = public_path().'/loaded/servicios/';
			                    $request->file_subservicio[$id_sub]->move($path_file,$nombre_interno);
		                	}
		                	if (!empty($request->sub_servicio[$id_sub]))
		                		$sub_ser = $request->sub_servicio[$id_sub];

				            $mod_text[] =   [
                                        "id" => $i,
                                        "subservicio" => $sub_ser,
                                        "img" => $nombre_interno
                                    ];
				        }
					}
				}

				$servicio->texto = $mod_text;
                $servicio->save();     			
            }

            if ($request->sub_new){
            	
                foreach ($request->sub_new as $subservicio => $value) {
                	$i++;
                	$nombre_interno = null;
                	if (!empty($request->file_subnew[$subservicio])) {
	                    $nombre_original = $request->file_subnew[$subservicio]->getClientOriginalName();
	                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
	                    $nombre_interno= $i.''.time().'.'.$extension;
	                    $path_file = public_path().'/loaded/servicios/';
	                    $request->file_subnew[$subservicio]->move($path_file,$nombre_interno);
                	}
                    $texto[] =   [
                                        "id" => $i,
                                        "subservicio" => $value,
                                        "img" => $nombre_interno
                                    ];
                }
                $servicio->texto = array_merge($servicio->texto,$texto);
                $servicio->save();
            }

            Flash::success("Se ha actualizado el servicio!!");          
        }

        else{
            $this->validate($request, 
            [
                "archivo"    => "required",
                "archivo.*"  => "required|mimes:jpeg,png",
            ]);

            $servicio= new Servicio($request->all());
            $servicio->save();

            if ($request->hasfile('archivo')){
                foreach ($request->archivo as $archivo) {
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/servicios/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/servicios/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $servicio->img = $imagenes;
                $servicio->save();
            }

            if ($request->sub_new){
            	$i=0;
                foreach ($request->sub_new as $subservicio => $value) {
                	$i++;
                	$nombre_interno = null;
                	if (!empty($request->file_subnew[$subservicio])) {
	                    $nombre_original = $request->file_subnew[$subservicio]->getClientOriginalName();
	                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
	                    $nombre_interno= $i.''.time().'.'.$extension;
	                    $path_file = public_path().'/loaded/servicios/';
	                    $request->file_subnew[$subservicio]->move($path_file,$nombre_interno);
                	}
                    $texto[] =   [
                                        "id" => $i,
                                        "subservicio" => $value,
                                        "img" => $nombre_interno
                                    ];
                }
                $servicio->texto = $texto;
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

        if ($servicio->texto != null) {
        	foreach ($servicio->texto as $key => $value) {
        		$filename= $value['img'];
            	$file = public_path().'/loaded/servicios/'.$filename;
            	File::delete($file);
        	}
        }

        $servicio->delete();

        Flash::error("Se ha eliminado el servicio!!");         
        return redirect()->route('servicios.index');
    }
}

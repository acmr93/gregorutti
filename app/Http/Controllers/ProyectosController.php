<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use Laracasts\Flash\Flash;
use File;
use Str;

class ProyectosController extends Controller
{
	public function index()
    {   
        $proyectos = Proyecto::all();
        return view('adm.proyectos.index',compact('proyectos'));
    }

    public function FormProyectosID($id = null)
    {   
        $proyecto = Proyecto::find($id);
        //dd($proyecto);
        return view('adm.proyectos.form')->with('proyecto',$proyecto);
    }

    public function store(Request $request)
    {	
        if (isset($request->id)) {

            $this->validate($request, 
            [
                "archivo"  => "nullable",
                "archivo.*"  => "nullable|mimes:jpeg,png",
            ]);

            $proyecto = Proyecto::findOrFail($request->id);
            $proyecto->fill($request->all());
            $proyecto->slug = Str::slug($request->titulo['es']);

            $verf = Proyecto::where([['id','!=', $proyecto->id],['slug', $proyecto->slug]])->get();
                
            if (count($verf) > 0) {
                return back()->withInput()->withErrors(['titulo.es' => 'Por favor cambie el nombre o habra un enlace duplicado en base de datos.']);
            }

            $proyecto->save();

            if ($request->hasfile('archivo')){
                if ($proyecto->img != null) {
                	foreach ($proyecto->img as $key => $value) {
                		$filename= $value['nombre'];
                    	$file = public_path().'/loaded/proyectos/'.$filename;
                    	File::delete($file);
                	}
                }
                foreach ($request->archivo as $archivo) {
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/proyectos/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/proyectos/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $proyecto->img = $imagenes;
                $proyecto->save();
            }

            $i=0;


            if ($request->id_sub){
				$actual_texto = $proyecto->texto;

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
                    	$file = public_path().'/loaded/proyectos/'.$filename;
                    	File::delete($file);
            		}
				} 

				//para modificar
				foreach ($request->id_sub as $id_sub => $value1) {
					foreach ($actual_texto as $key => $value) {
						if ($value1 == $value['id']) {
							$i++;
							$nombre_interno = $value['img'];
							$sub_ser = $value['subproyecto'];
							$texto = $value['texto'];
		                	if (!empty($request->file_subproyecto[$id_sub])) {
		                		if (isset($value['img'])) {
		                			$filename= $value['img'];
			                    	$file = public_path().'/loaded/proyectos/'.$filename;
			                    	File::delete($file);
		                		}
			                    $nombre_original = $request->file_subproyecto[$id_sub]->getClientOriginalName();
			                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
			                    $nombre_interno= $i.''.time().'.'.$extension;
			                    $path_file = public_path().'/loaded/proyectos/';
			                    $request->file_subproyecto[$id_sub]->move($path_file,$nombre_interno);
		                	}
		                	if (!empty($request->sub_proyecto[$id_sub]))
		                		$sub_ser = $request->sub_proyecto[$id_sub];
		                	if (!empty($request->texto_old[$id_sub]))
		                		$texto = $request->texto_old[$id_sub];

				            $mod_text[] =   [
                                        "id" => $i,
                                        "subproyecto" => $sub_ser,
                                        "texto" => $texto,
                                        "img" => $nombre_interno
                                    ];
				        }
					}
				}

				$proyecto->texto = $mod_text;
                $proyecto->save();     			
            }

            if ($request->sub_new){
            	
                foreach ($request->sub_new as $subproyecto => $value) {
                	$i++;
                	$nombre_interno = null;
                	if (!empty($request->file_subnew[$subproyecto])) {
	                    $nombre_original = $request->file_subnew[$subproyecto]->getClientOriginalName();
	                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
	                    $nombre_interno= $i.''.time().'.'.$extension;
	                    $path_file = public_path().'/loaded/proyectos/';
	                    $request->file_subnew[$subproyecto]->move($path_file,$nombre_interno);
                	}
                    $texto[] =   [
                                        "id" => $i,
                                        "subproyecto" => $value,
                                        "texto" => $request->texto_new[$subproyecto],
                                        "img" => $nombre_interno
                                    ];
                }
                $proyecto->texto = array_merge($proyecto->texto,$texto);
                $proyecto->save();
            }

            Flash::success("Se ha actualizado el proyecto!!");          
        }

        else{
            $this->validate($request, 
            [
                "archivo"    => "required",
                "archivo.*"  => "required|mimes:jpeg,png",
            ]);

            $proyecto= new Proyecto($request->all());
            $proyecto->slug = Str::slug($request->titulo['es']);

            $verf = Proyecto::where('slug', $proyecto->slug)->get();
            
            if (count($verf) > 0) {
                return back()->withInput()->withErrors(['titulo.es' => 'Por favor cambie el nombre o habra un enlace duplicado en base de datos.']);
            }
            
            $proyecto->save();

            if ($request->hasfile('archivo')){
                foreach ($request->archivo as $archivo) {
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= time().'.'.$extension;
                    $path_file = public_path().'/loaded/proyectos/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/proyectos/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $proyecto->img = $imagenes;
                $proyecto->save();
            }

            if ($request->sub_new){
            	$i=0;
                foreach ($request->sub_new as $subproyecto => $value) {
                	$i++;
                	$nombre_interno = null;
                	if (!empty($request->file_subnew[$subproyecto])) {
	                    $nombre_original = $request->file_subnew[$subproyecto]->getClientOriginalName();
	                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
	                    $nombre_interno= $i.''.time().'.'.$extension;
	                    $path_file = public_path().'/loaded/proyectos/';
	                    $request->file_subnew[$subproyecto]->move($path_file,$nombre_interno);
                	}
                    $texto[] =   [
                                        "id" => $i,
                                        "subproyecto" => $value,
                                        "texto" => $request->texto_new[$subproyecto],
                                        "img" => $nombre_interno
                                    ];
                }
                $proyecto->texto = $texto;
                $proyecto->save();
            }


            Flash::success("Se ha creado el proyecto!!");         
        }

        return redirect()->route('proyectos.index');
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        if ($proyecto->img != null) {
        	foreach ($proyecto->img as $key => $value) {
        		$filename= $value['nombre'];
            	$file = public_path().'/loaded/proyectos/'.$filename;
            	File::delete($file);
        	}
        }

        if ($proyecto->texto != null) {
        	foreach ($proyecto->texto as $key => $value) {
        		$filename= $value['img'];
            	$file = public_path().'/loaded/proyectos/'.$filename;
            	File::delete($file);
        	}
        }

        $proyecto->delete();

        Flash::error("Se ha eliminado el proyecto!!");         
        return redirect()->route('proyectos.index');
    }
}

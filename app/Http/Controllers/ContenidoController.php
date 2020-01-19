<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contenido;
use Laracasts\Flash\Flash;
use File;
use DB;
use Log;
use Str;
use Exception;
class ContenidoController extends Controller
{   
    public function ContenidoSectores()
    {   
        $contenido = Contenido::where('seccion','sectores')->orderBy('orden')->get();
        $seccion = 'sectores';
        return view('adm.contenido.index')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function ContenidoSectoresID($id = null)
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

    public function ContenidoProductos()
    {   
        $seccion = 'productos';
        $contenido = Contenido::where('seccion',$seccion)->orderBy('orden')->get();
        return view('adm.contenido.index')->with('contenido',$contenido)->with('seccion',$seccion);
    }

    public function ContenidoProductosID($id = null)
    {   
        $contenido = Contenido::find($id);
        $seccion = 'productos';
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
            $contenido->slug = Str::slug($request->titulo['es']);

            $verf = Contenido::where([['id','!=', $contenido->id],['slug', $contenido->slug]])->get();
                
            if (count($verf) > 0) {
                return back()->withInput()->withErrors(['titulo.es' => 'Por favor cambie el nombre o habra un enlace duplicado en base de datos.']);
            }

            $contenido->save();

            if ($request->hasfile('archivo')){
                if ( $contenido->seccion == 'productos') {
                    $imagenes_old =  $contenido->img ;
                    $imagenes;
                    $count = count($imagenes_old);
                } else {
                    if ($contenido->img != null) {
                        foreach ($contenido->img as $key => $value) {
                            $filename= $value['nombre'];
                            $file = public_path().'/loaded/contenido/'.$filename;
                            File::delete($file);
                        }
                    }
                    $count=0;
                }

                foreach ($request->archivo as $archivo) {
                    $count++;
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= $count.''.time().'.'.$extension;
                    $path_file = public_path().'/loaded/contenido/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "id" => $count,
                                        "url" => 'public/loaded/contenido/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                if ( $contenido->seccion == 'productos') {
                    $merge = array_merge($imagenes_old,$imagenes);
                    $contenido->img =  $merge;
                } else {
                    $contenido->img = $imagenes;
                }
                $contenido->save();
            }

            if ($contenido->seccion == 'productos') {
                Flash::success("Se ha actualizado el producto!!");
                return redirect()->route('productos.show',$contenido->id);
            }
            else 
                Flash::success("Se ha actualizado el contenido!!");
        }

        else{

            $this->validate($request, 
            [   
                "archivo"    => "required",
                "archivo.*"  => "required|mimes:jpeg,png",
            ]);

            $contenido= new Contenido($request->all());
            $contenido->slug = Str::slug($request->titulo['es']);

            $verf = Contenido::where('slug', $contenido->slug)->get();
            
            if (count($verf) > 0) {
                return back()->withInput()->withErrors(['titulo.es' => 'Por favor cambie el nombre o habra un enlace duplicado en base de datos.']);
            }

            $contenido->save();
            $i=0;
            if ($request->hasfile('archivo')){
                foreach ($request->archivo as $archivo) {
                    $i++;
                    $nombre_original = $archivo->getClientOriginalName();
                    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                    $nombre_interno= $i.''.time().'.'.$extension;
                    $path_file = public_path().'/loaded/contenido/';
                    $archivo->move($path_file,$nombre_interno);
                    $imagenes[] =   [
                                        "id" => $i,
                                        "url" => 'public/loaded/contenido/',
                                        "nombre" => $nombre_interno,
                                        "extension" => $extension,
                                    ];
                }
                $contenido->img = $imagenes;
                $contenido->save();
            }
            if ($contenido->seccion == 'productos') 
                Flash::success("Se ha creado el producto!!");
            else 
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

        if ($contenido->seccion == 'productos') 
            Flash::error("Se ha eliminado el producto!!");
        else 
            Flash::error("Se ha eliminado el contenido!!");   

        return redirect()->route(''.$contenido->seccion.'.contenido');
    }

    public function ProductosIDshow($id)
    {
        $contenido = Contenido::find($id);
        $seccion = 'productos';
        return view('adm.productos.show')->with ('contenido',$contenido)->with ('seccion',$seccion);
    }

        public function reposition(Request $request, $id)
    {

       // $i = 0;

       // foreach ($_POST['item'] as $value) {
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
           // $i++;
           // DB::table('posts')->where('id', '=', $value)->update([ 'position' => $i ]);
        //}
        DB::beginTransaction();
        try {

            $item = Contenido::find($id);
            $imagenes = $item->img;
            $new_order;
            $count = 0;

            foreach ($request->img_id as $key) {
                foreach ($imagenes as $imagen) {
                    if ($key == $imagen['id']) {
                        $count++;
                        $new_order[] = [
                                        "id" => $count,
                                        "url" => $imagen['url'],
                                        "nombre" => $imagen['nombre'],
                                        "extension" => $imagen['extension'],
                                    ];
                    }
                }
            }

            $item->img = $new_order;
            $item->save();

            DB::commit();

            return response()->json($new_order);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en ContenidoController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar los datos. '
                ], 500);
        }
    }

    public function delete($item_id, $img_id)
    {
        DB::beginTransaction();
        try {

            $item = Contenido::find($item_id);

            $imagenes = $item->img;

            $filter = array_filter($imagenes, function ($var) use ($img_id) {
                return ($var['id'] == $img_id);
            });

            $delete = $imagenes;

            foreach ($filter as $key => $value) {
                unset($delete[$key]);
            }

            $item->img = array_values($delete);
            $item->save();
            $filter = new \RecursiveArrayIterator($filter);
            $filter = iterator_to_array($filter,false);
            $filter = call_user_func_array('array_merge', $filter);
            $filename= $filter['nombre'];
            $file = public_path().'/loaded/contenido/'.$filename;
            File::delete($file);

            $filter['id'] = $img_id;

            DB::commit();

            return response()->json($filter);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en ContenidoController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar los datos. '
                ], 500);
        }
    }
}

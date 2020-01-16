<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Cliente;
use DB;
use Log;
use Exception;
use Laracasts\Flash\Flash;
use Str;
use File;

class ClientesController extends Controller
{
    public function index()
    {
        return view('adm.clientes.index');
    }

    public function listar()
    {
        try {
            $clientes = Cliente::get();
            $clientes->each(function($clientes){
            	$clientes->img = $clientes->img[0]['nombre'];
                return $clientes;
            });
            return Datatables::of($clientes)->make(true);
        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en ClientesController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.'
                ], 500);
        }
    }

    public function store(Request $request)
    {   
        if (isset($request->id)) {
            $this->validate($request, 
                [
                    "orden"     => "required|alpha_num",
                    "url"     => "nullable|url",
                    "nombre"     => "required",
                    "nombre.*"   => "required",
                    "file_cliente"  => "nullable|mimes:jpeg,png",
                ]);

            DB::beginTransaction();
            try {
                $cliente = Cliente::findOrFail($request->id);
                $cliente->fill($request->all());

                if ($request->hasfile('file_cliente')){
                    if ($cliente->img != null) {
	                	foreach ($cliente->img as $key => $value) {
	                		$filename= $value['nombre'];
	                    	$file = public_path().'/loaded/clientes/'.$filename;
	                    	File::delete($file);
	                	}
	                }
                    $extension = $request->file('file_cliente')->getClientOriginalExtension();
                    $file_name = time().'.'.$extension;
                    $path_file = public_path().'/loaded/clientes/';
                    $request->file('file_cliente')->move($path_file,$file_name);

                    $imagenes[] =   [
                                        "url" => 'public/loaded/clientes/',
                                        "nombre" => $file_name,
                                        "extension" => $extension,
                                    ];

                    $cliente->img=$imagenes;
                    $cliente->save();
                }

                $cliente->save();
                DB::commit();
                return response()->json($cliente);
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Ha ocurrido un error en ClientesController: '.$e->getMessage().', Linea: '.$e->getLine());
                return response()->json([
                    'message' => 'Ha ocurrido un error al tratar de guardar los datos.'
                    ], 500);
            }
        }
        else{
            $this->validate($request, 
                [
                    "orden"     => "required|alpha_num",
                    "url"     => "nullable|url",
                    "file_cliente"  => "required|mimes:jpeg,png",
                    "nombre"     => "required",
                    "nombre.*"   => "required"
                ]);

            DB::beginTransaction();
            try {


                $cliente = new Cliente($request->all());

                if ($request->hasfile('file_cliente')){
                    $extension = $request->file('file_cliente')->getClientOriginalExtension();
                    $file_name = time().'.'.$extension;
                    $path_file = public_path().'/loaded/clientes/';
                    $request->file('file_cliente')->move($path_file,$file_name);
                    $imagenes[] =   [
                                        "url" => 'public/loaded/clientes/',
                                        "nombre" => $file_name,
                                        "extension" => $extension,
                                    ];

                    $cliente->img=$imagenes;
                    $cliente->save();
                }

                $cliente->save();
                DB::commit();
                return response()->json($cliente);
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Ha ocurrido un error en ClientesController: '.$e->getMessage().', Linea: '.$e->getLine());
                return response()->json([
                    'message' => 'Ha ocurrido un error al tratar de guardar los datos.'
                    ], 500);
            }            
        }

    }


    public function show($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            	$cliente->img = $cliente->img[0]['nombre'];
            return response()->json($cliente);
        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en ClientesController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.'
                ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $cliente = Cliente::findOrFail($id);
            if ($cliente->img != null) {
            	foreach ($cliente->img as $key => $value) {
            		$filename= $value['nombre'];
                	$file = public_path().'/loaded/clientes/'.$filename;
                	File::delete($file);
            	}
            }
            $cliente->delete();

            DB::commit();

            return response()->json($cliente);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en ClientesController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar los datos.'
                ], 500);
        }
    }
}

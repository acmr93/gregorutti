<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Metadato;
use App\Multimedia;
use Yajra\Datatables\Datatables;
use Laracasts\Flash\Flash;
use File;
use DB;
use Log;
use Exception;

class InfoController extends Controller
{
    public function index($data)
    {
    	switch ($data) {
    		case 'general':
    			$empresa = Empresa::find(1);
                if ($empresa != null) {
                    //$empresa->domicilio = json_decode($empresa->domicilio, true);
                    //$empresa->telefonos = json_decode($empresa->telefonos, true);
                    //$empresa->emails = json_decode($empresa->emails, true);
                }
                $header = Multimedia::where('tipo', 'header')->first();
                $footer = Multimedia::where('tipo', 'footer')->first();
                $favicon = Multimedia::where('tipo', 'favicon')->first();

                return view('adm.info.general')->with('data',$data)->with('empresa',$empresa)->with('header',$header)->with('footer',$footer)->with('favicon',$favicon);
    			break;

    		case 'emails':
                $emails = Empresa::find(1);
                return view('adm.info.emails')->with('data',$data)->with('emails',$emails);
    			break;

            case 'imagenes':
                dd('imagenes');
                break;

    		case 'redes':
    			$empresa = Empresa::find(1);
                if ($empresa != null) {
                    //$empresa->redes_sociales = json_decode($empresa->redes_sociales, true);
                }
                return view('adm.info.redes')->with('empresa',$empresa);

    			break;

    		case 'terminos':
                $empresa = Empresa::find(1);
                return view('adm.info.terminos')->with('empresa',$empresa);
    			break;

            case 'metadatos':
                $empresa = Empresa::find(1);
                return view('adm.info.metadatos')->with('empresa',$empresa);
                break;
    	}
        return redirect()->route('adm');
    }

    public function general(Request $request)
    {   
        //dd($request);
        $this->validate($request, 
            [
                "archivo"    => "nullable",
                "archivo.*"  => "nullable|mimes:jpeg,png",
            ]);

        $empresa = Empresa::find(1);
        $empresa->fill($request->all());
        
        $domicilio[] =  [
                            "calle"    => $request->calle,
                            "altura"   => $request->altura,
                            "codigo"   => $request->codigo,
                            "pais"     => $request->pais,
                            "provincia"=> $request->provincia,
                            "localidad"=> $request->localidad,
                            "detalles" => $request->detalles,
                        ];

        $empresa->domicilio = $domicilio;

        $empresa->save();

        if($request->archivo) {                
            foreach ($request->archivo as $archivo => $value) {
                $logo = Multimedia::where('tipo', $request->tipo_file[$archivo])->first();
                
                if (!empty($logo)) {
                    $file = public_path().'/images/logos/'.$logo->nombre;
                    File::delete($file); 
                }

                $nombre_original = $value->getClientOriginalName();
                $extension = pathinfo($nombre_original, PATHINFO_EXTENSION); // jpg
                $nombre_interno= $request->tipo_file[$archivo].'.'.$extension;
                $path_file = public_path().'/images/logos/';
                $value->move($path_file,$nombre_interno);

                if (empty($logo)) {
                    Multimedia::create([
                        'tipo' => $request->tipo_file[$archivo],
                        'nombre' => $nombre_interno
                    ]);
                }
                else{
                    $logo->nombre = $nombre_interno;
                    $logo->save();
                }
            }
        }

        if ($request->tipo_telf) {
            $telefonos;
            foreach ($request->tipo_telf as $tipo_telf => $value) {
                $telefonos[] =   [
                                    "tipo" =>       $value,
                                    "numero" =>     $request->num_hide[$tipo_telf],
                                    "visible" =>    $request->num_show[$tipo_telf],
                                    "clickeable" => $request->tel_clickeable[$tipo_telf],
                                ];
            }
            $empresa->telefonos = $telefonos;
            $empresa->save();
        }

        if($request->email){
            $emails;
            foreach ($request->email as $email) {
                $emails[] = $email; 
            }
            $empresa->emails = $emails;
            $empresa->save();
        }

        Flash::success("Se ha actualizado la Información de general!!");
        return redirect()->route('info.empresa',  $data = 'general');
    }

    public function emails(Request $request)
    {
        $empresa = Empresa::find(1);
        $empresa->fill($request->all());
        $empresa->save();
        Flash::success("Se ha actualizado la Información de Emails de contacto!!");
        return redirect()->route('info.empresa',  $data = 'emails');
    }

    public function redes(Request $request)
    {
        $empresa = Empresa::find(1);
        if ($request->tipo) {
            $redes_sociales;
            foreach ($request->tipo as $tipo => $value) {
                $redes_sociales[] =   [
                                    "tipo" =>       $value,
                                    "enlace" =>     $request->enlace[$tipo]
                                ];
            }
            $empresa->redes_sociales = $redes_sociales;
            $empresa->save();
        }
        $empresa->save();
        Flash::success("Se ha actualizado la Información de Redes Sociales!!");
        return redirect()->route('info.empresa',  $data = 'redes');
    }

    public function terminos(Request $request)
    {
        $empresa = Empresa::find(1);
        $empresa->setTranslations('terminos', (array) $request->terminos);
        $empresa->save();
        Flash::success("Se ha actualizado la Información de Términos y condiciones!!");
        return redirect()->route('info.empresa',  $data = 'terminos');
    }

    public function metadatos()
    {
        try {
            $metadatos = Metadato::get();

            return Datatables::of($metadatos)->make(true);
            //return response()->json($metadatos);
        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en UsersController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.'
                ], 500);
        }
    }

    public function showmetadato($id)
    {
        try {
            $metadato= Metadato::find($id);
            return response()->json($metadato);
        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en UsersController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.'
                ], 500);
        }
    }

    public function savemetadato(Request $request, $seccion)
    {   
        $this->validate($request, 
            [
                "keywords"     => "required",
                "keywords.*"   => "required",
                "description"  => "nullable",
                "description.*"=> "nullable",
            ]);

        DB::beginTransaction();
        try {

            $metadato = Metadato::findOrFail($request->id);
            $metadato->fill($request->all()); 
            $metadato->save(); 
            
            DB::commit();
            return response()->json($request);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en InfoController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.'
                ], 500);
        }
    }
}
           

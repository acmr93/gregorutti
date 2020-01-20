<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metadato;
use App\Multimedia;
use App\Servicio;
use App\Cliente;
use App\Contenido;
use App\Empresa;
use Mail;
use Laracasts\Flash\Flash;

class PublicaController extends Controller
{
    public function home(){
    	$seccion = 'home';
        $metadato = Metadato::where('seccion', $seccion)->first();
		$slider = Multimedia::where([['seccion', $seccion],['tipo', 'slider']])->orderBy('orden')->get();
        // $features = Servicio::orderBy('orden')->get();
        // $contenido = Contenido::where('seccion',$seccion)->orderBy('orden')->get();
        $clientes = Cliente::orderBy('orden')->get();

        return view('publica.home',compact('seccion','metadato','slider','clientes'
            // ,'features','contenido','clientes'
        ));
    }

    public function empresa(){
    	$seccion = 'empresa';
        $metadato = Metadato::where('seccion', $seccion)->first();
		$banner = Multimedia::where([['seccion', $seccion],['tipo', 'banner']])->latest()->first();;
        $contenido = Contenido::where('seccion',$seccion)->orderBy('orden')->get();

        return view('publica.empresa',compact('seccion','metadato','banner','contenido'));
    }

    public function servicios(){
    	$seccion = 'servicios';
        $metadato = Metadato::where('seccion', $seccion)->first();
		$slider = Multimedia::where([['seccion', $seccion],['tipo', 'slider']])->orderBy('orden')->get();
		$features = Servicio::orderBy('orden')->get();

        return view('publica.servicios',compact('seccion','metadato','slider','features'));
    }

    public function personal(){
        $seccion = 'personal especializado';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $contenido = Contenido::where('seccion','extra')->orderBy('orden')->get();

        return view('publica.personal',compact('seccion','metadato','contenido'));
    }

    public function clientes(){
        $seccion = 'clientes';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $clientes = Cliente::orderBy('orden')->get();

        return view('publica.clientes',compact('seccion','metadato','clientes'));
    }

    public function contacto(){
        $seccion = 'contacto';
        $metadato = Metadato::where('seccion', $seccion)->first();

        return view('publica.contacto',compact('seccion','metadato'));
    }

    public function contact(Request $request){
        $empresa = Empresa::find(1);
        
        $subject = $empresa->nombre." - Mensaje de Contacto de la Pagina Web";
        
        $for = $empresa->email_contacto;

        Mail::send('publica.layouts.mail',$request->all(), function($msj) use($subject,$for){
            $msj->subject($subject);
            $msj->to($for);
        });

        if (count(Mail::failures()) > 0){
            Flash::error("Ha ocurrido un error al enviar el correo.");
            return back()->withErrors(['status' => "Ha ocurrido un error al enviar el correo"])->withInput($request);
        }
        else{
            Flash::success("Correo enviado correctamente.");
            return back()->with('status',"Correo enviado correctamente");
        }
    }
}

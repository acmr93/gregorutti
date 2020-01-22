<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metadato;
use App\Multimedia;
use App\Servicio;
use App\Cliente;
use App\Contenido;
use App\Empresa;
use App\Proyecto;
use App\Historia;
use Mail;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Mail\PresupuestoMail;
// use Illuminate\Support\Facades\Mail;

class PublicaController extends Controller
{
    public function home(){
    	$seccion = 'home';
        $metadato = Metadato::where('seccion', $seccion)->first();
		$slider = Multimedia::where([['seccion', $seccion],['tipo', 'slider']])->orderBy('orden')->get();
        $proyectos = Proyecto::whereIn('id', Empresa::find(1)->contenido_home['destacados'])->select('titulo', 'img', 'slug')->get();
        $servicios = Servicio::whereIn('id', Empresa::find(1)->contenido_home['servicios'])->select('titulo', 'icon')->get();
        $clientes = Cliente::orderBy('orden')->get();
        return view('publica.home',compact('seccion','metadato','slider','clientes','proyectos','servicios'));
    }

    public function empresa(){
    	$seccion = 'empresa';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $slider = Multimedia::where([['seccion', $seccion],['tipo', 'slider']])->orderBy('orden')->get();
        $contenido = Contenido::where('seccion',$seccion)->orderBy('orden')->get();
        $timeline = Historia::orderBy('epoca')->get();
        
        return view('publica.empresa',compact('seccion','metadato','slider','contenido','timeline'));
    }

    public function servicios(){
    	$seccion = 'servicios';
        $metadato = Metadato::where('seccion', $seccion)->first();
		$servicios = Servicio::orderBy('orden')->get();

        return view('publica.servicios',compact('seccion','metadato','servicios'));
    }

    public function sectores(){
        $seccion = 'sectores';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $sectores = Contenido::where('seccion','sectores')->orderBy('orden')->get();

        return view('publica.sectores',compact('seccion','metadato','sectores'));
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

    public function productos()
    {   
        $seccion = 'productos';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $productos = Contenido::where('seccion',$seccion)->orderBy('orden')->get();
        return view('publica.productos',compact('seccion','metadato','productos'));
    }

    public function producto($slug)
    {   
        $seccion = 'productos';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $productos = Contenido::where('seccion',$seccion)->orderBy('orden')->get();
        $producto = Contenido::where([['seccion', $seccion],['slug', $slug]])->first();
        return view('publica.producto',compact('seccion','metadato','producto','productos'));
    }

    public function proyectos()
    {   
        $seccion = 'proyectos';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $proyectos = Proyecto::orderBy('orden')->get();
        return view('publica.proyectos',compact('seccion','metadato','proyectos'));
    }

    public function proyecto($slug)
    {   
        $seccion = 'proyectos';
        $metadato = Metadato::where('seccion', $seccion)->first();
        $proyectos = Proyecto::orderBy('orden')->get();
        $proyecto = Proyecto::where('slug', $slug)->first();
        return view('publica.proyecto',compact('seccion','metadato','proyecto','proyectos'));
    }

    public function presupuesto(){
        $seccion = 'presupuesto';
        $metadato = Metadato::where('seccion', $seccion)->first();

        return view('publica.presupuesto',compact('seccion','metadato'));
    }

    public function sendpresupuesto(Request $request)
    {
        /*
        Esta función se encarga de enviar el formulario de presupuesto.
        */
        //Validación de los campos
        $request->validate([
           
            ]);
            $validator = Validator::make($request->all(), [
                        'nombre'    => 'required|max:120',
                        'empresa' => 'required|max:120',
                        'telefono' => 'required|max:120',
                        'localidad' => 'required|max:120',
                        'email' => 'required|max:120',
                        'mensaje' => 'required',
                        'file' => 'nullable|max:3048|mimes:pdf',
                        ]);
            if ($validator->fails()) {
                return redirect()->route('presupuesto')
                ->with('error', 'Error al validar los datos ingresados. Por favor, intente de nuevo.');
            }
        //Validación del captcha
        $secret = "6Ldbq5oUAAAAAMeEl8qxphxTxeoaPJl3uuDbUfHj";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$request["g-recaptcha-response"]}&remoteip=".$_SERVER['REMOTE_ADDR']);
        $response = json_decode($response, true);
        if($response["success"] == false){ 
            //return redirect()->route('solicitud-de-presupuesto')
                //->with('error', 'Error al validar Captcha. Por favor, intente de nuevo.');   
        }
        //Unset de los elementos que no me interesan almacenar
        unset($request['_token']);
        unset($request['g-recaptcha-response']);
        
        $empresa = Empresa::find(1);
        
        //Mail adonde se envía el formulario
        $mail = $empresa->email_contacto;
        if($mail == null){   //Si el usuario no especifica (en el panel) el mail adonde quiere recibir el formulario, este no se envía.
            return redirect()->route('presupuesto')
                ->with('error', 'Por el momento, no recibimos mensajes por este medio. Disculpe las molestias.');
        }

        //Envio de mail
        $mail = Mail::to($mail)->send(new PresupuestoMail($request->all()));
        if(count( Mail::failures() ) > 0){
            return redirect()->route('presupuesto')
                ->with('error', 'Error al enviar el formulario. Por favor, intente de nuevo.');
        } else {
            return redirect()->route('presupuesto')
                    ->with('success', 'El formulario se envió correctamente.');
        }
    }
}

@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')

<style type="text/css">
    .boton-rojo {
        color: #8B3135;
        border: 2px solid #8B3135;
    }
    .boton-rojo:hover {
        color: white;
        background-color: #8B3135;
    }

</style>

@endsection

@section('contenido')
    <div class="container my-5">
        @if(session('success'))
            <div div class="alert alert-success text-center" role="alert">
                <h3>{{session('success')}}</h3>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-center" role="alert">
                <h3>{{session('error')}}</h3>
            </div>
        @endif
        <div class="row">
        <div class="col-12 col-md-6" id="one">
            <!-- Primera parte del formulario -->
            <div class="row" id="one">
                <div class="d-flex flex-row">
                    <img src="{{asset('images/presupuesto.png')}}" class="img-fluid ml-5 mt-2">
                </div><br>
            </div>
            <div class="row">
                <div class="col-sm-3"><!-- Dummy --></div>
                <div class="col-sm-9">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-2">
                            <div class="form-group col-12">
                                    <input type="text" required name="nombre" placeholder="Nombre" class="form-control">
                                </div>
                            <div class="form-group col-12">
                                    <input type="text" required name="empresa" placeholder="Empresa" class="form-control">
                                </div>
                            <div class="form-group col-12">
                                    <input type="text" required name="telefono" placeholder="Teléfono" class="form-control">
                                </div>
                            <div class="form-group col-12">
                                    <input type="text" required name="localidad" placeholder="Localidad" class="form-control">
                                </div>
                            <div class="form-group col-12">
                                    <input type="email" required name="email" placeholder="Email" class="form-control">
                                </div>
                             <div class="form-group col-12">
                                    <button type="button" id="siguiente" onclick="hide()" class="btn btn-outline boton-rojo rounded-pill px-5 py-2 float-right mt-3">SIGUIENTE</button>
                                </div>
                        </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-md-6" id="two" style="display: none">
        <!-- Segunda parte del formulario -->
        <div class="row">
            <div class="d-flex flex-row">
                <img src="{{asset('images/presupuesto2.png')}}" class="img-fluid ml-5 mt-2">
            </div><br>
        </div>
        <div class="row">
            <div class="col-sm-3"><!-- Dummy --></div>
            <div class="col-sm-9">
                    <div class="form-group ">
                            <textarea required class="form-control" name="mensaje" rows="5" placeholder="Escriba aquí su consulta"></textarea>
                        </div>
                    <div class="form-group">
                        {!! Form::label('file', 'Archivo Adjunto') !!}
                        {!! Form::file('file', ['required' => 'required', 'class' => $errors->has('file') ? 'form-control is-invalid' : '']) !!}
                        <small>Solo archivos .pdf (2MB máximo)</small>
                        <small class="text-danger">{{ $errors->first('file') }}</small>
                    </div>
                    <div class="form-group  form-check">
                                <input onchange="terminosShow( this , 'btn' );" type="checkbox" required="true" class="form-check-input" id="terminos" name="terminos" value="1">
                                <label class="form-check-label" for="terminos" >
                                        Acepto los términos y condiciones de privacidad
                                </label>
                        </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-outline boton-rojo rounded-pill px-5 py-2 float-right mt-3" disabled id="btn">ENVIAR</button>
                        </div>
            </div>
        </div>
        </div>
        </form>
                </div>
    </div>

    <div class="modal" id="terminosModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terminos y condiciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                 {!!$empresa_->terminos!!}
                </div>
            </div>            
        </div>
    </div>
@endsection
@section('js')

<script type="text/javascript">

    terminosShow = ( t , btn ) => {

        if( $( t ).is( ":checked" ) ) {

            $( "#terminosModal" ).modal( "show" );

            $( `#${btn}` ).prop( "disabled" , false );

        } else

            $( `#${btn}` ).prop( "disabled" , true );

    };

    function hide(){
        var section = document.getElementById("two");
        var button  = document.getElementById("siguiente");
        button.style.display = "none";
        if (section.style.display === "block") {
            section.style.display = "none";
        } else {
            section.style.display = "block";
        }
    }
</script>

@endsection


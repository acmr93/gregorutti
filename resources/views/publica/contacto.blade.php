@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/contacto.css')}}">
@endsection

@section('contenido')

    {!!$empresa_->ubicacion_maps!!}
    
    <div class="container my-5  contact">
        <div class="row">
            <div class="col-12 col-md-4">
                <p>{{$empresa_->texto_secciones['contacto']}}</p>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-contact"><i class="fa fa-map-marker"></i></div>
                    <div class="col-8">
                           <a class="enlace-contact" target="_blank" href="{{$empresa_->enlance_maps}}" target="_blank">
                            {{$empresa_->domicilio[0]['calle']}} {{$empresa_->domicilio[0]['altura']}}, {{$empresa_->domicilio[0]['provincia']}}, {{$empresa_->domicilio[0]['pais']}}
                           </a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-contact"><i class="fa fa-phone"></i></div>
                    <div class="col-10">
                        @php $i = 0; @endphp
                        @if ($empresa_->telefonos != null)
                        @foreach($empresa_->telefonos as $telefono => $value)
                            @if($value['tipo'] == 'telefono')                       
                            {{($i>0?' / ':'')}}<a class="enlace-contact" href="tel:{{$value['numero']}}" target="_blank">
                                {{(isset($value['visible'])?$value['visible']:$value['numero'])}}
                            </a>
                            @php $i++; @endphp
                            @endif                            
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-contact"><i class="fa fa-paper-plane"></i></div>
                    <div class="col-8">
                        @if ($empresa_->emails != null)
                        @foreach($empresa_->emails as $email)
                            <a class="enlace-contact" href="mailto:{{$email}}" target="_blank">{{$email}}</a> <br>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                @include('flash::message')
                {!! Form::open(['method' => 'POST', 'route' => 'contact', 'class' => 'form-horizontal']) !!}
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            {!! Form::text('nombre', null, ['id'=> 'nombre', 'class' => $errors->has('nombre') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'placeholder' => 'Nombre']) !!}
                            <small class="text-danger">{{ $errors->first('nombre') }}</small>
                        </div>
                        <div class="form-group col-12 col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::email('email', null, ['id'=> 'email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'placeholder' => 'E-mail']) !!}
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            {!! Form::text('telefono', null, ['id'=> 'telefono', 'class' => $errors->has('telefono') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Teléfono']) !!}
                            <small class="text-danger">{{ $errors->first('telefono') }}</small>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            {!! Form::text('empresa', null, ['id'=> 'empresa', 'class' => $errors->has('empresa') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Empresa']) !!}
                            <small class="text-danger">{{ $errors->first('empresa') }}</small>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }} ">
                        {!! Form::textarea('mensaje', null, ['class' => $errors->has('mensaje') ? 'form-control is-invalid' : 'form-control', 'required' => 'required','placeholder' => 'Tu consulta va aquí', 'rows'=> 3]) !!}
                        <small class="text-danger">{{ $errors->first('mensaje') }}</small>
                    </div>
                
                        {!! Form::submit("Enviar", ['class' => 'btn btn-outline rounded-pill px-5 py-2 float-right mt-3']) !!}
                
                {!! Form::close() !!}
            </div>
        </div>           
    </div>
@endsection
@section('js')
<script type="text/javascript">

</script>

@endsection
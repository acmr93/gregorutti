@extends('publica.layouts.master')

@section('title', $empresa_->nombre)

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/slider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick-theme.css')}}"/>
@endsection

@section('contenido')

@include('publica.layouts.slider')

<div class="suelta container">
    <div class="d-flex align-items-center  justify-content-center">
        <img src="{{asset('loaded/home/'.$empresa_->contenido_home['suelta'])}}" class="img-fluid" height="140px">           
    </div>
</div>

<section class="clientes ">
    <div class="container py-4">
        <div class="clientes-slide ">
            @if ($clientes->count() > 0)
                @foreach ($clientes as $cliente)
                    <div class="text-center">
                        <a target="{{$cliente->url != null ?'_blank':''}}" href="{{$cliente->url != null ?$cliente->url:'#'}}">
                            <img class="img-fluid mx-auto" src="{{asset('loaded/clientes/'.$cliente->img[0]['nombre'])}}">
                        </a>
                    </div>
                @endforeach 
            @else
                <div>your content1</div>
                <div>your content2</div>
                <div>your content3</div>
            @endif
        </div>
    </div>
</section>

<section class="destacados">
    <div class="container text-center">
        <div class="titulo">PROYECTOS <b>DESTACADOS</b> </div>
    </div>
    <div class='items'>
        <div class="container">
            <div class="card-group">
            @if ($proyectos->count() > 0)
                @foreach ($proyectos as $proyecto)
                  <div class="card border-0 rounded-0">
                    <img src="{{asset('loaded/proyectos/'.$proyecto->img[0]['nombre'])}}" class="card-img-top border-0 rounded-0" alt="...">
                    <a href="{{route('proyecto', $proyecto->slug)}}" class="btn btn-outline-light rounded-pill px-4 boton">Ingresar</a>
                  </div>
                @endforeach 
            @endif            
            </div>
        </div>
    </div>
</section>

<section class="servicios">
    <div class='items'>
        <div class="container">
            <div class="row d-flex justify-content-around">
                @if ($servicios->count() > 0)
                    @foreach ($servicios as $servicio)
                        <div class="row por-servicio">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <img src="{{asset('loaded/servicios/'.$servicio->icon[0]['nombre'])}}" class="img-fluid border-0 rounded-0" alt="...">
                            </div>
                            <div class="col-12 d-flex align-items-end  justify-content-center pt-3">
                                <h4>{{ucwords(mb_strtolower($servicio->titulo))}}</h4>
                            </div>
                        </div>
                    @endforeach 
                @endif 
            </div>
        </div>
    </div>
</section>

<section class="presupuesto" style="background-image: url(&quot;{{asset('loaded/home/'.$empresa_->contenido_home['img_presupuesto'])}}&quot;)">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h3><b>Pedí tu presupuesto a profesionales</b></h3>
                <h2>FÁCIL, RÁPIDO Y SIN CARGO</h2>
                <h4>Ingresá al formulario para enviar una solicitud de presupuesto sin cargo.</h4>
                <a href="{{route('presupuesto')}}" class="btn btn-outline-light rounded-pill px-4 boton mt-2">Ingresar</a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script type="text/javascript" src="{{asset('plugins/slick/slick.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.clientes-slide').slick({
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 5,
            autoplay: true,
            autoplaySpeed: 2500,
        });
    });
</script>
@endsection
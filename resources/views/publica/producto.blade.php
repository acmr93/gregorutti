@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/navlateral.css')}}">
    <link rel="stylesheet" href="{{asset('css/producto.css')}}">
@endsection

@section('contenido')

<section class="section my-5">
    <div class="container">
        <ol class="breadcrumb bg-transparent border-0 p-0 mb-4">
            <li class="breadcrumb-item "><a href="{{route('productos')}}">Productos</a></li>
            <li class="breadcrumb-item " aria-current="page">{{ ucfirst(mb_strtolower($producto->titulo))}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3 pr-5">
                <div class="sticky-top">
                    <div class="nav flex-column ">
                        @foreach ($productos as $item)
                            <a href="{{route('producto', $item->slug)}}" class="nav-link lateral
                                @if ($item->titulo == $producto->titulo)
                                    active
                                @endif ">
                                {{strtoupper($item->titulo)}}
                            </a>
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-9 pl-5" id="main">
                <div class="row">
                    @if(count($producto->img) > 1)
                        <div class="col-12 px-5 mb-3">
                            <div class="slider-for ">
                                @for ($i = 1; $i < count($producto->img); $i++)
                                    <div class="text-center">
                                        <img id="imagen" src="{{asset('loaded/contenido/'.$producto->img[$i]['nombre'])}}"  class="img-fluid mx-auto">
                                    </div>       
                                @endfor
                            </div>
                            <div class="slider-nav ">
                                @for ($j = 1; $j < count($producto->img); $j++)
                                    <div class="text-center mx-2">
                                        <img id="imagen" src="{{asset('loaded/contenido/'.$producto->img[$j]['nombre'])}}"  class="img-fluid">
                                    </div>       
                                @endfor
                            </div>
                        </div>
                    @endif
                    <div class="col-12 px-5">
                        <h5 class="box-contenido-titulo mb-3">{{$producto->titulo}}</h5> {!! $producto->texto1 !!} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
<script type="text/javascript" src="{{asset('plugins/slick/slick.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            fade: true,
            asNavFor: '.slider-nav',
            
        });

        $('.slider-nav').slick({
            respondTo: 'slider', //makes the slider to change width depending on the container it is in
            adaptiveHeight: true,
            autoSlidesToShow: true,
            asNavFor: '.slider-for',
            focusOnSelect: true,
            arrows: false,
            variableWidth: true,
            infinite: false,
            autoplay: true,
            autoplaySpeed: 3000
        });
    });
</script>
@endsection
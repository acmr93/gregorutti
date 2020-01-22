@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/navlateral.css')}}">
    <style type="text/css">
        .box-contenido-titulo{
            color: #343434;
            font-weight: 400
        }
        .subtexto-contenido{
            font-size: 21px;
        }
    </style>
@endsection

@section('contenido')

<section class="section my-5">
    <div class="container">
        <ol class="breadcrumb bg-transparent border-0 p-0 mb-4">
            <li class="breadcrumb-item "><a href="{{route('proyectos')}}">Productos</a></li>
            <li class="breadcrumb-item " aria-current="page">{{ ucfirst(mb_strtolower($proyecto->titulo))}}</li>
        </ol>
        <div class="row">
            <div class="col-12 col-md-3 pr-5 mb-4">
                <div class="sticky-top">
                    <div class="nav flex-column ">
                        @foreach ($proyectos as $item)
                            <a href="{{route('proyecto', $item->slug)}}" class="nav-link lateral
                                @if ($item->titulo == $proyecto->titulo)
                                    active
                                @endif ">
                                {{strtoupper($item->titulo)}}
                            </a>
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9" id="main">
                @if ($proyecto->texto != null)
                @foreach ($proyecto->texto as $key => $value)
                    @if($loop->iteration  % 2 == 0)
                        <div class="row mb-5 ">
                            <div class="col-12 col-md-6 texto-contenido pb-sm-5 pb-md-0">
                                <h3 class="box-contenido-titulo">{{$value['subproyecto']}}</h3>
                                <div class="subtexto-contenido">{{$value['texto']}}</div>
                            </div>
                            <div class="col-12 col-md-6 text-center ">
                                <img  src="{{asset('loaded/proyectos/'.$value['img'])}}" class="img-fluid shadow  mx-auto">
                            </div>
                        </div>                        
                    @else
                        <div class="row mb-5">
                            <div class="col-12 col-md-6 text-center "><img  src="{{asset('loaded/proyectos/'.$value['img'])}}" class="img-fluid shadow mx-auto"></div>
                            <div class="col-12 col-md-6 texto-contenido  pt-sm-5 pt-md-0 ">
                                <h3 class="box-contenido-titulo">{{$value['subproyecto']}}</h3>
                                <div class="subtexto-contenido">{{$value['texto']}}</div>
                            </div>
                        </div>                        
                    @endif
                @endforeach            
                @endif           
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')

@endsection
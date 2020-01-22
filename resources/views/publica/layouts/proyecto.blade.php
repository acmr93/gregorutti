@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/navlateral.css')}}">
@endsection

@section('contenido')

<section class="section my-5">
    <div class="container">
        <ol class="breadcrumb bg-transparent border-0 p-0 mb-4">
            <li class="breadcrumb-item "><a href="{{route('proyectos')}}">Productos</a></li>
            <li class="breadcrumb-item " aria-current="page">{{ ucfirst(mb_strtolower($proyecto->titulo))}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3 pr-5">
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
            <div class="col-9 pl-5" id="main">
                hola           
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
<script type="text/javascript" src="{{asset('plugins/slick/slick.min.js')}}"></script>

<script type="text/javascript">

</script>
@endsection
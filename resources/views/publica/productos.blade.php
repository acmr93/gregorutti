@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="productos my-5">
    <div class="row texto-suelto mb-5">
        <div class="col-3 line"></div>
        <div class="col-6 px-5">{{$empresa_->texto_secciones['productos']}} </div>
        <div class="col-3 line"></div>
    </div>
    <div class="container">
        <div class="row row-cols-3">
        @if ($productos->count() > 0)
            @foreach ($productos as $producto)
            <div class="col mb-3 px-2">
                <div class="card border-0 rounded-0 text-white">
                    <a href="{{route('producto', $producto->slug)}}" class="text-white">
                        <img src="{{asset('loaded/contenido/'.$producto->img[0]['nombre'])}}" class="card-img-top border-0 rounded-0" alt="...">
                        <h5 class="card-title float-left">{{$producto->titulo}}</h5>
                        <div class="card-img-overlay text-center d-flex align-items-center">
                            {!!$producto->texto1!!}
                        </div>                        
                    </a>
                </div>
            </div>
            @endforeach 
        @endif
        </div>
    </div>
</section>



@endsection

@section('js')

<script type="text/javascript">

</script>
@endsection
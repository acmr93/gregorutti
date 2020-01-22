@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="servicios my-5 ">
    <div class="row texto-suelto mb-5">
        <div class="col-3 line"></div>
        <div class="col-6 px-5">{{$empresa_->texto_secciones['servicios']}} </div>
        <div class="col-3 line"></div>
    </div>
    <div class='items'>
        <div class="container">
            <div class="row row-cols-3">
            @if ($servicios->count() > 0)
                @foreach ($servicios as $servicio)
                <div class="col mb-3 px-2">
                    <div class="card border-0 rounded-0 text-white">
                        <img src="{{asset('loaded/servicios/'.$servicio->img[0]['nombre'])}}" class="card-img-top border-0 rounded-0" alt="...">
                        <h5 class="card-title float-left">{{$servicio->titulo}}</h5>
                        <div class="card-img-overlay text-center d-flex align-items-center">
                            <p>{{$servicio->texto}}</p>
                        </div>
                    </div>
                </div>
                @endforeach 
            @endif
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')

<script type="text/javascript">

</script>
@endsection
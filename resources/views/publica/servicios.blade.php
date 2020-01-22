@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | Servicios')

@section('css')
    <link rel="stylesheet" href="{{asset('css/servicios.css')}}">
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="servicios">
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
@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="servicios my-5 ">
    <div class="row texto-suelto mb-5">
        <div class="col-3 line"></div>
        <div class="col-6 px-5">{{$empresa_->texto_secciones['clientes']}} </div>
        <div class="col-3 line"></div>
    </div>
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-12">
                <div class="row row-cols-1 row-cols-md-3 justify-content-center">
                    @foreach ($clientes as $cliente)
                        <div class="col mb-3 px-2 text-center">
                            <a target="{{$cliente->url != null ?'_blank':''}}" href="{{$cliente->url != null ?$cliente->url:'#'}}">
                                <img class="img-fluid mx-auto shadow" src="{{asset('loaded/clientes/'.$cliente->img[0]['nombre'])}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')

<script type="text/javascript">

</script>
@endsection


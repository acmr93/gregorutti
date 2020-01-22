@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | Clientes')

@section('css')
    <link rel="stylesheet" href="{{asset('css/servicios.css')}}">
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="servicios my-5 ">
    <div class="row texto-suelto mb-5">
        <div class="col-3 line"></div>
        <div class="col-6 px-5">{{$empresa_->texto_secciones['servicios']}} </div>
        <div class="col-3 line"></div>
    </div>
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-12">
                <div class="row row-cols-3">
                    @foreach ($clientes as $cliente)
webop
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


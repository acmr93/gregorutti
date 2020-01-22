@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion))

@section('css')
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="proyectos my-5">
    <div class="container">
        <div class="row row-cols-3">
        @if ($proyectos->count() > 0)
            @foreach ($proyectos as $proyecto)
            <div class="col mb-3 px-2">
                <div class="card border-0 rounded-0 text-white">
                    <a href="{{route('proyecto', $proyecto->slug)}}" class="text-white">
                        <img src="{{asset('loaded/proyectos/'.$proyecto->img[0]['nombre'])}}" class="card-img-top border-0 rounded-0" alt="...">
                        <h5 class="card-title float-left">{{$proyecto->titulo}}</h5>                        
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
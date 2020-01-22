@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | Sectores')

@section('css')
    <link rel="stylesheet" href="{{asset('css/grid.css')}}">
@endsection

@section('contenido')

<section class="sectores">
    <div class='items'>
        <div class="container">
            <div class="row row-cols-3">
            @if ($sectores->count() > 0)
                @foreach ($sectores as $servicio)
                <div class="col mb-3 px-2">
                    webo
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
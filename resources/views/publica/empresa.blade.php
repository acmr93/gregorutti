@extends('publica.layouts.master')

@section('title', $empresa_->nombre.' | Empresa')

@section('css')
    <link rel="stylesheet" href="{{asset('css/empresa.css')}}">
    <link rel="stylesheet" href="{{asset('css/slider.css')}}">
    <link rel="stylesheet" href="{{asset('css/timeline.css')}}">
@endsection

@section('contenido')

@include('publica.layouts.slider')

<section class="box-contenido">
    <div class="container">
        @if($contenido->count() > 0)
            @foreach ($contenido->slice(0,1) as $contenido1)
                <div class="row first">
                    <div class="col-12 col-md-6 texto-contenido">
                        <div class="subtexto-contenido px-2">{!! $contenido1->texto1 !!}</div>
                    </div>
                    <div class="col-12 col-md-6 text-center"><img  src="{{asset('loaded/contenido/'.$contenido1->img[0]['nombre'])}}" class="img-fluid text-center shadow"></div>
                </div>
            @endforeach
    </div>

    <div class="timeline-block">
        @if (count( $timeline ) > 0)
            <div class="container ">
                <div class="cd-horizontal-timeline">
                      <div class="timeline">
                          <div class="events-wrapper">
                              <div class="events">
                                  <ol>
                                      @for( $i = 0 ; $i < count( $timeline ) ; $i++ )
                                          <li><a href="#0" data-date="01/01/{{ $timeline[ $i ][ 'epoca' ] }}" @if( $i == 0 ) class="selected" @endif>{{ $timeline[ $i ][ 'epoca' ] }}</a></li>
                                      @endfor
                                  </ol>
                                  <span class="filling-line" aria-hidden="true"></span>
                              </div> <!-- .events -->
                          </div> <!-- .events-wrapper -->
                              
                          <ul class="cd-timeline-navigation">
                              <li><a href="#0" class="prev inactive">Prev</a></li>
                              <li><a href="#0" class="next">Next</a></li>
                          </ul> <!-- .cd-timeline-navigation -->
                      </div> <!-- .timeline -->              
                    <div class="events-content">
                        <ol>
                            @for( $i = 0 ; $i < count( $timeline ) ; $i++ )
                            <li  @if( $i == 0 ) class="selected" @endif data-date="01/01/{{ $timeline[ $i ][ 'epoca' ] }}">
                                @if( !empty( $timeline[ $i ][ 'texto'] ) )
                                <div class="my-3">{!! $timeline[ $i ][ 'texto'] !!}</div>
                                @endif
                            </li>
                            @endfor
                        </ol>
                    </div> <!-- .events-content -->
                </div>
            </div>
        @endif
    </div>

    <div class="segundo-contenido">
            @foreach ($contenido->slice(1) as $contenido)
                @if($loop->iteration  % 2 == 0)
                <div class="fila">
                    <div class="container">
                        <div class="row box-item">
                            <div class="col-12 col-md-6 texto-contenido px-0 pb-sm-5 pb-md-0">
                                <h2 class="box-contenido-titulo">{!! $contenido->titulo !!}</h2>
                                <div class="subtexto-contenido">{!! $contenido->texto1 !!}</div>
                            </div>
                            <div class="col-12 col-md-6 text-center">
                                <img  src="{{asset('loaded/contenido/'.$contenido->img[0]['nombre'])}}" class="img-fluid shadow  mx-auto">
                            </div>
                        </div>                        
                    </div>
                </div>

                @else
                <div class="fila">
                    <div class="container">
                        <div class="row box-item">
                            <div class="col-12 col-md-6 text-center"><img  src="{{asset('loaded/contenido/'.$contenido->img[0]['nombre'])}}" class="img-fluid shadow mx-auto"></div>
                            <div class="col-12 col-md-6 texto-contenido px-0 pt-sm-5 pt-md-0">
                                <h2 class="box-contenido-titulo">{!! $contenido->titulo !!}</h2>
                                <div class="subtexto-contenido">{!! $contenido->texto1 !!}</div>
                            </div>
                        </div>                        
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
</section>


@endsection

@section('js')
    <script src="{{asset('js/timeline.js')}}"></script>
@endsection
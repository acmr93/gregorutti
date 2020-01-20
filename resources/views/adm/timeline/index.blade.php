@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Linea de Tiempo')

@section('css')
  <link rel="stylesheet" href="{{asset('css/timeline.css')}}">
@endsection

@section('contenido')

<div class="row">
@if (count( $timeline ) > 0)
    <div class="col-12">
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
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Contenido de Timeline en Empresa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <th>Epoca</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @if($timeline->count() > 0)
                    @foreach ($timeline as $timeline)
                    <tr>
                      <td>{{$timeline->epoca}}</td>
                      <td>{{$timeline->texto}}</td>
                      <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['timeline.destroy', $timeline->id], 'class' => 'form-horizontal']) !!}
                            <a href="{{route('timeline.form',$timeline->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Esta seguro de eliminar?')"><i class="fas fa-trash"></i></button>
                        {!! Form::close() !!}                           
                      </td>
                    </tr>                       
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-muted text-center">
                            Ningún dato disponible en esta tabla
                        </td>
                    </tr>
                @endif
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a class="btn btn-info float-right" href="{{route('timeline.form')}}"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <!-- /.card -->           
    </div>
</div>    

@endsection

@section('js')
    <script src="{{asset('js/timeline.js')}}"></script>

@endsection


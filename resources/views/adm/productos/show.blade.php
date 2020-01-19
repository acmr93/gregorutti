@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| '. ($seccion == 'productos'?ucfirst($seccion):ucfirst($seccion).' - Contenido') )

@section('css')
  	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

	<style type="text/css">
	    .control {
	    	margin:auto;
	    	display:block;
	        max-width:100%;
	        max-height:100px;
	    }
	  	#sortable { list-style-type: none;  }
  </style>
@endsection

@section('contenido')

<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="card card-primary">
		    <div class="card-header">
		      	<h3 class="card-title">{{ucfirst($seccion)}}</h3>	    	
		      		
		    	<div class="card-tools">
		    		<a href="{{route(''.$seccion.'.contenido.id',$contenido->id)}}" class="btn btn-tool btn-sm handle"><i class="fas fa-edit"></i></a>
				</div>	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
	    		{!! Form::hidden('seccion', (isset($contenido)?$contenido->seccion:$seccion)) !!}
		    	{!! Form::hidden('id', (isset($contenido)?$contenido->id:null)) !!}

		    	<div class="row">
		    		
		    		<div class="col-md-6 col-sm-12">
			    		<div class="form-group{{ $errors->has('orden') ? ' has-error' : '' }}">
				    	    {!! Form::label('text', 'Orden:') !!}
				    	    {!! Form::text('orden',  (isset($contenido)?$contenido->orden:null), ['class' => 'form-control', 'required' => 'required', 'readonly' => true]) !!}
				    	    <small class="text-danger">{{ $errors->first('orden') }}</small>
				    	</div>
						@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			          	<div class="form-group{{ $errors->has('titulo[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('titulo['.$key.']', 'Titulo:') !!}
				    	    {!! Form::text('titulo['.$key.']', (isset($contenido) ? $contenido->getTranslation('titulo', $key) : null) , ['class' => 'form-control', 'required' => 'required', 'readonly' => true]) !!}
				    	    <small class="text-danger">{{ $errors->first('titulo['.$key.']') }}</small>
				    	</div>
				        @endforeach
		    		</div>
		    		<div class="col-md-6 col-sm-12">
						@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
						<div class="form-group{{ $errors->has('texto1[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('texto1['.$key.']', 'Texto:') !!}
				    	    {!! Form::textarea('texto1['.$key.']', (isset($contenido) ? $contenido->getTranslation('texto1', $key) : null) , ['class' => 'form-control textarea note-editable', 'rows' => 2]) !!}
				    	    <small class="text-danger">{{ $errors->first('texto1['.$key.']') }} </small>
				    	</div>
				        @endforeach
		    		</div>
		    		<div class="col-12">
				    	<div id="preview">	
							<ul id="sortable" class="row">
								@foreach ($contenido->img as $imagen => $value)
								  <li  id="img_id-{{$value['id']}}" class="col-12 col-md-3">
									<div class="card">
										<div class="card-header">
									        <div class="card-tools">
									          <a class="btn btn-tool btn-sm handle" title="Mover" style="color: black">
									            <i class="fas fa-arrows-alt"></i>
									          </a>
									          <button type="button" class="btn btn-tool btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" style="margin-left:2.5px;color: black" OnClick="deleteImage({{$value['id']}})"><i class="fas fa-trash"></i></button>
									        </div>
											<!-- /.card-tools -->
										</div>
										<!-- /.card-header -->
										<div class="card-body">
										 	<img id="imagen" src="{{asset('loaded/contenido/'.$value['nombre'])}}"  class="control">
										</div>
										<!-- /.card-body -->
									</div>
								  </li>
								@endforeach
							</ul>
						</div>
		    		</div>
		    	</div>

			</div>
		    <!-- /.card-body -->
		  </div>
		  <!-- /.card -->			
		</div>
	</div>
<!-- /.row -->

@endsection

@section('js') 

<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('plugins/summernote/lang/summernote-es-ES.min.js')}}"></script>

<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
 	$.widget.bridge('uibutton', $.ui.button)

// Summernote
$('.textarea').summernote({
	lang: 'es-ES',
	colors: [
        ['white', 'black','red', 'green', 'blue'], //first line of colors
        ['#1D3278', '#2AB0E1', '#3E3F44', '#505050'] //second line of colors
    ],
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['font', ['strikethrough', 'superscript', 'subscript']],
	    ['color', ['forecolor']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['insert', ['link', 'table', 'hr']],
		['view', [ 'codeview','undo', 'redo']],
	  ]
})
	$('.note-editable').attr('contenteditable', false);


	$("#sortable").sortable({
		connectWith: '#sortable ul',
	    placeholder         : 'sort-highlight',
	    handle              : '.handle',
	    forcePlaceholderSize: true,
	    zIndex              : 999999,
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            console.log(data);
            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
          		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{route('images.reposition',$contenido->id)}}',
                success: function(res){ 
		            var children = $('#sortable').sortable('refreshPositions').children();
		            var i = 0;
			        $.each(children, function() {
			        	i++;	
			        	$(this).attr('id', 'img_id-'+i);
			        });
		          }
            });
        },
	});


function deleteImage(id){
  Swal.fire({
    title: '¿Estás seguro que quiere eliminar?',
    text: "Esta acción no podra ser revertida!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar',
    cancelButtonText: 'No, cancelar',
    showLoaderOnConfirm: true,
    preConfirm: function() {
      return new Promise(function(resolve, reject) {
        var route = ruta+'/productos/images/delete/'+ {{$contenido->id}} +'/'+id;
        $.ajax({
          url: route,
          type: 'DELETE',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(res){ 
            resolve()
            document.getElementById('img_id-'+res.id).remove();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Error',
              'Ha ocurrido un error al tratar de eliminar la imagen. Status: '+jqXHR.status,
              'error'
            )
          }
        })
      });
    },
    allowOutsideClick: false    
  }).then((result) => {
      if (result.value) {
        Swal.fire(
            'Exito!',
            'Se ha eliminado la imagen',
            'success'
          )
      }
    });
}

</script>

@endsection


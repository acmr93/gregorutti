@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Servicios')

@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<style type="text/css">
.control {
    max-width:100%;
    max-height: 150px;
}
</style>
@endsection

@section('contenido')

<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="card card-primary">
		    <div class="card-header">
		      	<h3 class="card-title">Servicios</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	
		    	<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Orden</th>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Imagenes</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if($servicios->count() > 0)
    	              	@foreach ($servicios as $servicio)
							<tr>
								<td>{{$servicio->orden}}</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$servicio->getTranslation('titulo', $key)}}
									@endforeach
								</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$servicio->getTranslation('texto', $key)}}
									@endforeach
								</td>
								<td>
									@if ($servicio->img != null)
										@foreach ($servicio->img as $key => $value)
											<a href="{{asset('loaded/servicios/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
									@if ($servicio->icon != null)
										@foreach ($servicio->icon as $key => $value)
											<a href="{{asset('loaded/servicios/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
								</td>
								<td>
									{!! Form::open(['method' => 'DELETE', 'route' => ['servicios.destroy', $servicio->id], 'class' => 'form-horizontal']) !!}
									<a href="{{route('servicios.form.id',$servicio->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
										<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Esta seguro de eliminar?')"><i class="fas fa-trash"></i></button>
									{!! Form::close() !!}	                      	
								</td>
							</tr>                  		
	                  	@endforeach
                  	@endif
                  </tbody>
                </table>
			</div>
		  </div>
		  <!-- /.card -->			
		</div>
	</div>
<!-- /.row -->
<a class="btn btn-info flotante" href="{{route('servicios.form.id')}}"><i class="fas fa-plus"></i></a>
@endsection

@section('js')
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript">

$(".table").DataTable({
  processing: true,
  order: [[ 0, "desc" ]],
  scrollY:  "500px",
  scrollCollapse: true,
  language: leng,
  "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
  "columnDefs": [
    { "orderable": false, "targets": [3,4] }
  ]
});

</script>

@endsection


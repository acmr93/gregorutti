@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Empresa - Metadatos')

@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

@endsection

@section('contenido')

<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Metadatos</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tabla-metadatos" width="100%" >
          <thead>
              <tr>
                  <th>Seccion</th>
                  <th>Palabras</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
              </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- /.card -->     
  </div>
<a href='javascript:void(0)' class="btn btn-info flotante"  id="actualizar-metadatos" title="Actualizar"><i class="fas fa-sync-alt pt-2"></i></a>

</div>

@include('adm.info.formeta')


@endsection

@section('js')

<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/metadatos.js')}}"></script>

<script type="text/javascript">

</script>
@endsection


@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Clientes')

@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

  <style type="text/css">
    .control {
        max-width:50%;
        max-height: 50%;
    }
  </style>
@endsection

@section('contenido')

<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Clientes</h3>
        <div class="card-tools">
          <a href='javascript:void(0)' class="btn btn-tool btn-sm actualizar-clientes" title="Actualizar">
            <i class="fas fa-sync-alt"></i>
          </a>
        </div>

      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tabla-clientes" width="100%" >
          <thead>
              <tr>
                  <th>Orden</th>
                  <th>Nombre</th>
                  <th>URL</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
              </tr>
          </thead>
        </table>
      </div>
      <div class="card-footer text-right">
          <a href='javascript:void(0)' class="btn btn-default actualizar-clientes"  title="Actualizar"><i class="fas fa-sync-alt"></i></a>
      </div>
    </div>
    <!-- /.card -->     
  </div>
</div>

<a href="#" class="btn btn-info flotante" data-toggle="modal" data-target="#modal-cliente" title="Agregar">
  <i class="fas fa-plus"></i>
</a>

@include('adm.clientes.form')

@endsection

@section('js')

<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/clientes.js')}}"></script>

<script type="text/javascript">

</script>
@endsection


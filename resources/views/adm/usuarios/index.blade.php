@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| Usuarios')

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
        <h3 class="card-title">USUARIOS</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tabla-usuarios" width="100%" >
          <thead style="">
            <tr>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="card-footer text-right">
          <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal-user" title="Agregar" style="margin-left: 5px">
            <span class="text-success"><i class="fas fa-plus"></i></span>
          </button>
          <a href='javascript:void(0)' class="btn btn-default "  id="actualizar-user" title="Actualizar"><i class="fas fa-sync-alt"></i></a>
      </div>
    </div>
    <!-- /.card -->     
  </div>
</div>

@include('adm.usuarios.form')

@endsection

@section('js')

<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/user.js')}}"></script>

<script type="text/javascript">

</script>
@endsection


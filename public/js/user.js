var tabla_usuarios = $("#tabla-usuarios").DataTable({
  processing: true,
  serverSide: true,
  ajax: ruta+'/usuarios/listar',
  search: { "caseInsensitive": true },
  columns: [
  { data: 'name', name: 'name'},
  { data: 'username', name: 'username'},
  { data: 'email', name: 'email'},
  { data: 'rol', name: 'rol'},
  { data: 'id',
    'orderable': false,
    render: function ( data, type, full, meta ) {
      var text = '<div class="text-center ">'+
      '<button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" OnClick="UsuarioActual('+data+')"><i class="fas fa-edit"></i></button>'+
      '<button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar" style="margin-left:2.5px;" OnClick="deleteUsuario(' + data + ')"><i class="fas fa-trash"></i></button>'+
      '</div>'; 
      return text;
    }
  }],
  order: [[ 0, "desc" ]],
  scrollY:  "500px",
  scrollCollapse: true,
  language: leng,
  "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
});

$('#actualizar-user').click(function(){
  tabla_usuarios.ajax.reload();
})


function deleteUsuario(id){
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
        var route = ruta+'/usuarios/'+id;
        $.ajax({
          url: route,
          type: 'DELETE',
          headers: {'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value},
          success: function(res){ 
            resolve()
            tabla_usuarios.ajax.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Error',
              'Ha ocurrido un error al tratar de eliminar al empleado. Status: '+jqXHR.status,
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
            'Se ha eliminado el usuario',
            'success'
          )
      }
    });
}

function Usuario(){
  this.id = $('#id').val();
  this.name = $('#name').val();
  this.username = $('#username').val();
  this.rol = $('#rol').val();
  this.email = $('#email').val();
  this.password = $('#password').val();
  this.password_confirmation = $('#password_confirmation').val();
}

function starLoad_cargarsito(btn){
  $(btn).button('loading');
  $('.load-ajax').addClass('overlay');
  $('.load-ajax').html('<i class="fa fa-refresh fa-spin"></i>');
} 

function endLoad_descargansito(btn){
  $(btn).button('reset');
  $('.load-ajax').removeClass('overlay');
  $('.load-ajax').fadeIn(1000).html("");
} 

function removeStyleUsuario(){
  $('.form-control').removeClass('is-invalid');
  $('.text-danger').text('');
}

function UsuarioActual(id){
  $.ajax({
    url: ruta+'/usuarios/'+id,
    type: 'GET',
    success: function(res){ 
      $('#id').val(res.id);
      $('#name').val(res.name);    
      $('#username').val(res.username);    
      $('#rol').val(res.rol);
      $('#email').val(res.email);
      $('#modal-user').modal('show'); 
    },
    error: function(jqXHR, textStatus, errorThrown) {
      Swal.fire(
        'Error',
        'Ha ocurrido un error al tratar de obtener los datos. Status: '+jqXHR.status,
        'error'
      )
    }
  });
}

$('#guardar').click(function(){
  var type = "";
  var route = "";
  var btn = this
  starLoad_cargarsito(btn)
  var data = new Usuario();
  if(data.id == "" || data.id == null || data.id == undefined){
    type = 'POST';
    route = ruta+'/usuarios';
  }else{
    type = 'PUT';
    route = ruta+'/usuarios/'+data.id
  }
  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value},
    type: type,
    dataType: 'json',
    data: data,
    success: function(res){
      endLoad_descargansito(btn)
      removeStyleUsuario();
      $('#modal-user').modal('hide');
      Swal.fire(
        'Exito!',
        'Se ha guardado el usuario',
        'success'
      )
    },
    error: function(jqXHR, textStatus, errorThrown){
      endLoad_descargansito(btn)
      if(jqXHR.status == 422){
        removeStyleUsuario()
        if(jqXHR.responseJSON.errors.name){
          $('#name').addClass("is-invalid");
          $('#field-name .text-danger').html(jqXHR.responseJSON.errors.name);
        }
        if(jqXHR.responseJSON.errors.username){
          $('#username').addClass("is-invalid");
          $('#field-username .text-danger').html(jqXHR.responseJSON.errors.username);
        }          
        if(jqXHR.responseJSON.errors.email){         
          $('#email').addClass("is-invalid");
          $('#field-email .text-danger').html(jqXHR.responseJSON.errors.email);
        }
        if(jqXHR.responseJSON.errors.rol){         
          $('#rol').addClass("is-invalid");
          $('#field-rol .text-danger').html(jqXHR.responseJSON.errors.rol);
        }
        if(jqXHR.responseJSON.errors.password){         
          $('#password').addClass("is-invalid");
          $('#field-password .text-danger').html(jqXHR.responseJSON.errors.password);
        }
        if(jqXHR.responseJSON.errors.password_confirmation){         
          $('#password_confirmation').addClass("is-invalid");
          $('#field-password_confirmation .text-danger').html(jqXHR.responseJSON.errors.password_confirmation);
        }
      }
      else{
        Swal.fire(
          'Error',
          'No pudo completarse el proceso',
          'error'
        )
      }
    }
  });
});


$('#modal-user').on('hidden.bs.modal', function (e) 
{ 
  $('#form-user')[0].reset();
  $('#id').val('');
  removeStyleUsuario();
  tabla_usuarios.ajax.reload();
});
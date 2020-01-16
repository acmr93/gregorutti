var tabla_clientes = $("#tabla-clientes").DataTable({
  processing: true,
  serverSide: true,
  ajax: ruta+'/clientes/listar',
  search: { "caseInsensitive": true },
  columns: [
  { data: 'orden', name: 'orden'},
  { data: 'nombre.es', name: 'nombre.es'},
  { data: 'url', name: 'url'},
  { data: 'img',
    'orderable': false,
    render: function ( data, type, full, meta ) {
      var text = '<img id="imagen" src="'+public+'/loaded/clientes/'+ data+'" class="control">'; 
      return text;
    }
  },
  { data: 'id',
    'orderable': false,
    render: function ( data, type, full, meta ) {
      var text = '<div class="text-center ">'+
      '<button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" OnClick="showFamilia('+ data + ')"><i class="fas fa-edit"></i></button>'+
      '<button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar" style="margin-left:2.5px;" OnClick="deleteFamilia(' + data + ')"><i class="fas fa-trash"></i></button>'+
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

$('.actualizar-clientes').click(function(){
  tabla_clientes.ajax.reload();
})

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

function removeStyleMetadato(){
  $('.form-control').removeClass('is-invalid');
  $('.custom-file-input').removeClass('is-invalid');
  $('.text-danger').text('');
}

function showFamilia(id){
  $.ajax({
    url: ruta+'/clientes/'+id,
    type: 'GET',
    success: function(res){ 
      $('#id').val(res.id);
      $('#orden').val(res.orden);
      document.getElementById("nombre.es").value = res.nombre.es;
      $('#url').val(res.url);
      $('#img_cliente').attr('src',''+public+'/loaded/clientes/'+ res.img);
      $('#modal-cliente').modal('show'); 
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

$('#guardar_cliente').click(function(){
  let myForm = document.getElementById('form-cliente');
  let formData = new FormData(myForm);
  formData.append('file_cliente',$('#file_cliente').val());
  var type = "";
  var route = "";
  var btn = this
  starLoad_cargarsito(btn)
    type = 'POST';
    route = ruta+'/clientes';

  $.ajax({
    url:  route,
    headers: {'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value},
    type: type,
    dataType: 'json',
    data: formData,
    processData: false,
    contentType: false,
    success: function(res){
      endLoad_descargansito(btn)
      removeStyleMetadato();
      $('#modal-cliente').modal('hide');
      Swal.fire(
        'Exito!',
        'Se ha guardado el cliente',
        'success'
      )
    },
    error: function(jqXHR, textStatus, errorThrown){
      endLoad_descargansito(btn)
      if(jqXHR.status == 422){
        removeStyleMetadato();
        $.each(jqXHR.responseJSON.errors, function(key,value) {
          document.getElementById(key).classList.add("is-invalid");
          document.getElementById('error-'+key).innerHTML = value;
        }); 
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


$('#modal-cliente').on('hidden.bs.modal', function (e){ 
  $('#form-cliente')[0].reset();
  $('#id').val('');
  $('#img_cliente').attr('src','/loaded/thumbnails/366x442.png')
  removeStyleMetadato();
  tabla_clientes.ajax.reload();
});

function deleteFamilia(id){
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
        var route = ruta+'/clientes/'+id;
        $.ajax({
          url: route,
          type: 'DELETE',
          headers: {'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value},
          success: function(res){ 
            resolve()
            tabla_clientes.ajax.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Error',
              'Ha ocurrido un error al tratar de eliminar el cliente. Status: '+jqXHR.status,
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
            'Se ha eliminado el cliente',
            'success'
          )
      }
    });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#img_cliente').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#file_cliente").change(function() {
  readURL(this);
});
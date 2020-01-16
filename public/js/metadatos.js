

var tabla_metadatos = $("#tabla-metadatos").DataTable({
  processing: true,
  serverSide: true,
  ajax: ruta+'/metadatos',
  search: { "caseInsensitive": true },
  columns: [
  { data: 'seccion', name: 'seccion'},
  { data: 'keywords.es', name: 'keywords.es', 'orderable': false},
  { data: 'description.es', name: 'description.es', 'orderable': false},
  { data: 'id',
    'orderable': false,
    render: function ( data, type, full, meta ) {
      var text = '<div class="text-center ">'+
      '<button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" OnClick="showMetadato(' + data + ')"><i class="fas fa-edit"></i></button>'+
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

$('#actualizar-metadatos').click(function(){
  tabla_metadatos.ajax.reload();
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
  $('textarea').removeClass('is-invalid');
  $('.text-danger').text('');
}

function showMetadato(id){
  $.ajax({
    url: ruta+'/info/metadatos/'+id,
    type: 'GET',
    success: function(res){ 
      $('#id').val(res.id);
      document.getElementById("keywords.es").value = res.keywords.es;
      document.getElementById("description.es").value = res.description.es;

      $('#modal-metadato').modal('show'); 
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
  var btn = this
  starLoad_cargarsito(btn)
  $.ajax({
    url:  ruta+'/info/metadatos/'+ $('#id').val(),
    headers: {'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value},
    type: 'PUT',
    dataType: 'json',
    data: $('#form-metadato').serialize(),
    success: function(res){
      endLoad_descargansito(btn)
      removeStyleMetadato();
      $('#modal-metadato').modal('hide');
      Swal.fire(
        'Exito!',
        'Se ha guardado el metadato',
        'success'
      )
    },
    error: function(jqXHR, textStatus, errorThrown){
      endLoad_descargansito(btn)
      if(jqXHR.status == 422){
        $('#validation-errors').html('');
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


$('#modal-metadato').on('hidden.bs.modal', function (e) 
{ 
  $('#form-metadato')[0].reset();
  $('#seccion').val('');
  removeStyleMetadato();
  tabla_metadatos.ajax.reload();
});
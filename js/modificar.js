$(document).ready(function() {
  $("#rutusuario").Rut({
    on_error: function(){ $('#submit').attr("disabled", true); $("#msgUsuario").html("Rut Incorrecto")},
    // INICIO ON success
      on_success:  function(){

        $('#submit').attr("disabled", false);$("#msgUsuario").html("")
        // INICIO FUNCION BUSCAR
        $('#frmBuscar').submit(function() {
          // inicio ajax
          $.ajax({
          data:$(this).serialize(),
          url:"../controlador/buscarusuario.php",
          type:"POST",
          beforeSend:function(){
        $('#load1').html('<img src="./load.gif"/ width=60> verificando');
        },
        // INICIO success
        success:function(respuesta){
          console.log(respuesta);
          if (respuesta =='0') {
            $('#rsp1').html('El usuario no existe');
            $('#load1').html('');

          }
          else{
            $('#frmRegistro').html(respuesta);
            $('#load1').html('');

            // INICIO AJAX CARGA DE ESTADO
          $.ajax({
            data:"rut2="+$('#rutusuario').val(),
            url: '../controlador/listarestado.php',
            type:"POST",
            beforeSend:function(){
            $('#listestado').html('');
            },
            success:function(x){
              $('#listestado').html(x);
              $('#load').html('');

            }
          // FIN CARGA DE ESTADO
          });

          $.ajax({
            url: '../controlador/listartipo.php',
            type:"POST",
            beforeSend:function(){
            $('#listipo').html('');
            },
            success:function(x){
              $('#listipo').html(x);
              $('#load').html('');
            }
          // FIN CARGA DE ESTADO
          });
          }

          // FIN success
        }
          // FIN AJAX
          });

          return false;
          // FIN FUNCION BUSCAR
        });
      // FIN success
      },
    format_on: 'keyup'
    // FIN FUNCION RUT
  });

    $('#frmRegistro').submit(function() {
          $.ajax({
          data:$(this).serialize(),
          url:"../controlador/updateusuario.php",
          type:"POST",
          beforeSend:function(){
        $('#load').html('<img src="./load.gif"/ width=60> verificando');
        },
        success:function(respuesta){
          console.log(respuesta);
          $('#rsp').html(respuesta);
          $('#load').html('');
          }
            });
          return false;
        });
});

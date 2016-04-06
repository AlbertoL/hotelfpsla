$(document).ready(function() {
  $("#rut").Rut({
    on_error: function(){ $('#submit').attr("disabled", true); $("#msgUsuario").html("Rut Incorrecto")},
      on_success:  function(){

        $('#submit').attr("disabled", false);$("#msgUsuario").html("")

        $('#frmRegistro').submit(function() {
          $.ajax({
          data:$(this).serialize(),
          url:"../controlador/registro.php",
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

      },
    format_on: 'keyup'
  });
          $.ajax({
          url:"../controlador/listartipo.php",
          type:"POST",
          beforeSend:function(){
        },
        success:function(respuesta){
          console.log(respuesta);
          $('#tipo').html(respuesta);
          }
            });
          return false;
  });

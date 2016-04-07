$(document).ready(function() {
  $("#rut").Rut({
    on_error: function(){ $('#boton').attr("disabled", true); $("#msgUsuario").html("Rut Incorrecto")},
      on_success:  function(){$('#boton').attr("disabled", false);$("#msgUsuario").html("")
      $('#frmUsuario').submit(function() {
        $.ajax({
          data:$(this).serialize(),
          url:"./controlador/login.php",
          type:"POST",
          beforeSend:function(){
        $('#load').html('<img src="./panel/load.gif"/ width=60>');
        $("#rsp").html("");
        },
        success:function(respuesta){
          console.log(respuesta);
          switch(respuesta){
            case '1':
            $(location).attr('href','./panel/index.php');
            break;
            case '2':
            $(location).attr('href','./panel/mes-contable.php');
            break;
            case '3':
              $('#rsp').html("Usuario Inactivo");
            break;
            case '0':
              alert("ingresa un usuario.");
            break;
            default:
              $('#rsp').html(respuesta);
            }
            $('#load').html('');
        }
        });
          return false;
      });
    },
    format_on: 'keyup'
  });
});

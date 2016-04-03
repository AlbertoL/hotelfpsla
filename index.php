<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>GHL HOTELES</title>
	<link rel="stylesheet" href="css/normalize.css"/>
	<link rel="stylesheet" href="css/estilos.css"/>
</head>
<body>
	<div class="contenedor">
		<div class="content_form">
			<div class="form">
				<div class="logo">
					<img src="img/logo-fpla.jpg" alt="logo-four-points" class="fpla" />
					<img src="img/ghl.jpg" alt="logo-ghl" class="ghl" />
				</div>
				<div class="login">
				<form id="frmUsuario" name="frmUsuario" action="#" method="POST">
					
					<input type="text" placeholder="Rut" id="rut" name="rut" autocomplete="off"/>
					<div id="msgUsuario" class="mensaje"></div><div id="datos" name="datos"></div>
					<input type="password" id="pass" placeholder="Contraseña" name="pass" autocomplete="off"/>
					
					<div class="cont_submit">
					<input id="boton" type="submit" class="btn_enviar" value="Entrar"/>
					</div>
				</form>
					<div id="rsp"></div>
					<a href="#" id="load" class="load"></a>
				</div>
				<div class="olvido_pass">
					<a href="#">¿Olvidó su contraseña?</a>
				</div>
				<!-- prueba firma -->
				<!-- fin prueba firma -->
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/modernizr.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.Rut.min.js"></script>
	<script src="js/pass.js"></script>
	<script type="text/javascript">
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
	</script>
</body>
</html>
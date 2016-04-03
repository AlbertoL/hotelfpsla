<?php
include '../controlador/sesion.php';
if (!$tipo==1 and $estado==1) {
	include '../controlador/destruir.php';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Panel de Control</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<link rel="stylesheet" href="../css/normalize.css"/>
	<link rel="stylesheet" href="../css/estilos-panel.css"/>
</head>
<body>
	<div class="contenedor">
		<div class="content_panel">
		<!-- HEADER -->
			<?php
				include './header.php';
			?>
		<!-- FIN HEADER -->
			<div class="cuerpo">
				<div class="content_cuerpo">
					<div class="content_form">
						<h2>Crear <span>Usuario</span></h2>
						<form id="frmRegistro" name="frmRegistro" action="#" method="POST">
						<label for="rut">Rut</label>
						<input type="text" id="rut" class="rut" name="rut" autocomplete="off"/>
						<div id="msgUsuario" class="mensaje"></div><div id="datos" name="datos"></div>
						<label for="nombre">Nombre</label>
						<input type="text" id="nombre" class="nombre" name="nombre"/>
						<label for="apellido">Apellido</label>
						<input type="text" id="apellido" class="apellido" name="apellido"/>
						<label for="pass">Contraseña</label>
						<input type="password" id="pass" class="pass" name="pass"/>
						<!-- <label for="Tipo">Tipo</label>
						<select name="tipo" id="tipo">
							<option value="1">ADMINISTRADOR</option>
							<option value="2">BÁSICO</option>
						</select> -->
						<div id="tipo">
							
						</div>
						<div class="content_boton">
							<input type="submit" id="submit" class="submit" value="Registrar" />
						</div>
						</form>
						<a href="#" id="load" class="load"></a>
						<div id="rsp"></div>
					</div>
				</div>
				<!-- FOOTER -->
					<?php
						include './footer.php';
					?>
				<!-- FIN FOOTER -->
			</div>
		</div>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/modernizr.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	<script src="../js/jquery.Rut.min.js"></script>
	<script src="../js/validar.js"></script>
	<script type="text/javascript">
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
    				// data:$(this).serialize(),
    				url:"../controlador/listartipo.php",
    				type:"POST",
    				beforeSend:function(){
					// $('#load').html('<img src="./load.gif"/ width=60> verificando');
					},
					success:function(respuesta){
						console.log(respuesta);
						$('#tipo').html(respuesta);
						// $('#load').html('');
						}	
    					});
    				return false;
  

	});
	</script>
</body>
</html>
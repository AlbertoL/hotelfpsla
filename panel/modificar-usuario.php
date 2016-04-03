<?php
include '../controlador/sesion.php';
if (!$tipo=='1' and !$estado=='1') {
	include '../controlador/destruir.php';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
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
						<h2>Modificar <span>Usuario</span></h2>
						<form id="frmBuscar" action="#" method="POST">
							<input type="text" id="rutusuario" name="rut2" class="buscar" placeholder="Ingrese Rut"/>
							<input type="submit" id="button" class="button" value="Buscar"/>
							<!-- <input type="submit" id="update"> -->
							<div id="msgUsuario"></div>
						</form>
						<a href="#" id="load1" class="load"></a>
						<div id="rsp1"></div>

						<form id="frmRegistro" action="#" method="POST">

						
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
	<!-- <script src="../js/jquery.jquery.Run.js"></script> -->
	<script src="../js/jquery.Rut.min.js"></script>
	<script src="../js/validar.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {

		// $('#update').fadeOut('0');
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
							// $('#update').fadeOut('0');
						}
						else{
							// $('#update').fadeIn('5');
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
							// data:"rut2="+$('#rutusuario').val(),
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
	</script>
</body>
</html>
<?php
	session_start();
	include 'includes/conexion.php';
	
	$alert='';
	if(!empty($_POST))
	{
		if(!empty($_POST['clavevieja']) && !empty($_POST['clavenueva'])){
			$vieja = $_POST['clavevieja'];
			$nueva = strtolower($_POST['clavenueva']);
			$idusuario = $_SESSION['usuario'];
			
			if(preg_match_all("/^(?=\w*\d)(?=\w*[a-z])\S{8,16}$/", $nueva)){

				$query_user = mysqli_query($conexion,"SELECT * FROM usuario
														WHERE clave = '$vieja' and usuario = '$idusuario' ");
				$result = mysqli_num_rows($query_user);
				if($result > 0)
				{
					$query_update = mysqli_query($conexion, "UPDATE usuario SET clave = '$nueva' 
																WHERE usuario = '$idusuario' ");
					mysqli_close($conexion);
					
					if($query_update){
						$alert = '<p class="msg_save">Contraseña actualizada.</p>';
					}else{
						$alert = '<p class="msg_error">Error al actualizar contraseña.</p>';
					}
				}else{
				   $alert = '<p class="msg_error">La contraseña actual es incorrecta.</p>';
				}
			}else {
					$alert = '<p class="msg_error">La nueva contraseña tiene valores incorrectos.</p>';
				
				}
		}
	}
?>

<HTML>
	<HEAD>
		<TITLE>Página Principal</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
		
<script type="text/javascript">

$(document).ready(function(){
    $('#cambioclave').submit(function(){

        var Actual = $('#clavevieja').val();
        var Nuevo = $('#clavenueva').val();
        var confirmarNuevo = $('#confirmacionclave').val();

        if(Nuevo != confirmarNuevo){
            $('.alertacambio').html('<p style="color:red">Las contraseñas  no son iguales.</p>');
            $('.alertacambio').slideDown();
			
            return false;
        }else {
			 //$('.alertacambio').html('<p style="color:green">Las contraseñas son iguales.</p>');
            //$('.alertacambio').slideDown();
			Confirmar();
			 
			 return true;
		}
	});
	
	function Confirmar() {
			var mensaje = alert("Confirmando contraseña");
			if (mensaje) {
				return true;
			}
		}


});


</script>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >

				<div class="datousuario">
				<h2 class="htabla">Datos del usuario</h2>
					<div class="divDataUser">
				
						<h4 class="divUsuario">Información Personal</h4>
						
						<div>
							<label>Nombre:</label><span><?= $_SESSION['nombreu'] ?></span>
						</div>
						<div>
							<label>Cédula Usuario:</label><span><?= $_SESSION['ci_usuario']; ?></span>
						</div>

						<h4 class="divUsuario">Información Usuario</h4>
						<div>
							<label>Cargo:</label><span><?= $_SESSION['nombrerol']; ?></span>
						</div>
						<div>
							<label>Usuario:</label><span><?= $_SESSION['usuario']; ?></span>
						</div>


						<h4 class="divUsuario">Cambio de Contraseña</h4>
						
						<form action="" method="post" name="cambioclave" id="cambioclave" onsubmit="return Confirmar()">
							<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
							<p>(Debe tener entre 8 y 16 caracteres, </br> al menos un dígito y al menos una letra).</p>
							<div>
								<input type="password" name="clavevieja" id="clavevieja" placeholder="Contraseña Actual" class="cambioinp" required>
							
								<input class=" cambioinp" type="password" name="clavenueva" id="clavenueva" placeholder="Nueva Contraseña"  required>
							
								<input class=" cambioinp" type="password" name="confirmacionclave" id="confirmacionclave" placeholder="Confirmar Nueva Contraseña" required>
							</div>
							
							<div class="alertacambio" style="display: none;"></div>
							<div>
								<button type="submit" class="btn_save btnChangePass"> Cambiar Contraseña</button>
							</div>
						</form>
						
						

					</div>
				</div>

		</section>
	</BODY>
</HTML>
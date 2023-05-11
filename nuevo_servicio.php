<?php
	session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';
$alert='';
	
	if(!empty($_POST)){
		
		if(empty($_POST ['descripcion_servicio'])){

			$alert='<p class="msg_error">Campos Obligatorios</p>';
			
		}else{
		
			$descripcion_servicio = $_POST['descripcion_servicio'];
			
			$verif_servicio= mysqli_query ($conexion, "SELECT * FROM servicio WHERE  descripcion_servicio = '$descripcion_servicio'");
			
			if(mysqli_fetch_array($verif_servicio) > 0){
				$alert = '<p class="msg_error">Este servicio ya existe.</p>';
				
			}else{$insert= mysqli_query ($conexion, "INSERT INTO servicio (descripcion_servicio) 
													VALUES ('$descripcion_servicio')");
			  mysqli_close($conexion);
				if($insert ==true){
					$alert = '<p class="msg_save">Servicio registrado.</p>';
					header("refresh:1;url=listado_servicio.php");	
				}else {
					$alert = '<p class="msg_error">Error al registro Servicio.</p>';
					header("refresh:1;url=listado_servicio.php");	
				}
			}	
		}			
	}
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Nuevo Servicio</title>
		<?php include "includes/scripts.php";?>
	</head>
	<body>	
		<?php include "includes/headeruser.php";?>

		<section class="container">
			<div class="register">
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
				<form action="" method="POST">
					<h2>Agregar Servicio</h2>
					<hr>
								
					<label for ="descripcion_servicio">Servicio</label>
					<input type="text" name="descripcion_servicio" id="descripcion_servicio" required>
					
					<input type="submit" class="btn_save" value="Aceptar" >
				</form>
			</div>
		</section>

	</body>

</html>
<?php
session_start();

if ($_SESSION['idrol'] ==2){
	header("location: index.php");
}

include 'includes/conexion.php';

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_usuario']) || empty($_POST ['nombreu']) || 
		 empty($_POST['apellidou'])  || empty($_POST['codgenero']) ||  empty($_POST['direccion'])){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{
			$ci_usuario = $_POST['ci_usuario'];
			$nombreu = ucwords($_POST['nombreu']);
			$apellidou = ucwords($_POST['apellidou']);
			$codgenero = $_POST['codgenero'];
			$direccion = ucwords($_POST['direccion']);	
			
			$update= mysqli_query ($conexion, "UPDATE usuario SET nombreu='$nombreu', apellidou='$apellidou', codgenero='$codgenero', direccion='$direccion' 
												WHERE ci_usuario= '$ci_usuario'");
		
			$verif_ci_client= mysqli_query ($conexion, "SELECT * FROM cliente WHERE ci_cliente = '$ci_usuario' ");
			
			if (mysqli_fetch_array($verif_ci_client) > 0){
				$updatecliente= mysqli_query ($conexion, "UPDATE cliente SET nombre='$nombreu', apellido='$apellidou', codgenero='$codgenero'
															WHERE ci_cliente= '$ci_usuario'");
			}
			
			if($update){
				$alert = '<p class="msg_save">Usuario correctamente actualizado.</p>';
				header("refresh:1;url=listado_usuario.php");	

			}else {
				$alert = '<p class="msg_">Error al actualizar usuario.</p>';
				header("refresh:2;url=listado_usuario.php");
			}	
			
			
		}			
	}

    $ci_usuario = $_REQUEST['ci'];
	
	$sql =mysqli_query($conexion, "SELECT  u.nombreu, u.apellidou,  
											g.descripcion, u.codgenero, u.direccion
									FROM usuario u
									INNER JOIN genero g      ON u.codgenero = g.codgenero
									WHERE u.ci_usuario = '$ci_usuario' ");
	
	
		while ($data = mysqli_fetch_array($sql)){
			$nombreu = $data['nombreu'];
			$apellidou = $data['apellidou'];
			$descripcion = $data['descripcion'];
			$codgenero = $data['codgenero'];
			$direccion = $data['direccion'];
		}
	
?>

<html lang="en">
	<head>
		<title>Actualizar Usuario</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
		<script type="text/javascript">
		function Confirmar() {
			var mensaje = confirm("¿Desea continuar?");
			if (mensaje) {
				return true;
			}else {
				return false;
			}
		}
		</script>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post" onsubmit="return Confirmar()">
					<h2>Actualizar Usuario</h2>
					<hr>
					
					<label for ="dni">Cédula de Identidad</label>
					<input type="text" name="ci_usuario" value="<?php echo $ci_usuario ?>" readonly>
					
					<label for ="nombreu">Nombre</label>
					<input type="text" name="nombreu" value="<?php echo $nombreu ?>">
					
					<label for ="apellidou">Apellido</label>
					<input type="text" name="apellidou" value="<?php echo $apellidou ?>">
					
					<label for ="codgenero">Género </label>
					
				<?php
					$query_genero=mysqli_query($conexion, "SELECT * FROM genero");
					$result_genero=mysqli_num_rows($query_genero);
				?>
					
					<select name="codgenero" id="codgenero">
					<option value="<?php echo $codgenero ?>" selected><?php echo $descripcion?></option>
				<?php
					if($result_genero>0){
					while($genero=mysqli_fetch_array($query_genero)){
				?>	
					<option value="<?php echo $genero["codgenero"];?>"><?php echo $genero["descripcion"];?></option>
				<?php				
					}
				}
				?>
					</select>
								
					<label for ="direccion">Dirección</label>
					<input type="text" name="direccion" value="<?php echo $direccion ?>">
					
					<a href="listado_usuario.php" class="btn_ok"> Volver</a>
					<button class="btn_cancel" onclick="Confirmar()"> Actualizar</button>
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
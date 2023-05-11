<?php
session_start();

include 'includes/conexion.php';
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_cliente']) || empty($_POST ['correo_cliente']) || empty($_POST['iddominio']) ){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{
			$ci_cliente = $_POST['ci_cliente'];
			$correo_cliente = $_POST['correo_cliente'];
			$iddominio = $_POST['iddominio'];
			if(preg_match_all ("/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)$/", $correo_cliente)){
				
				$verif_correo= mysqli_query ($conexion, "SELECT * FROM correo_cliente 
															WHERE  correo_cliente = '$correo_cliente' AND iddominio = '$iddominio'");
				
				$verif_correo_user= mysqli_query ($conexion, "SELECT * FROM correo_usuario 
																WHERE ci_usuario != '$ci_cliente' AND correo_usuario = '$correo_cliente' AND iddominio = '$iddominio'");

				if(mysqli_fetch_array($verif_correo) > 0){
					$alert = '<p class="msg_error">El correo ya existe.</p>';
					
				}elseif(mysqli_fetch_array($verif_correo_user) > 0){
					$alert = '<p class="msg_error">El correo le pertenece a un usuario.</p>';
						
				}else {
					$insert_correo= mysqli_query ($conexion, "INSERT INTO correo_cliente (ci_cliente, correo_cliente, iddominio) 
															VALUES ('$ci_cliente', '$correo_cliente','$iddominio')");
					if($insert_correo == false){
						$alert = '<p class="msg_error">Error al registrar correo.</p>';
						Exit;
					}else{
						$alert = '<p class="msg_save">Correo registrado correctamente.</p>';
					}		
				}
				
			}else{
				$alert = '<p class="msg_error">El correo tiene valores incorrectos.</p>';
			}
		}			
	}
	
	if(empty($_REQUEST['ci']) ){
		header('location:listado_cliente.php');
	}else{
		$ci_cliente = $_REQUEST['ci'];
		
		$sql =mysqli_query($conexion, "SELECT  c.ci_cliente, c.nombre, c.apellido
										FROM cliente c
										WHERE c.ci_cliente = '$ci_cliente'");
		while ($data = mysqli_fetch_array($sql)){
			$nombre = $data['nombre'];
			$apellido = $data['apellido'];
		}
	}
?>

<html lang="en">
	<head>
		<title>Agregar Correo Cliente</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<h2>Agregar Correo del Cliente</h2>
				<hr>
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post">	
					
					<input type="hidden" name="ci_cliente"  value="<?php echo $ci_cliente ?>" readonly>
					<label for ="nombre">Nombre del cliente</label>
					<input type="text" name="nombre" class="textcenter" value="<?php echo $nombre. ' '.$apellido ?>" readonly>
					
					<label for ="correo_cliente">Correo </label>
					<input type="text" name="correo_cliente" id="correo_cliente" placeholder="Correo" class="wd50" required>
				<?php
					$query_dominio=mysqli_query($conexion, "SELECT * FROM dominio");
					$result_dominio=mysqli_num_rows($query_dominio);
				?>
					
					<select name="iddominio" id="iddominio" class="wd40">
					<option value="" selected>Dominio</option>
				<?php
					if($result_dominio>0){
					while($dominio=mysqli_fetch_array($query_dominio)){
				?>	
					<option value="<?php echo $dominio["iddominio"];?>"><?php echo $dominio["descripcion_dominio"];?></option>
				<?php				
					}
				}
				?>
					</select>	

					<a href="listado-correo_cliente.php?ci=<?php echo $ci_cliente?>" class="btn_cancel volver"> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
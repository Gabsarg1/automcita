<?php
session_start();

	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_usuario']) || empty($_POST ['correo_usuario']) || empty($_POST['iddominio']) ){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{
			$ci_usuario = $_POST['ci_usuario'];
			$correo_usuario = $_POST['correo_usuario'];
			$iddominio = $_POST['iddominio'];
			if(preg_match_all ("/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)$/", $correo_usuario)){
				
				$verif_correo= mysqli_query ($conexion, "SELECT * FROM correo_usuario 
															WHERE  correo_usuario = '$correo_usuario' AND iddominio = '$iddominio'");
				
				$verif_correo_client= mysqli_query ($conexion, "SELECT * FROM correo_cliente 
																		WHERE ci_cliente != '$ci_usuario' AND correo_cliente = '$correo_usuario' AND iddominio = '$iddominio'");

				if(mysqli_fetch_array($verif_correo) > 0){
					$alert = '<p class="msg_error">El correo ya existe.</p>';	
				}elseif(mysqli_fetch_array($verif_correo_client) > 0){
					$alert = '<p class="msg_error">El correo le pertenece a un cliente.</p>';
						
				}else{
					$insert_correo= mysqli_query ($conexion, "INSERT INTO correo_usuario (ci_usuario, correo_usuario, iddominio) 
																VALUES ( '$ci_usuario', '$correo_usuario','$iddominio')");
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
	
	if( empty($_REQUEST['ci']) ){
		header('location:listado_usuario.php');
	}else{
		$ci_usuario = $_REQUEST['ci'];
		
		$sql =mysqli_query($conexion, "SELECT  u.ci_usuario, u.nombreu, u.apellidou
									FROM usuario u
									WHERE u.ci_usuario = '$ci_usuario' ");
		while ($data = mysqli_fetch_array($sql)){
			$nombreu = $data['nombreu'];
			$apellidou = $data['apellidou'];
		}
	}
?>

<html lang="en">
	<head>
		<title>Agregar correo Usuario</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<h2>Agregar Correo del Usuario</h2>
				<hr>
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post">	
					<input type="hidden" name="ci_usuario"  value="<?php echo $ci_usuario ?>" readonly>
					<label for ="nombre">Nombre del cliente</label>
					<input type="text" name="nombre" class="textcenter" value="<?php echo $nombreu. ' '.$apellidou ?>" readonly>
					
					<label for ="correo_usuario">Correo </label>
					<input type="text" name="correo_usuario" id="correo_usuario" placeholder="Correo" class="wd50" required>
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

					<a href="listado-correo_usuario.php?ci=<?php echo $ci_usuario?>" class="btn_cancel volver"> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
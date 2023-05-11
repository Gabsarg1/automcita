<?php
session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';
$alert='';
	
	if(!empty($_POST)){
		
		if( empty($_POST['ci_usuario']) || 
			empty($_POST['nombreu']) || empty($_POST ['apellidou']) || 
			empty($_POST['usuario']) || empty($_POST ['clave']) || 
			empty($_POST['codgenero']) || empty($_POST['idrol']) || empty($_POST['direccion']) ||
			empty($_POST['idarea']) || empty($_POST['telefono_usuario'])||
			empty($_POST['correo_usuario']) || empty($_POST['iddominio'])){

			$alert='<p class="msg_error">Campos Obligatorios</p>';
			
		}else{
			$ci_usuario = $_POST['ci_usuario'];
		$nombreu = ucwords($_POST['nombreu']);
			$apellidou = ucwords($_POST['apellidou']);
			$usuario = strtolower($_POST['usuario']);
			$clave = strtolower($_POST['clave']);
			$codgenero = $_POST['codgenero'];
			$idrol = $_POST['idrol'];
			$direccion = ucwords($_POST['direccion']);
			$idarea = $_POST['idarea'];
			$telefono_usuario = $_POST['telefono_usuario'];
			$correo_usuario = $_POST['correo_usuario'];
			$iddominio = $_POST['iddominio'];

			if(preg_match_all("/^[V|E]-[0-9]{5,9}$/", $ci_usuario)){
				if(preg_match_all("/^(?=\w*\d)(?=\w*[a-z])\S{8,16}$/", $clave)){
					if(preg_match_all ("/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)$/", $correo_usuario)){

						$verif_ci= mysqli_query ($conexion, "SELECT * FROM usuario WHERE ci_usuario = '$ci_usuario' AND estatus = 1");
						$verif_ci_client= mysqli_query ($conexion, "SELECT * FROM cliente 
																	WHERE (ci_cliente = '$ci_usuario' AND nombre != '$nombreu' ) OR
																			(ci_cliente = '$ci_usuario' AND apellido != '$apellidou') OR
																			(ci_cliente = '$ci_usuario' AND codgenero != '$codgenero') ");
						$verif_usuario= mysqli_query ($conexion, "SELECT * FROM usuario WHERE  usuario = '$usuario' AND estatus = 1");
						
						$verif_telefono= mysqli_query ($conexion, "SELECT * FROM telefono_usuario WHERE  idarea = '$idarea' AND telefono_usuario = '$telefono_usuario'");
						$verif_telf_client= mysqli_query ($conexion, "SELECT * FROM telefono_cliente
																		WHERE ci_cliente != '$ci_usuario' AND idarea = '$idarea' AND telefono_cliente = '$telefono_usuario' ");
					
						$verif_correo= mysqli_query ($conexion, "SELECT * FROM correo_usuario WHERE correo_usuario = '$correo_usuario' AND iddominio = '$iddominio'");
						$verif_correo_client= mysqli_query ($conexion, "SELECT * FROM correo_cliente 
																		WHERE ci_cliente != '$ci_usuario' AND correo_cliente = '$correo_usuario' AND iddominio = '$iddominio'");


						if(mysqli_fetch_array($verif_ci) > 0){
							$alert = '<p class="msg_error">La cédula ya existe.</p>';
							
						}elseif(mysqli_fetch_array($verif_ci_client) > 0){
							$alert = '<p class="msg_error">La cédula pertenece a un cliente, por favor ingrese los datos correspondientes.</p>';
						
						}elseif (mysqli_fetch_array($verif_usuario) > 0) {
							$alert = '<p class="msg_error">El usuario ya existe.</p>';
			
						}elseif(mysqli_fetch_array($verif_telefono) > 0){
							$alert = '<p class="msg_error">El teléfono ya existe.</p>';
							
						}elseif(mysqli_fetch_array($verif_telf_client) > 0){
							$alert = '<p class="msg_error">El telefono le pertenece a un cliente.</p>';
						
						}elseif(mysqli_fetch_array($verif_correo) > 0){
							$alert = '<p class="msg_error">El correo ya existe.</p>';
							
						}elseif(mysqli_fetch_array($verif_correo_client) > 0){
							$alert = '<p class="msg_error">El correo le pertenece a un cliente.</p>';
						
						}else {
								$insert= mysqli_query ($conexion, "INSERT INTO usuario (ci_usuario, nombreu, apellidou, usuario, clave, codgenero, idrol, direccion) 
																		VALUES ('$ci_usuario', '$nombreu', '$apellidou', '$usuario', '$clave', '$codgenero', '$idrol', '$direccion')");
							if($insert ==true){
								$insert_telf= mysqli_query ($conexion, "INSERT INTO telefono_usuario (ci_usuario, idarea, telefono_usuario) 
																VALUES ('$ci_usuario', '$idarea','$telefono_usuario')");

								if($insert_telf ==false){
									$alert = '<p class="msg_error">Error al registrar telefono.</p>';
									
								}
							
								$insert_correo= mysqli_query ($conexion, "INSERT INTO correo_usuario (ci_usuario, correo_usuario, iddominio) 
																VALUES ('$ci_usuario','$correo_usuario', '$iddominio')");

								if($insert_correo ==true){
									$alert = '<p class="msg_save">Usuario correctamente registrado.</p>';
									header("refresh:2;url=listado_usuario.php");		
									
								}else{
									$alert = '<p class="msg_error">Error al registrar correo.</p>';
								}
								
							}else {
								$alert = '<p class="msg_error">Error al registrar usuario.</p>';
							}
						}
					} else {
						$alert = '<p class="msg_error">El correo tiene valores incorrectos.</p>';
						}
				}else {
					$alert = '<p class="msg_error">La contraseña tiene valores incorrectos.</p>';
				
				}
			}else {
					$alert = '<p class="msg_error">La cédula tiene valores incorrectos.</p>';
				}		
		}
	}
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Registro Nuevo Usuario</title>
		<?php include "includes/scripts.php";?>
	</head>
	<body>	
		<?php include "includes/headeruser.php";?>

		<section class="container">
			<div class="register">
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
				<h2>Registrar Usuario</h2>
				<hr>
				
				
				<form action="" method="POST">
					<p class="mas">Campo Obligatorio(*)</p>
					
					<label for ="ci_usuario">Cédula de Identidad <b class="mas">*</b></label>
					<input type="text" name="ci_usuario" id="ci_usuario" placeholder="V ó E - xxxxxxx" pattern="[V|E]-[0-9]{5,9}" required>
					
					<label for ="nombreu">Nombre <b class="mas">*</b></label>
					<input type="text" name="nombreu" id="nombreu" placeholder="Nombre" required >
					
					<label for ="apellidou">Apellido <b class="mas">*</b></label>
					<input type="text" name="apellidou" id="apellidou" placeholder="Apellido" required >
					
					<label for ="usuario">Usuario <b class="mas">*</b></label>
					<input type="text" name="usuario" id="usuario" placeholder="Usuario" required  >

					<label for ="clave">Contraseña <b class="mas">*</b></label>
					<p>(Debe tener entre 8 y 16 caracteres, <br/>
					al menos un dígito y al menos una letra.</p>
					<input type="password" name="clave" id="clave" placeholder="Clave" required >
					
					<label for ="codgenero">Género <b class="mas">*</b></label>
					
				<?php
					$query_genero=mysqli_query($conexion, "SELECT * FROM genero");
					$result_genero=mysqli_num_rows($query_genero);
				?>
					
					<select name="codgenero" id="codgenero" required>
					<option value="" selected>Seleccione</option>
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
					
					<label for ="idrol">Cargo <b class="mas">*</b></label>
				<?php
					$query_rol=mysqli_query($conexion, "SELECT * FROM rol r 
														WHERE r.idrol NOT IN 
																(SELECT r.idrol FROM rol r WHERE r.idrol=1)");
					$result_rol=mysqli_num_rows($query_rol);
				?>
					
					<select name="idrol" id="idrol" required>
					<option value="" selected>Seleccione</option>
				<?php
					if($result_rol>0){
					while($rol=mysqli_fetch_array($query_rol)){
				?>	
					<option value="<?php echo $rol["idrol"];?>"><?php echo $rol["nombrerol"];?></option>
				<?php		
					}
					
				}
				?>
					</select>
					
					<label for ="telefono_usuario">Teléfono <b class="mas">*</b></label>
					
				<?php
					$query_area=mysqli_query($conexion, "SELECT * FROM area");
					$result_area=mysqli_num_rows($query_area);
				?>
					
					<select name="idarea" id="idarea" class="wd30" required>
					<option value="" selected>Área</option>
				<?php
					if($result_area>0){
					while($area=mysqli_fetch_array($query_area)){
				?>	
					<option value="<?php echo $area["idarea"];?>"><?php echo $area["descripcion_area"];?></option>
				<?php				
					}
					}
				?>
					</select>
					<input type="tel" name="telefono_usuario" id="telefono_usuario" pattern="[0-9]{7}" placeholder="xxxxxxx"  class="wd60" required>

					
					<label for ="correo_usuario">Correo <b class="mas">*</b></label>
					<input type="text" name="correo_usuario" id="correo_usuario" placeholder="Correo" pattern="([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)" class="wd50" required>
				<?php
					$query_dominio=mysqli_query($conexion, "SELECT * FROM dominio");
					$result_dominio=mysqli_num_rows($query_dominio);
					mysqli_close($conexion);
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

					<label for ="direccion">Dirección <b class="mas">*</b></label>
					<input type="text" name="direccion" id="direccion" placeholder="Dirección"  required>
					
					<input type="submit" class="btn_save" value="Aceptar" >
				</form>
			</div>
		</section>

	</body>

</html>
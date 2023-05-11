<?php
session_start();

	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
	
include 'includes/conexion.php';
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_usuario']) || empty($_POST ['idarea']) || empty($_POST['telefono_usuario']) ){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{
			$ci_usuario = $_POST['ci_usuario'];
			$idarea = $_POST['idarea'];
			$telefono_usuario = $_POST['telefono_usuario'];

			$verif_telefono= mysqli_query ($conexion, "SELECT * FROM telefono_usuario WHERE  idarea = '$idarea' AND telefono_usuario = '$telefono_usuario'");
			$verif_telf_client= mysqli_query ($conexion, "SELECT * FROM telefono_cliente
																		WHERE ci_cliente != '$ci_usuario' AND idarea = '$idarea' AND telefono_cliente = '$telefono_usuario' ");
					
			if(mysqli_fetch_array($verif_telefono) > 0){
				$alert = '<p class="msg_error">El teléfono ya existe.</p>';	
				
			}elseif(mysqli_fetch_array($verif_telf_client) > 0){
				$alert = '<p class="msg_error">El telefono le pertenece a un cliente.</p>';
						
			}else {
				$insert_telf= mysqli_query ($conexion, "INSERT INTO telefono_usuario ( ci_usuario, idarea, telefono_usuario) 
														VALUES ( '$ci_usuario', '$idarea','$telefono_usuario')");
				if($insert_telf == false){
					$alert = '<p class="msg_error">Error al registrar telefono.</p>';
					Exit;
				}else{
					$alert = '<p class="msg_save">Teléfono registrado correctamente.</p>';
				}		
			}
		}			
	}
	
	if(empty($_REQUEST['ci']) ){
		header('location:listado_usuario.php');
	}else{
		$ci_usuario = $_REQUEST['ci'];
		
		$sql =mysqli_query($conexion, "SELECT u.ci_usuario, u.nombreu, u.apellidou
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
		<title>Agregar Teléfono del Usuario</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<h2>Agregar teléfono del Usuario</h2>
				<hr>
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post">
					<label for ="nombre">Nombre del Usuario</label>
					<input type="text" name="nombre" class="textcenter" value="<?php echo $nombreu . ' ' . $apellidou ?>" readonly>
					<input type="hidden" name="ci_usuario" value="<?php echo $ci_usuario ?>" readonly>
					
					<label for ="idarea">Teléfono</label>
					
				<?php
					$query_area=mysqli_query($conexion, "SELECT * FROM area");
					$result_area=mysqli_num_rows($query_area);
				?>
					
					<select name="idarea" id="idarea" class="wd30">
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
					<input type="tel" name="telefono_usuario" class="wd60" id="telefono_usuario" pattern="[0-9]{7}" placeholder="xxxxxxx" required>

					<a href="listado-telefono_usuario.php?ci=<?php echo $ci_usuario?>" class="btn_cancel volver"> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
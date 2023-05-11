<?php
session_start();

include 'includes/conexion.php';
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_cliente']) || empty($_POST ['idarea']) || empty($_POST['telefono_cliente']) ){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{
			$ci_cliente = $_POST['ci_cliente'];
			$idarea = $_POST['idarea'];
			$telefono_cliente = $_POST['telefono_cliente'];

			$verif_telefono= mysqli_query ($conexion, "SELECT * FROM telefono_cliente WHERE  idarea = '$idarea' AND telefono_cliente = '$telefono_cliente'");
			$verif_telf_user= mysqli_query ($conexion, "SELECT * FROM telefono_usuario 
																WHERE ci_usuario != '$ci_cliente' AND idarea = '$idarea' AND telefono_usuario = '$telefono_cliente' ");
					
					
			if(mysqli_fetch_array($verif_telefono) > 0){
				$alert = '<p class="msg_error">El teléfono ya existe.</p>';	
			}elseif(mysqli_fetch_array($verif_telf_user) > 0){
				$alert = '<p class="msg_error">El telefono le pertenece a un usuario.</p>';
						
			}else {
				$insert_telf= mysqli_query ($conexion, "INSERT INTO telefono_cliente (ci_cliente, idarea, telefono_cliente) 
														VALUES ('$ci_cliente', '$idarea','$telefono_cliente')");
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
		header('location:listado_cliente.php');
	}else{
	
		$ci_cliente = $_REQUEST['ci'];
		
		$sql =mysqli_query($conexion, "SELECT c.ci_cliente, c.nombre, c.apellido
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
		<title>Agregar Teléfono del Cliente</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<h2>Agregar teléfono del Cliente</h2>
				<hr>
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post">	
					<input type="hidden" name="ci_cliente"  value="<?php echo $ci_cliente ?>" readonly>
					<label for ="nombre">Nombre del cliente</label>
					<input type="text" name="nombre" class="textcenter" value="<?php echo $nombre. ' '.$apellido ?>" readonly>
					
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
					<input type="tel" name="telefono_cliente" class="wd60" id="telefono_cliente" pattern="[0-9]{7}" placeholder="xxxxxxx"  required>


					<a href="listado-telefono_cliente.php?ci=<?php echo $ci_cliente?>" class="btn_cancel volver"> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
<?php
session_start();
if ($_SESSION['idrol'] == 2){
	header("location: index.php");
}

include 'includes/conexion.php';
$alert='';
	
	if(!empty($_POST)){
		
		if( empty($_POST['ci_usuario']) || empty($_POST ['idservicio']) || empty($_POST['horario_inicio']) || 
		empty($_POST['horario_final']) ){

			$alert='<p class="msg_error">Campos Obligatorios</p>';
			
		}else{
		
			$ci_usuario = $_POST['ci_usuario'];
			$idservicio = $_POST['idservicio'];
			$horario_inicio = $_POST['horario_inicio'];
			$horario_final = $_POST['horario_final'];
			
			if($horario_final <= $horario_inicio){
				$alert = '<p class="msg_error">El horario de salida es menor o igual al horario de entrada.</p>';
			}else{	
				$verif_servicio= mysqli_query ($conexion, "SELECT * FROM trabajo WHERE ci_cosmetologa = '$ci_usuario' AND idservicio = '$idservicio'");
				
				if(mysqli_fetch_array($verif_servicio) > 0){
					$alert = '<p class="msg_error">Este servicio del cosmetólogo ya existe.</p>';
					
				}else{
					$insert= mysqli_query ($conexion, "INSERT INTO trabajo (ci_cosmetologa, idservicio, horario_inicio, horario_final) 
														VALUES ('$ci_usuario', '$idservicio', '$horario_inicio', '$horario_final' )");
					if($insert ==true){
						$alert = '<p class="msg_save">Especialidad registrada.</p>';
						header("refresh:2;url=listado_especialidad.php");
					}else {
						$alert = '<p class="msg_error">Error al registrar especialidad.</p>';
					}
				}
			}
		}	
	}
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Nueva Especialidad</title>
		<?php include "includes/scripts.php";?>
	</head>
	<body>	
		<?php include "includes/headeruser.php";?>

		<section class="container">
			<div class="register">
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
				<h2> Especialidad</h2>
					<hr>
				<form action="" method="POST">
								
					<label for ="idusuario">Nombre del cosmetólogo</label>
				
				<?php
					$query_cosmetologa=mysqli_query($conexion, "SELECT u.nombreu, u.apellidou, u.ci_usuario
															FROM usuario u
															WHERE u.idrol = 2");
					$result_cosmetologa=mysqli_num_rows($query_cosmetologa);
				?>
					
					<select name="ci_usuario" id="ci_usuario" required>
					<option value="" selected >Seleccione</option>
				<?php
					if($result_cosmetologa>0){
					while($cosmetologa=mysqli_fetch_array($query_cosmetologa)){
						$nombreu = $cosmetologa['nombreu'];
						$apellidou = $cosmetologa['apellidou'];
				?>	
					<option value="<?php echo $cosmetologa["ci_usuario"];?>"><?php echo $nombreu. ' ' . $apellidou?></option>
				<?php				
					}
				}
				?>
					</select>
					
					<label for ="idservicio">Servicio</label>
				<?php
					$query_servicio=mysqli_query($conexion, "SELECT * FROM servicio");
					$result_servicio=mysqli_num_rows($query_servicio);
					mysqli_close($conexion);
				?>
					
					<select name="idservicio" id="idservicio" required>
					<option value="" selected >Seleccione</option>
				<?php
					if($result_servicio>0){
					while($servicio=mysqli_fetch_array($query_servicio)){
				?>	
					<option value="<?php echo $servicio["idservicio"];?>"><?php echo $servicio["descripcion_servicio"];?></option>
				<?php				
					}
					
				}
				?>
					</select>

					<label for ="horario_inicio">Horario Entrada del Turno</label><p>(Horario mínimo 8:00)</p>
					<input type="time" name="horario_inicio" id="horario_inicio" min="08:00" required>
					

					<label for ="horario_final">Horario Salida del Turno</label><p>(Horario Máximo 19:00)</p>
					<input type="time" name="horario_final" id="horario_final" max="19:00" required>
					
					<a href="listado_especialidad.php" class="btn_ok "> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				</form>
			</div>
		</section>

	</body>

</html>
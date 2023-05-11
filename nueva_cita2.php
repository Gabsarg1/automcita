<?php
session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';
$alert='';

	if(!empty($_POST)){
		
		if(!empty($_POST['hora']) ){

		
			$ci_cliente = $_POST['ci_cliente'];
			$idservicio = $_POST['idservicio'];
			$ci_cosmetologa = $_POST['ci_cosmetologa'];
			$fecha = $_POST['fecha'];
			$hora = $_POST['hora'];
			
			$verif_cita= mysqli_query ($conexion, "SELECT  ci_cliente, idservicio, ci_cosmetologa, fecha, hora
													FROM cita 
													WHERE ci_cliente = '$ci_cliente' AND idservicio = '$idservicio' AND
													ci_cosmetologa = '$ci_cosmetologa' AND fecha = '$fecha' AND hora = '$hora'");
													
			$verif_disp= mysqli_query ($conexion, "SELECT  ci_cosmetologa, fecha, hora
													FROM cita 
													WHERE ci_cosmetologa = '$ci_cosmetologa' AND fecha = '$fecha' AND hora = '$hora'");
				
			$verif_disp_client= mysqli_query ($conexion, "SELECT  ci_cliente, fecha, hora
													FROM cita 
													WHERE ci_cliente = '$ci_cliente' AND fecha = '$fecha' AND hora = '$hora'");
				

			if(mysqli_fetch_array($verif_cita) > 0){
				$alert = '<p class="msg_error">Esta cita ya existe.</p>';
				header("refresh:1;url=listado_cita.php");	
				
			}elseif(mysqli_fetch_array($verif_disp) > 0){
				$alert = '<p class="msg_error">El cosmetólogo no se encuentra disponible el  '.$fecha.' a las '.$hora.'.</p>';	
				
			}elseif(mysqli_fetch_array($verif_disp_client) > 0){
				$alert = '<p class="msg_error">El cliente tiene una cita pautada el '.$fecha.' a las '.$hora.'.</p>';	
				
			}else{
				$insert= mysqli_query ($conexion, "INSERT INTO cita ( ci_cliente, idservicio, ci_cosmetologa, fecha, hora) 
													VALUES ('$ci_cliente', '$idservicio','$ci_cosmetologa','$fecha', '$hora')");
				if($insert ==true){
					$alert = '<p class="msg_save">Cita registrada correctamente.</p>';
					header("refresh:2;url=listado_cita.php");		
								
				}else{
					$alert = '<p class="msg_error">Error al registrar cita.</p>';
					header("refresh:1;url=listado_cita.php");	
				}
			}
		}			
	}
	
	if(empty($_REQUEST['ci_cliente']) || empty($_REQUEST ['idservicio']) || empty($_REQUEST['ci_cosmetologa']) || empty($_REQUEST['fecha']) ){
       header("refresh:1;url=listado_cita.php");
    }
		$ci_cliente= $_REQUEST['ci_cliente'];
		$idservicio= $_REQUEST['idservicio'];
		$ci_cosmetologa= $_REQUEST['ci_cosmetologa'];
		$fecha= $_REQUEST['fecha'];
		
			$sql =mysqli_query($conexion, "SELECT u.nombreu, u.apellidou,
													s.descripcion_servicio,
													t.horario_inicio, t.horario_final
												FROM trabajo t
												INNER JOIN servicio s ON t.idservicio = s.idservicio
												INNER JOIN usuario u ON t.ci_cosmetologa = u.ci_usuario
												WHERE t.ci_cosmetologa = '$ci_cosmetologa' AND t.idservicio = '$idservicio'");
			while ($mostrar = mysqli_fetch_array($sql)){
					$nombreu = $mostrar['nombreu'];
					$apellidou = $mostrar['apellidou'];
					$nuser = $nombreu.' '. $apellidou;
							
					$servicio = $mostrar['descripcion_servicio'];
					
					$inicio = $mostrar['horario_inicio'];
					$final = $mostrar['horario_final'];
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
			
				<h2>Nueva Cita</h2>
				<hr>
				
			<form action="" method="POST">
			
				<label for ="fecha">Fecha</label>
					<input type="text" name="fecha" readonly value="<?php echo $fecha; ?>">
			
				<label for ="ci_cliente">Cliente</label>
				
					<?php $sql =mysqli_query($conexion, "SELECT c.ci_cliente, c.nombre, c.apellido
														FROM cliente c
														WHERE c.ci_cliente = '$ci_cliente' ");
						while ($mostrar = mysqli_fetch_array($sql)){
							$nombre = $mostrar['nombre'];
							$apellido = $mostrar['apellido'];
							$ncompleto = $nombre.' '. $apellido;
						}
					?>
					<input type="hidden" name="ci_cliente" readonly value="<?php echo $ci_cliente; ?>">
					<input type="text"  readonly value="<?php echo $ncompleto; ?>">
				
						
				<label for ="idservicio">Servicio</label>
				
					<input type="hidden" name="idservicio" readonly value="<?php echo $idservicio; ?>">
					<input type="text" readonly value="<?php echo $servicio; ?>">
				
				<label for ="ci_cosmetologa">Cosmetólogo </label>
					<input type="hidden" name="ci_cosmetologa" readonly value="<?php echo $ci_cosmetologa; ?>">
					<input type="text" readonly value="<?php echo $nuser; ?>">
					
				<label for ="hora">Horario de atención:</label>

				<p><?php echo $inicio; ?> - <?php echo $final;?></p>
					<input type="time" name="hora" min="<?php echo $inicio ?>" max="<?php echo $final ?>"  required>
					
				<a href="listado_cita.php" class="btn_ok"> Cancelar</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >


			</form>
			</div>
		</section>

	</body>

</html>
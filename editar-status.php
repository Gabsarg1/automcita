<?php
	session_start();
	
include 'includes/conexion.php';
$alert='';
	
	if(!empty($_POST)){
		
		$ci_cliente = $_POST['ci_cliente'];
		$ci_cosmetologa = $_POST['ci_cosmetologa'];
		$idservicio = $_POST['idservicio'];
		$fecha = $_POST['fecha'];
		$hora = $_POST['hora'];
		$idstatus = $_POST['idatatus'];	
		
		if(!empty($_POST['observacion'])){
			$observacion = $_POST['observacion'];

			$query_status = mysqli_query($conexion,"UPDATE cita SET idstatus = '$idstatus', observacion = '$observacion'
											WHERE ci_cliente = '$ci_cliente' AND  ci_cosmetologa = '$ci_cosmetologa' 
												AND idservicio = '$idservicio' AND fecha = '$fecha' AND hora = '$hora'"); 
			if($query_status){
				$alert='<p class="msg_save">Estatus Actualizado Correctamente</p>';	
				header("refresh:1;url=listado_cita.php");
			}else{
				$alert='<p class="msg_error">Error al actualizar status de la cita</p>';	
				header("refresh:2;url=listado_cita.php");
			}
		}else{
			$query_status = mysqli_query($conexion,"UPDATE cita SET idstatus = '$idstatus'
												WHERE ci_cliente = '$ci_cliente' AND  ci_cosmetologa = '$ci_cosmetologa' 
													AND idservicio = '$idservicio' AND fecha = '$fecha' AND hora = '$hora'"); 
			if($query_status){
				$alert='<p class="msg_save">Status Actualizado Correctamente</p>';	
				header("refresh:1;url=listado_cita.php");
			}else{
				$alert='<p class="msg_error">Error al actualizar status de la cita</p>';	
				header("refresh:2;url=listado_cita.php");
			}
		}
	}
	
	if(empty($_REQUEST['ci_cliente']) || empty($_REQUEST['ci_cosmetologa']) || empty($_REQUEST['idservicio']) || 
		empty($_REQUEST['fecha']) || empty($_REQUEST['hora'])){
		
		header('location:listado_cita.php');
	}
	$ci_cliente = $_REQUEST['ci_cliente'];
	$ci_cosmetologa = $_REQUEST['ci_cosmetologa'];
	$idservicio = $_REQUEST['idservicio'];
	$fecha = $_REQUEST['fecha'];
	$hora = $_REQUEST['hora'];
		
		$sql =mysqli_query($conexion, "SELECT cit.idstatus, sta.status, cit.observacion
									FROM cita cit
									INNER JOIN status sta ON cit.idstatus = sta.idatatus
									WHERE cit.ci_cliente = '$ci_cliente' AND cit.ci_cosmetologa = '$ci_cosmetologa' 
										AND cit.idservicio = '$idservicio' AND cit.fecha = '$fecha' AND cit.hora = '$hora'");
		while ($data = mysqli_fetch_array($sql)){
			$idstatus = $data ['idstatus'];
			$status = $data ['status'];
			$observacion = $data ['observacion'];
		}
	
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Cambiar Estatus de la Cita</title>
		<?php include "includes/scripts.php";?>
		
<script type="text/javascript">
$(document).ready(function(){

    $("#idatatus").change( function() {
        if ($(this).val() === "2") {
            $("#observacion").prop("disabled", false);
        } else {
            $("#observacion").prop("disabled", true);
			$('#observacion').val('');
        }
    });

    
});
</script>
	</head>
	<body>	
		<?php include "includes/headeruser.php";?>

		<section class="container">
			<div class="register">
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
				<form action="" method="POST">
					<h2>Estatus de la Cita</h2>
					<hr>
								
					<label for ="idatatus">Estatus </label>
					
					<select name="idatatus" id="idatatus">
					<option value="<?php echo $idstatus ?>" selected><?php echo $status?></option>
				<?php
					$query_status=mysqli_query($conexion, "SELECT * FROM status");
					$result_status=mysqli_num_rows($query_status);
					
					if($result_status>0){
					while($estatus=mysqli_fetch_array($query_status)){
				?>	
					<option value="<?php echo $estatus["idatatus"];?>"><?php echo $estatus["status"];?></option>
				<?php				
					}
				}
				?>
					</select>
					
					<label for ="observacion" class="textleft">Observación</label>
					<input type="text" id="observacion" name="observacion" value="<?php echo $observacion; ?>" disabled>
			
					<input type="hidden" name="ci_cliente" value="<?php echo $ci_cliente; ?>">
					<input type="hidden" name="ci_cosmetologa" value="<?php echo $ci_cosmetologa; ?>">
					<input type="hidden" name="idservicio" value="<?php echo $idservicio; ?>">
					<input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
					<input type="hidden" name="hora" value="<?php echo $hora; ?>">
		
					<input type="submit" class="btn_save" value="Aceptar" >
				</form>
			</div>
		</section>

	</body>

</html>
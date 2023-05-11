<?php
	session_start();
if ($_SESSION['idrol'] == 2){
	header("location: index.php");
}
require 'includes/conexion.php';

	if(!empty($_POST)){
		$ci_cosmetologa = $_POST['ci_cosmetologa'];
		$descripcion_servicio = $_POST['idservicio'];
	 
		$query_delete = mysqli_query($conexion,"DELETE FROM trabajo WHERE ci_cosmetologa = '$ci_cosmetologa' AND idservicio = '$descripcion_servicio'");
	 
		if($query_delete){
			header("Location:listado_especialidad.php");	
		}else{
			$alert='<p class="msg_error">Error al eliminar especialidad del cosmetólogo</p>';	
			header("refresh:1;url=listado-telefono_especialidad.php");	
		}
	}
	
	if(empty($_REQUEST['ci']) || empty($_REQUEST['servicio']) )
    {
        header('location:listado_cliente.php');
    }else{
        $ci_cosmetologa = $_REQUEST['ci'];
        $idservicio = $_REQUEST['servicio'];
		
		$sql =mysqli_query($conexion, "SELECT tr.ci_cosmetologa, tr.idservicio, s.descripcion_servicio, u.nombreu, u. apellidou
									FROM trabajo tr
									INNER JOIN usuario u ON tr.ci_cosmetologa = u.ci_usuario
									INNER JOIN servicio s    ON tr.idservicio = s.idservicio
									WHERE tr.ci_cosmetologa = '$ci_cosmetologa' AND tr.idservicio = '$idservicio'");
			
			while ($mostrar = mysqli_fetch_array($sql)){	
			$nombre = $mostrar['nombreu'];
			$apellido = $mostrar['apellidou'];
			$descripcion_servicio=$mostrar['descripcion_servicio'];
			}
	}
    ?>

<HTML>
	<HEAD>
		<TITLE>Eliminar Especialidad Cosmetólogo</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<div class="data_delete">
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				<h3> ¿Desea eliminar la siguiente especialidad del cosmetólogo?</h3>
					</br>
					
					<p>Cosmetólogo: <span><?php echo $nombre.' '.$apellido;?></span></p>
					<p>Cédula: <span><?php echo $ci_cosmetologa;?></span></p>
					<p>Especialidad a eliminar: <span><?php echo $descripcion_servicio;?></span></p>
					
					

					<form method="POST" action="">
						<input type="hidden" name="ci_cosmetologa" value="<?php echo $ci_cosmetologa; ?>">
						<input type="hidden" name="idservicio" value="<?php echo $idservicio; ?>">
						
						<a href="listado_especialidad.php" class="btn_cancel"> Volver </a>
						<button type="submit" class="btn_ok"> Eliminar</button>
						
						</tr>
					</form>
			</div>
		</section>
	</BODY>
</HTML>
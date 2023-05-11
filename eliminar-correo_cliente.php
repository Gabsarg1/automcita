<?php
	session_start();

require 'includes/conexion.php';

	if(!empty($_POST)){
		$ci_cliente = $_POST['ci_cliente'];
		$correo_cliente = $_POST['correo_cliente'];
		$iddominio = $_POST['iddominio'];
	 
		$query_delete = mysqli_query($conexion,"DELETE FROM correo_cliente WHERE ci_cliente = '$ci_cliente' AND correo_cliente = '$correo_cliente' AND iddominio = '$iddominio' ");
	 
		if($query_delete){
			header("Location:listado-correo_cliente.php?ci=$ci_cliente");	
		}else{
			$alert='<p class="msg_error">Error al eliminar telefono del cliente</p>';	
			header("refresh:1;url=listado-correo_cliente.php?&ci=$ci_cliente");	
		}
	}
	
	if( empty($_REQUEST['ci']) )
    {
        header('location:listado_cliente.php');
    }else{
        $ci_cliente = $_REQUEST['ci'];
        $correo_cliente = $_REQUEST['correo'];
        $iddominio = $_REQUEST['dominio'];
		
		$sql =mysqli_query($conexion, "SELECT co.ci_cliente, co.correo_cliente, d.descripcion_dominio, co.iddominio, c. nombre, c.apellido
									FROM correo_cliente co
									INNER JOIN dominio d        ON co.iddominio = d.iddominio
									INNER JOIN cliente c        ON co.ci_cliente = c.ci_cliente
									WHERE co.ci_cliente = '$ci_cliente' AND co.correo_cliente = '$correo_cliente' AND co.iddominio = '$iddominio' ");
			
			while ($mostrar = mysqli_fetch_array($sql)){		
			$descripcion_dominio=$mostrar['descripcion_dominio'];
			$nombre=$mostrar['nombre'];
			$apellido=$mostrar['apellido'];
			}
	}
    ?>

<HTML>
	<HEAD>
		<TITLE>Listado Correos del Cliente</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<div class="data_delete">
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				<h3> ¿Desea eliminar el siguiente correo?</h3>
					</br>
					
					<p>Nombre del cliente: <span><?php echo $nombre. ' ' .$apellido;?></span></p>
					<p>Correo a eliminar: <span><?php echo $correo_cliente; echo $descripcion_dominio;?></span></p>
					
					

					<form method="POST" action="">
						<input type="hidden" name="ci_cliente" value="<?php echo $ci_cliente; ?>">
						<input type="hidden" name="iddominio" value="<?php echo $iddominio; ?>">
						<input type="hidden" name="correo_cliente" value="<?php echo $correo_cliente; ?>">
						
						<a href="listado-correo_cliente.php?ci=<?php echo $ci_cliente?>" class="btn_cancel"> Volver </a>
						<button type="submit" class="btn_ok"> Eliminar</button>
						
						</tr>
					</form>
			</div>
		</section>
	</BODY>
</HTML>
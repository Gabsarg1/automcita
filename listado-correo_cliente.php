<?php
	session_start();
	
	if( empty($_REQUEST['ci']) ){
		header('location:listado_cliente.php');
	}else{
		$ci_cliente = $_REQUEST['ci'];
	
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
			<h2 class="htabla">Listado Correo del Cliente</h2>
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
			<table class="service">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Opción</th>
				</tr>
			</thead>
			<?php
			require 'includes/conexion.php';
				$sql =mysqli_query($conexion, "SELECT co.ci_cliente, c.nombre, c.apellido, co.correo_cliente, dom.descripcion_dominio, co.iddominio
												FROM correo_cliente co
												INNER JOIN dominio dom ON co.iddominio = dom.iddominio
												INNER JOIN cliente c        ON co.ci_cliente = c.ci_cliente
												WHERE co.ci_cliente = '$ci_cliente'");
			$result_correo=mysqli_num_rows($sql);
			mysqli_close($conexion);
			
			if($result_correo>0){
				while ($mostrar = mysqli_fetch_array($sql)){
					
				$ci_cliente=$mostrar['ci_cliente'];
				$nombre=$mostrar['nombre'];
				$apellido=$mostrar['apellido'];
				$correo_cliente=$mostrar['correo_cliente'];
				$descripcion_dominio=$mostrar['descripcion_dominio'];
				$iddominio=$mostrar['iddominio'];
			?>
				<form method="POST" action="">
					<tr>
						<td><?php echo $ci_cliente?></td>
						<td><?php echo $nombre; echo $apellido?></td>
						<input type="hidden" name="iddominio"  value="<?php echo $iddominio ?>" readonly>
						<td><?php echo $correo_cliente; echo $descripcion_dominio?></td>
						<td><a class="delete" href="eliminar-correo_cliente.php?ci=<?php echo $ci_cliente?>&correo=<?php echo $correo_cliente?>&dominio=<?php echo $iddominio?>">Eliminar</a></td>			
					</tr>
				</form>
			<?php
				}
			}
	}
			?>
			</table>
			<a href="listado_cliente.php" class="btn_cancel volver"> Volver</a> 
			<a class="btn_cancel" href="agregar-correo_cliente.php?ci=<?php echo $ci_cliente?>">Agregar</a>
		</section>
	</BODY>
</HTML>
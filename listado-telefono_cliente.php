<?php
	session_start();
	
	if( empty($_REQUEST['ci']) ){
		header('location:listado_cliente.php');
	}else{
		$ci_cliente = $_REQUEST['ci'];
	
?>

<HTML>
	<HEAD>
		<TITLE>Listado Teléfonos del Cliente</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<h2 class="htabla">Listado Teléfonos del Cliente</h2>
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
			<table class="service">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<?php
			require 'includes/conexion.php';
				$sql =mysqli_query($conexion, "SELECT telf.ci_cliente, c.nombre, c.apellido, telf.idarea, a.descripcion_area, telf.telefono_cliente
									FROM telefono_cliente telf
									INNER JOIN area a        ON telf.idarea = a.idarea
									INNER JOIN cliente c        ON telf.ci_cliente = c.ci_cliente
									WHERE telf.ci_cliente = '$ci_cliente'");
			$result_telefono=mysqli_num_rows($sql);
			mysqli_close($conexion);
			
			if($result_telefono>0){
				while ($mostrar = mysqli_fetch_array($sql)){
				
				$ci_cliente=$mostrar['ci_cliente'];
				$nombre=$mostrar['nombre'];
				$apellido=$mostrar['apellido'];
				$idarea=$mostrar['idarea'];
				$area=$mostrar['descripcion_area'];
				$telefono_cliente=$mostrar['telefono_cliente'];
			?>
				<form method="POST" action="">
					<tr>
						<td><?php echo $ci_cliente?></td>
						<td><?php echo $nombre. ' ' . $apellido?></td>
						<input type="hidden" name="idarea"  value="<?php echo $idarea ?>" readonly>
						<td><?php echo $area; echo $telefono_cliente?></td>
						<td><a class="delete" href="eliminar-telf_cliente.php?ci=<?php echo $ci_cliente?>&area=<?php echo $idarea?>&telefono=<?php echo $telefono_cliente?>">Eliminar</a></td>			
					</tr>
				</form>
			<?php
				}
			}
	}
			?>
			</table>
			<a href="listado_cliente.php" class="btn_cancel volver"> Volver</a> 
			<a class="btn_cancel" href="agregar-telf_cliente.php?ci=<?php echo $ci_cliente?>">Agregar</a>
		</section>
	</BODY>
</HTML>
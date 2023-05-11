<?php 
	session_start();
	if ($_SESSION['idrol'] == 2){
		header("location: index.php");
	}
?>
<html lang="en">
	<head>
	<meta charset=utf-8"/>
		<title>Busqueda Citas</title>
		<?php include "includes/scripts.php";?>
	</head>

	<body>	
	<?php include "includes/headeruser.php";
	include 'includes/conexion.php';

	?>

		<section class="container" >
			<?php
				$busqueda =strtolower ($_REQUEST['busqueda']);
				if(empty($busqueda)){
					header("location:listado_cita.php");
				}
			?>			
			<h2>Búsqueda de la Cita</h2>
				
				<form action="buscar_cita.php" method="get" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
					<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
				</form>
				
				<table>
					<tr>
						<th>Cliente</th>
						<th>Cosmetólogo</th>
						<th>Servicio</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Observación</th>
						<th>Estatus</th>
						<th>Opciones</th>
					</tr>
				<?php
					
					$query= mysqli_query($conexion, "SELECT cit.ci_cliente, c.nombre, c.apellido,
															cit.ci_cosmetologa, u.nombreu, u.apellidou,
															cit.idservicio, s.descripcion_servicio, 
															cit.fecha, cit.hora, cit.observacion, 
															cit.idstatus, sta.status
													FROM cita cit
													INNER JOIN cliente c  		ON cit.ci_cliente = c.ci_cliente
													INNER JOIN usuario u  		ON cit.ci_cosmetologa = u.ci_usuario
													INNER JOIN servicio s   	ON cit.idservicio = s.idservicio
													INNER JOIN status sta  		ON cit.idstatus = sta.idatatus
													WHERE 
														(c.nombre like '%$busqueda%' OR
														c.apellido like '%$busqueda%' OR
														u.nombreu like '%$busqueda%' OR
														u.apellidou like '%$busqueda%' OR
														s.descripcion_servicio like '%$busqueda%' OR
														cit.fecha like '%$busqueda%' OR
														cit.hora like '%$busqueda%' OR
														sta.status like '%$busqueda%' OR
														observacion like '%$busqueda%')
													ORDER BY cit.fecha ASC");
					mysqli_close($conexion);
														
					while($mostrar=mysqli_fetch_array($query)) {
						$ci_cliente=$mostrar['ci_cliente'];
						$ci_cosmetologa=$mostrar['ci_cosmetologa'];
						$idservicio=$mostrar['idservicio'];
						$fecha=$mostrar['fecha'];
						$hora=$mostrar['hora'];
				?>
					<tr>
						<td><?php echo $mostrar['nombre'].' '. $mostrar['apellido']?></td>
						<td><?php echo $mostrar['nombreu'].' '. $mostrar['apellidou']?></td>
						<td><?php echo $mostrar['descripcion_servicio']?></td>
						<td><?php echo $fecha?></td>
						<td><?php echo $hora?></td>
						<td><?php echo $mostrar['observacion']?></td>
						<td><?php echo $mostrar['status']?></td>
						<td><a class="edit" href="mas_cliente.php?ci=<?php echo $ci_cliente?>">Detalles Cliente</a> 
							||
							<a class="delete" href="editar-status.php?
													ci_cliente=<?php echo $ci_cliente;?>
													&ci_cosmetologa=<?php echo $ci_cosmetologa;?>
													&idservicio=<?php echo $idservicio;?>
													&fecha=<?php echo $fecha;?>
													&hora=<?php echo $hora;?>">Cambiar status<a/>
						</td>
					</tr>
				<?php
					}
				?>	
				</table>
				
				<input type="submit" value="Agregar" class="agregar" onclick="location.href='nueva_cita.php'">
		</section>
	</body>
</html>
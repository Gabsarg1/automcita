<?php 
session_start();
	if ($_SESSION['idrol'] == 2){
		header("location: index.php");
	}
?>
<html lang="en">
	<head>
	<meta charset=utf-8"/>
		<title>Busqueda Especialidad</title>
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
					header("location:listado_especialidad.php");
				}
			?>			
			<h2>Búsqueda de la Especialidad</h2>
				
				<form action="buscar_especialidad.php" method="get" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
					<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
				</form>
				
				<table class="especialidad">
					<tr>
						<th>Cédula</th>
						<th>Cosmetólogo</th>
						<th>Servicio</th>
						<th>Horario</th>
						<th>Opción</th>
					</tr>
				<?php
					
					$query= mysqli_query($conexion, "SELECT e.ci_cosmetologa, u.nombreu, u.apellidou, e.idservicio, s.descripcion_servicio, 
															e.horario_inicio, e.horario_final
													FROM trabajo e
													INNER JOIN usuario u ON e.ci_cosmetologa = u.ci_usuario
													INNER JOIN servicio s ON e.idservicio = s.idservicio
													WHERE 
														(e.ci_cosmetologa like '%$busqueda%' OR
														u.nombreu like '%$busqueda%' OR
														u.apellidou like '%$busqueda%' OR
														s.descripcion_servicio like '%$busqueda%' OR
														e.horario_inicio like '%$busqueda%' OR
														e.horario_final like '%$busqueda%' )");
					mysqli_close($conexion);
														
					while($mostrar=mysqli_fetch_array($query)) {
				?>
					<tr>
						<td><?php echo $mostrar['ci_cosmetologa']?></td>
						<td><?php echo $mostrar['nombreu'].' '.$mostrar['apellidou']?></td>
						<td><?php echo $mostrar['descripcion_servicio']?></td>
						<td><?php echo $mostrar['horario_inicio']?> a <?php echo $mostrar['horario_final']?></td>
						<td><a class="delete" href="eliminar_especialidad.php?ci=<?php echo $mostrar['ci_cosmetologa']?>&servicio=<?php echo $mostrar['idservicio']?>">Eliminar</a></td>				
					</tr>
				<?php
					}
				?>	
				</table>
				<input type="submit" value="Agregar" class="agregar" onclick="location.href='agregar_especialidad.php'">
		</section>
		
	</body>

</html>
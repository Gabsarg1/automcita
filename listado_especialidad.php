<?php
	session_start();
	if ($_SESSION['idrol'] == 2){
		header("location: index.php");
	}
	include 'includes/conexion.php';
?>

<HTML>
	<HEAD>
		<TITLE>Listado Especialidad</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >
			<h2 class="htabla">Listado de Especialidades</h2>
			
			<form action="buscar_especialidad.php" method="GET" class="form_search">
				<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
				<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
			</form>
			
			<table class="especialidad">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Cosmetólogo</th>
					<th>Servicio</th>
					<th>Horario</th>
					<th>Opción</th>
				</tr>
			</thead>
			
			
			<?php
				$resultado= mysqli_query($conexion, "SELECT e.ci_cosmetologa, u.nombreu, u.apellidou, e.idservicio, s.descripcion_servicio, e.horario_inicio, e.horario_final
													FROM trabajo e
													INNER JOIN usuario u ON e.ci_cosmetologa = u.ci_usuario
													INNER JOIN servicio s ON e.idservicio = s.idservicio");
				mysqli_close($conexion);									
				while($mostrar=mysqli_fetch_array($resultado)) {
			?>
				<tr>
					<td><?php echo $mostrar['ci_cosmetologa']?></td>
					<td><?php echo $mostrar['nombreu'].' '.$mostrar['apellidou']?> </td>
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
	</BODY>
</HTML>
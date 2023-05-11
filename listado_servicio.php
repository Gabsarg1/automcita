<?php
	session_start();
	if ($_SESSION['idrol'] == 2){
		header("location: index.php");
	}
?>

<HTML>
	<HEAD>
		<TITLE>Listado Servicios</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >
			<h2 class="htabla">Listado de Servicios</h2>
			
			<table class="service">
			<thead>
				<tr>
					<th>Servicio</th>
					<th>Opción</th>
				</tr>
			</thead>
			<?php
			include 'includes/conexion.php';
				$resultado= mysqli_query($conexion, "SELECT * FROM servicio");
				mysqli_close($conexion);
				while($mostrar=mysqli_fetch_array($resultado)) {
			?>
				<tr>
					<td><?php echo $mostrar['descripcion_servicio']?></td>
					<td><a class="delete" href="eliminar_servicio.php?id=<?php echo $mostrar['idservicio']?>">Eliminar</a></td>				

				</tr>
			<?php
				}
			?>
			</table>
			<input type="submit" value="Agregar" class="agregar" onclick="location.href='nuevo_servicio.php'">
		</section>
	</BODY>
</HTML>
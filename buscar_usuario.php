<?php
session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
?>
<html lang="en">
	<head>
	<meta charset=utf-8"/>
		<title>Busqueda Usuario</title>
		<?php include "includes/scripts.php";?>
	</head>

	<body>	
	<?php 
		include "includes/headeruser.php";
	?>

	<section class="container" >
		<?php
			$busqueda =strtolower ($_REQUEST['busqueda']);
			if(empty($busqueda)){
				header("location:listado_usuario.php");
			}
		?>			
		<h2>Búsqueda de Usuario</h2>
				
		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
			<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
		</form>
			<table>
				<tr>
					<th>Cédula</th>
					<th>Nombre </th>
					<th>Usuario</th>
					<th>Género</th>
					<th>Cargo</th>
					<th>Teléfono</th>
					<th>Correo</th>
					<th>Dirección</th>
					<th>Opciones</th>
				</tr>
				
	<?php
		include 'includes/conexion.php';
		$query= mysqli_query($conexion, "SELECT u.ci_usuario, u.nombreu, u.apellidou, u.usuario, g.descripcion, u.direccion, r.nombrerol,
												telf.telefono_usuario, a.descripcion_area, co.correo_usuario, dom.descripcion_dominio 
												FROM usuario u
												INNER JOIN genero g      ON u.codgenero = g.codgenero
												INNER JOIN rol r         ON u.idrol = r.idrol 
												
												INNER JOIN telefono_usuario telf ON u.ci_usuario = telf.ci_usuario
												INNER JOIN area a                ON telf.idarea = a.idarea
												
												INNER JOIN correo_usuario co ON u.ci_usuario = co.ci_usuario
												INNER JOIN dominio dom       ON co.iddominio = dom.iddominio
												WHERE 
													(u.ci_usuario like '%$busqueda%' OR
													u.usuario like '%$busqueda%' OR
													u.nombreu like '%$busqueda%' OR
													u.apellidou like '%$busqueda%' OR
													g.descripcion like '%$busqueda%' OR
													u.direccion like '%$busqueda%' OR
													r.nombrerol like '%$busqueda%' OR
													telf.telefono_usuario like '%$busqueda%' OR
													a.descripcion_area like '%$busqueda%' OR
													co.correo_usuario like '%$busqueda%' OR
													dom.descripcion_dominio like '%$busqueda%') 
												AND estatus= 1");								
		mysqli_close($conexion);									
		while($mostrar=mysqli_fetch_array($query)) {
	?>
			<tr>
				<td><?php echo $mostrar['ci_usuario']?></td>
				<td><?php echo $mostrar['nombreu']. " " .$mostrar['apellidou']?></td>
				<td><?php echo $mostrar['usuario']?></td>
				<td><?php echo $mostrar['descripcion']?></td>
				<td><?php echo $mostrar['nombrerol']?></td>						
				<td><?php echo $mostrar['descripcion_area']; echo $mostrar['telefono_usuario']?></td>
				<td><?php echo $mostrar['correo_usuario']; echo $mostrar['descripcion_dominio']?></td>
				<td><?php echo $mostrar['direccion']?></td>
						
				<td><a class="edit" href="editar_usuario.php?ci=<?php echo $mostrar['ci_usuario']?>">Editar</a>
				<?php if (!empty($mostrar['ci_usuario']))
						{
					?>
						||
					<a class="delete" href="eliminar_usuario.php?ci=<?php echo $mostrar['ci_usuario']?>">Eliminar</a>
					<br>
					<a class="mas" href="listado-telefono_usuario.php?ci=<?php echo $mostrar['ci_usuario']?>">Telf<a/>
						||
					<a class="mas" href="listado-correo_usuario.php?ci=<?php echo $mostrar['ci_usuario']?>">Correo<a/>
				<?php 
					}
				?>
				</td>
			</tr>
	<?php
		}
	?>	
			</table>
			<input type="submit" value="Agregar" class="agregar" onclick="location.href='agregar_usuario.php'">
		</section>
	</body>
</html>
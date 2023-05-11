<?php
session_start();
?>
<html lang="en">
	<head>
	<meta charset=utf-8"/>
		<title>Busqueda Cliente</title>
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
					header("location:listado_cliente.php");
				}
			?>			
			<h2>Búsqueda de Cliente</h2>
				
				<form action="buscar_cliente.php" method="get" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
					<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
				</form>
				<table>
					<tr>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Género</th>
						<th>Teléfono</th>
						<th>Correo</th>
						<th>Dirección</th>
						<th>Opciones</th>
					</tr>
				<?php
					
					$query= mysqli_query($conexion, "SELECT c.ci_cliente, c.nombre, c.apellido, g.descripcion, 
															e.estado, ciu.ciudad, m.municipio, d.detalle_direccion,
															telf.telefono_cliente, a.descripcion_area, 
															co.correo_cliente, dom.descripcion_dominio
													FROM cliente c
													INNER JOIN genero g      ON c.codgenero = g.codgenero
													
													INNER JOIN direccion d   ON c.ci_cliente = d.ci_cliente
													INNER JOIN estados e         ON d.id_estado = e.id_estado
													INNER JOIN ciudades ciu      ON d.id_ciudad = ciu.id_ciudad
													INNER JOIN municipios m      ON d.id_municipio = m.id_municipio
													
													INNER JOIN telefono_cliente telf ON c.ci_cliente = telf.ci_cliente
													INNER JOIN area a                ON telf.idarea = a.idarea
													
													INNER JOIN correo_cliente co ON c.ci_cliente = co.ci_cliente
													INNER JOIN dominio dom       ON co.iddominio = dom.iddominio
													WHERE 
														(c.ci_cliente like '%$busqueda%' OR
														c.nombre like '%$busqueda%' OR
														c.apellido like '%$busqueda%' OR
														g.descripcion like '%$busqueda%' OR
														e.estado like '%$busqueda%' OR
														ciu.ciudad like '%$busqueda%' OR
														m.municipio like '%$busqueda%' OR
														d.detalle_direccion like '%$busqueda%' OR
														
														telf.telefono_cliente like '%$busqueda%' OR
														a.descripcion_area like '%$busqueda%' OR
														
														co.correo_cliente like '%$busqueda%' OR
														dom.descripcion_dominio like '%$busqueda%') 
													AND estatus= 1");								
					mysqli_close($conexion);									
					while($mostrar=mysqli_fetch_array($query)) {
						$ci_cliente=$mostrar['ci_cliente'];
						$estado=$mostrar['estado'];
						$ciudad=$mostrar['ciudad'];
						$municipio=$mostrar['municipio'];
						$detalle_direccion=$mostrar['detalle_direccion'];
							if(!empty ($detalle_direccion)){
								$direccion = $estado. ", " .$ciudad.", ".$municipio.", ".$detalle_direccion.".";
							} else{
								$direccion = $estado. ", " .$ciudad.", ".$municipio.".";
							}
				?>
					<tr>
						<td><?php echo $mostrar['ci_cliente']?></td>
						<td><?php echo $mostrar['nombre'];?></td>
						<td><?php echo $mostrar['apellido'];?></td>
						<td><?php echo $mostrar['descripcion']?></td>	
						<td><?php echo $mostrar['descripcion_area']; echo $mostrar['telefono_cliente']?></td>
						<td><?php echo $mostrar['correo_cliente']; echo $mostrar['descripcion_dominio']?></td>
						<td><?php echo $direccion; ?></td>
						<td><a class="edit" href="editar_cliente.php?ci=<?php echo $ci_cliente?>">Editar</a> 
							||
						<a class="delete" href="eliminar_cliente.php?ci=<?php echo $ci_cliente?>">Eliminar</a>

					<br>
						<a class="mas" href="listado-telefono_cliente.php?ci=<?php echo $ci_cliente?>">Telf<a/>
							||
						<a class="mas" href="listado-correo_cliente.php?ci=<?php echo $ci_cliente?>">Correo<a/>
					</td>	
					</tr>
				<?php
					}
				?>	
				</table>
				<input type="submit" value="Agregar" class="agregar" onclick="location.href='agregar_cliente.php'">
		</section>
		
	</body>

</html>
<?php
	session_start();
	
	if(empty($_SESSION['active'])){
	header ("Location: ingreso.php");

}
?>
<HTML>
	<HEAD>
		<TITLE>Listado Clientes</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >
			<h2 class="htabla">Listado de Clientes</h2>
			
			<form action="buscar_cliente.php" method="GET" class="form_search">
				<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
				<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
			</form>
			
			<table>
			<thead>
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
			</thead>
			<?php
			require 'includes/conexion.php';
				$resultado= mysqli_query($conexion, "SELECT  c.ci_cliente, c.nombre, c.apellido, g.descripcion, 
														e.estado, ciu.ciudad, m.municipio, d.detalle_direccion
													FROM cliente c
													INNER JOIN genero g      ON c.codgenero = g.codgenero
													INNER JOIN direccion d   ON c.ci_cliente = d.ci_cliente
													INNER JOIN estados e         ON d.id_estado = e.id_estado
													INNER JOIN ciudades ciu      ON d.id_ciudad = ciu.id_ciudad
													INNER JOIN municipios m      ON d.id_municipio = m.id_municipio
													WHERE estatus=1
													ORDER BY fechaingreso DESC");
													
				while($mostrar=mysqli_fetch_array($resultado)) {
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
					<td><?php echo $ci_cliente?></td>
					<td><?php echo $mostrar['nombre']?></td>
					<td><?php echo $mostrar['apellido']?></td>
					<td><?php echo $mostrar['descripcion']?></td>
					
					<td><?php $telefono= mysqli_query($conexion, "SELECT telf.ci_cliente, a.descripcion_area, telf.telefono_cliente
													FROM telefono_cliente telf
													INNER JOIN area a ON telf.idarea = a.idarea
													WHERE ci_cliente = '$ci_cliente'");
								while($mostrar_telf=mysqli_fetch_array($telefono)) {
									$telf= $mostrar_telf['descripcion_area'].$mostrar_telf['telefono_cliente'];
									echo $telf; ?> <br> <?php
								}		
						?>
								
					</td>
					
					<td><?php $correo= mysqli_query($conexion, "SELECT co.ci_cliente, co.correo_cliente, dom.descripcion_dominio
													FROM correo_cliente co
													INNER JOIN dominio dom ON co.iddominio = dom.iddominio
													WHERE ci_cliente = '$ci_cliente'");
								while($mostrar_correo=mysqli_fetch_array($correo)) {
									$email= $mostrar_correo['correo_cliente'].$mostrar_correo['descripcion_dominio'];
								echo $email;?> <br> <?php
								}		
						?>
								
					</td>
					
					<td><?php echo $direccion;?></td>
					
					<td><a class="edit" href="editar_cliente.php?ci=<?php echo $ci_cliente?>">Editar </a> 
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
	</BODY>
</HTML>
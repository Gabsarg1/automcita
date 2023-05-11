<?php
	session_start();
	include 'includes/conexion.php';
?>

<HTML>
	<HEAD>
		<TITLE>Citas</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >
			<h2 class="htabla">Listado de Citas</h2>

			
			<?php
				if ($_SESSION['idrol'] !=2){
			?>
			<form action="buscar_cita.php" method="GET" class="form_search">
				<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
				<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
			</form>
			<?php
				}
			?>
			
			<table>
			<thead>
				<tr>
				<th>Cliente</th>
					<?php
						if ($_SESSION['idrol'] !=2){	
					?>
						<th>Cosmetólogo</th>
					<?php
						}
					?>
					<th>Servicio</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Observación</th>
					<th>Estatus</th>
					<th>Opciones</th>
				</tr>
			</thead>
			
			
			<?php
			if ($_SESSION['idrol'] ==2){
				
				$ci_usuario= $_SESSION['ci_usuario'];
				
				$resultado= mysqli_query($conexion, "SELECT cit.ci_cliente, c.nombre, c.apellido, c.estatus,
															cit.idservicio, s.descripcion_servicio, u.estatus,
															cit.fecha, cit.hora, cit.observacion, sta.status
													FROM cita cit
													INNER JOIN cliente c  		ON cit.ci_cliente = c.ci_cliente
													INNER JOIN usuario u  		ON cit.ci_cosmetologa = u.ci_usuario
													INNER JOIN servicio s   	ON cit.idservicio = s.idservicio
													INNER JOIN status sta  		ON cit.idstatus = sta.idatatus
													WHERE (fecha <= date_add(CURDATE(), interval 1 week) 
															AND fecha >= date_add(CURDATE(), interval 1 day) 
															OR fecha=CURDATE() )
															AND cit.ci_cosmetologa = '$ci_usuario'
															AND u.estatus = 1
															AND c.estatus = 1
													ORDER BY cit.fecha,cit.hora ASC");
				mysqli_close($conexion);									
				while($mostrar=mysqli_fetch_array($resultado)) {
					$ci_cliente=$mostrar['ci_cliente'];
					$idservicio=$mostrar['idservicio'];
					
			?>	
			<tr>
				<td><?php echo $mostrar['nombre'].' '.$mostrar['apellido']?></td>
				<td><?php echo $mostrar['descripcion_servicio']?></td>
				<td><?php echo $mostrar['fecha']?></td>
				<td><?php echo $mostrar['hora']?></td>
				<td><?php echo $mostrar['observacion']?></td>
				<td><?php echo $mostrar['status']?></td>
				<td><a class="edit" href="mas_cliente.php?ci=<?php echo $ci_cliente;?>">Detalles Cliente</a> 
							||
					<a class="delete" href="editar-status.php?
													ci_cliente=<?php echo $ci_cliente;?>
													&ci_cosmetologa=<?php echo $ci_usuario;?>
													&idservicio=<?php echo $idservicio;?>
													&fecha=<?php echo $mostrar['fecha'];?>
													&hora=<?php echo $mostrar['hora'];?>">Cambiar status<a/>
				</td>
				
			</tr>
				
			<?php
				}
				
			}else{
				$resultadoc= mysqli_query($conexion, "SELECT cit.ci_cliente, c.nombre, c.apellido, c.estatus,  u.estatus,
															 cit.ci_cosmetologa, u.nombreu, u.apellidou,
															cit.idservicio, s.descripcion_servicio, 
															cit.fecha, cit.hora, cit.observacion, sta.status
													FROM cita cit
													INNER JOIN cliente c  		ON cit.ci_cliente = c.ci_cliente
													INNER JOIN usuario u  		ON cit.ci_cosmetologa = u.ci_usuario
													INNER JOIN servicio s   	ON cit.idservicio = s.idservicio
													INNER JOIN status sta  		ON cit.idstatus = sta.idatatus
													WHERE (fecha <= date_add(CURDATE(), interval 1 week) 
															AND fecha >= date_add(CURDATE(), interval 1 day) 
															OR fecha=CURDATE() )
															AND u.estatus = 1
															AND c.estatus = 1
													ORDER BY cit.fecha,cit.hora ASC");
						
				mysqli_close($conexion);									
				while($mostrar=mysqli_fetch_array($resultadoc)) {
						$ci_cliente=$mostrar['ci_cliente'];
						$ci_cosmetologa=$mostrar['ci_cosmetologa'];
						$idservicio=$mostrar['idservicio'];
						$fecha=$mostrar['fecha'];
						$hora=$mostrar['hora'];
			?>	
			<tr>
				<td><?php echo $mostrar['nombre'].' '.$mostrar['apellido']?></td>
				<td><?php echo $mostrar['nombreu'].' '.$mostrar['apellidou']?></td>
				<td><?php echo $mostrar['descripcion_servicio']?></td>
				<td><?php echo $fecha?></td>
				<td><?php echo $hora?></td>
				<td><?php echo $mostrar['observacion']?></td>
				<td><?php echo $mostrar['status']?></td>
				<td><a class="edit" href="mas_cliente.php?ci=<?php echo $ci_cliente;?>">Detalles Cliente</a> 
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
			}
			?>
			</table>
			<?php 
				if ($_SESSION['idrol'] !=2) { 
			?>
				<input type="submit" value="Agregar" class="agregar" onclick="location.href='nueva_cita.php'">
			<?php 
				} 
			?>
		</section>
	</BODY>
</HTML>
<?php
	session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
?>
<HTML>
	<HEAD>
		<TITLE>Listado Usuarios</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		
		<section class="container" >
			<h2 class="htabla">Listado de Usuarios</h2>			
			<form action="buscar_usuario.php" method="GET" class="form_search">
				<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
				<input type="submit" value="Buscar" class="btn_search" placeholder="Buscar">
			</form>
			
			<table>
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Usuario</th>
					<th>Género</th>
					<th>Cargo</th>
					<th>Teléfono</th>
					<th>Correo</th>
					<th>Dirección</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<?php
			require 'includes/conexion.php';
				$resultado= mysqli_query($conexion, "SELECT u.ci_usuario, u.nombreu, u.apellidou, r.nombrerol,
													u.usuario, g.descripcion, u.direccion 
													FROM usuario u
													INNER JOIN genero g      ON u.codgenero = g.codgenero
													INNER JOIN rol r         ON u.idrol = r.idrol 
													WHERE estatus=1
													ORDER BY fechaingreso ASC");
													
				while($mostrar=mysqli_fetch_array($resultado)) {
					$ci_usuario=$mostrar['ci_usuario'];
			?>
				<tr>
					<td><?php echo $ci_usuario?></td>
					<td><?php echo $mostrar['nombreu']." ".  $mostrar['apellidou']?></td>
					<td><?php echo $mostrar['usuario']?></td>
					<td><?php echo $mostrar['descripcion']?></td>
					<td><?php echo $mostrar['nombrerol']?></td>
					
					<td><?php $telefono= mysqli_query($conexion, "SELECT telf.ci_usuario, a.descripcion_area, telf.telefono_usuario
													FROM telefono_usuario telf
													INNER JOIN area a ON telf.idarea = a.idarea
													WHERE  ci_usuario = '$ci_usuario'");
													
								while($mostrar_telf=mysqli_fetch_array($telefono)) {
									$telf= $mostrar_telf['descripcion_area'].$mostrar_telf['telefono_usuario'];
									echo $telf; ?> <br> <?php
								}		
						?>
								
					</td>
					
					<td><?php $correo= mysqli_query($conexion, "SELECT co.ci_usuario, co.correo_usuario, dom.descripcion_dominio
													FROM correo_usuario co
													INNER JOIN dominio dom ON co.iddominio = dom.iddominio
													WHERE ci_usuario = '$ci_usuario'");
													
								while($mostrar_correo=mysqli_fetch_array($correo)) {
									$email= $mostrar_correo['correo_usuario'].$mostrar_correo['descripcion_dominio'];
								echo $email;?> <br> 
								
							<?php
								}		
							?>
								
					</td>
					
					<td><?php echo $mostrar['direccion']?>.</td>
					<td>
					<?php if (!empty($mostrar['ci_usuario']))
						{
					?>
						<a class="edit" href="editar_usuario.php?ci=<?php echo $ci_usuario?>">Editar</a> 
							||
						<a class="delete" href="eliminar_usuario.php?ci=<?php echo $ci_usuario?>">Eliminar</a>	
						<br>
						<a class="mas" href="listado-telefono_usuario.php?ci=<?php echo $ci_usuario?>">Telf<a/>
							||
						<a class="mas" href="listado-correo_usuario.php?ci=<?php echo $ci_usuario?>">Correo<a/>
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
	</BODY>
</HTML>
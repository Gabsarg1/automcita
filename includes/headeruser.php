<?php

if(empty($_SESSION['active'])){
	header ("Location: ingreso.php");
}
?>

<header>
<div class="tit">
	<h1 class="titulo">DIVA´S STUDIO</h1>
</div>
	<nav>
		<ul>
		

			<li class="principal"> <a href="#">Cita</a>
				<ul>
				<?php 
					if ($_SESSION['idrol'] !=2) { 
				?>
					<li><a href="nueva_cita.php">Nueva Cita</a></li>
				<?php 
					} 
				?>
					<li><a href="listado_cita.php">Lista de Citas</a></li>
				</ul>
			</li>


			
	
					<li class="principal"> <a href="index.php">Usuario</a>
					<?php 
						if ($_SESSION['idrol'] !=2) { 
					?>
						<ul>
							<li><a href="agregar_usuario.php">Nuevo Usuario</a></li>
							<li><a href="listado_usuario.php">Lista de Usuarios</a></li>
							<li><a href="reporte_usuario.php" target="_blank">Reporte Usuarios</a></li>
						</ul>
					<?php 
						} 
					?>	
					</li>
				
			
			<?php 
				if ($_SESSION['idrol'] !=2) { 
			?>		
			<li class="principal"> <a href="#">Especialidad</a>
				<ul>
					<li><a href="agregar_especialidad.php">Nueva Especialidad</a></li>
					<li><a href="listado_especialidad.php">Lista de Especialidades</a></li>
				</ul>
			</li>
			<?php 
				}
			?>
			
			
			<?php 
				if ($_SESSION['idrol'] !=2) { 
			?>
				<li class="principal"> <a href="#">Servicio</a>
					<ul>
						<li><a href="nuevo_servicio.php">Nuevo Servicio</a></li>
						<li><a href="listado_servicio.php">Lista de Servicios</a></li>
					</ul>
				</li>
			<?php 
				}
			?>


			<li class="principal"> <a href="#">Cliente</a>
				<ul>
				<?php 
					if ($_SESSION['idrol'] !=2) { 
				?>
					<li><a href="agregar_cliente.php">Nuevo Cliente</a></li>
				<?php 
					}
				?>
					<li><a href="listado_cliente.php">Lista de Clientes</a></li>
				<?php 
					if ($_SESSION['idrol'] !=2) { 
				?>
					<li><a href="reporte_cliente.php" target="_blank">Reporte Clientes</a></li>
				<?php 
					}
				?>
				</ul>
			</li>

			
			<?php 
				if ($_SESSION['idrol'] !=2) { 
			?>
			<li class="principal"> <a href="backups/respaldo.php" target="_blank">Respaldo</a></li>
			<?php 
				}
			?>
			
			<li class="principal cerrar">
				<a href="includes/salir.php">Cerrar</a>
			</li>
		</ul>
	</nav>
</header>
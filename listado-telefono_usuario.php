<?php
	session_start();
	
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
	
	if( empty($_REQUEST['ci']) ){
		header('location:listado_usuario.php');
	}else{
		$ci_usuario = $_REQUEST['ci'];
	
?>

<HTML>
	<HEAD>
		<TITLE>Listado Teléfonos del Usuario</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<h2 class="htabla">Lista de Teléfonos del Usuario</h2>
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
			<table class="service">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<?php
			require 'includes/conexion.php';
				$sql =mysqli_query($conexion, "SELECT telf.ci_usuario, u.nombreu, u.apellidou, telf.idarea, a.descripcion_area, telf.telefono_usuario
									FROM telefono_usuario telf
									INNER JOIN area a        ON telf.idarea = a.idarea
									INNER JOIN usuario u     ON telf.ci_usuario = u.ci_usuario
									WHERE telf.ci_usuario = '$ci_usuario' ");
			$result_telefono=mysqli_num_rows($sql);
			mysqli_close($conexion);
			
			if($result_telefono>0){
				while ($mostrar = mysqli_fetch_array($sql)){

				$ci_usuario=$mostrar['ci_usuario'];
				$nombreu=$mostrar['nombreu'];
				$apellidou=$mostrar['apellidou'];
				$idarea=$mostrar['idarea'];
				$area=$mostrar['descripcion_area'];
				$telefono_usuario=$mostrar['telefono_usuario'];
			?>
				<form method="POST" action="">
					<tr>
						<td><?php echo $ci_usuario?></td>
						<td><?php echo $nombreu; echo $apellidou?></td>
						<input type="hidden" name="idarea"  value="<?php echo $idarea ?>" readonly>
						<td><?php echo $area; echo $telefono_usuario?></td>
						<td><a class="delete" href="eliminar-telf_usuario.php?ci=<?php echo $ci_usuario?>&area=<?php echo $idarea?>&telefono=<?php echo $telefono_usuario?>">Eliminar</a></td>			
					</tr>
				</form>
			<?php
				}
			}
	}
			?>
			</table>
			<a href="listado_usuario.php" class="btn_cancel volver"> Volver</a> 
			<a class="btn_cancel" href="agregar-telf_usuario.php?ci=<?php echo $ci_usuario?>">Agregar</a>
			
		</section>
	</BODY>
</HTML>
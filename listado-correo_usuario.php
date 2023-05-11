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
		<TITLE>Listado Correos del Usuario</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<h2 class="htabla">Listado Correo del Usuario</h2>
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
			<table class="service">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Opción</th>
				</tr>
			</thead>
			<?php
			require 'includes/conexion.php';
				$sql =mysqli_query($conexion, "SELECT co.ci_usuario, u.nombreu, u.apellidou, co.correo_usuario, dom.descripcion_dominio, co.iddominio
												FROM correo_usuario co
												INNER JOIN dominio dom ON co.iddominio = dom.iddominio
												INNER JOIN usuario u     ON co.ci_usuario = u.ci_usuario
												WHERE co.ci_usuario = '$ci_usuario'");
			$result_telefono=mysqli_num_rows($sql);
			mysqli_close($conexion);
			
			if($result_telefono>0){
				while ($mostrar = mysqli_fetch_array($sql)){
					
				$ci_usuario=$mostrar['ci_usuario'];
				$nombreu=$mostrar['nombreu'];
				$apellidou=$mostrar['apellidou'];
				$correo_usuario=$mostrar['correo_usuario'];
				$descripcion_dominio=$mostrar['descripcion_dominio'];
				$iddominio=$mostrar['iddominio'];
			?>
				<form method="POST" action="">
					<tr>
						<td><?php echo $ci_usuario?></td>
						<td><?php echo $nombreu . ' ' . $apellidou?></td>
						<input type="hidden" name="iddominio"  value="<?php echo $iddominio ?>" readonly>
						<td><?php echo $correo_usuario; echo $descripcion_dominio?></td>
						<td><a class="delete" href="eliminar-correo_usuario.php?ci=<?php echo $ci_usuario?>&correo=<?php echo $correo_usuario?>&dominio=<?php echo $iddominio?>">Eliminar</a></td>			
					</tr>
				</form>
			<?php
				}
			}
	}
			?>
			</table>
			<a href="listado_usuario.php" class="btn_cancel volver"> Volver</a> 
			<a class="btn_cancel" href="agregar-correo_usuario.php?ci=<?php echo $ci_usuario?>">Agregar</a>
		</section>
	</BODY>
</HTML>
<?php
session_start();

include 'includes/conexion.php';
	
	if( empty($_REQUEST['ci']) ){
		header('location:listado_cita.php');
	}
	
    $ci_cliente = $_REQUEST['ci'];
	
	$sql =mysqli_query($conexion, "SELECT  c.nombre, c.apellido, c.fecha_nacimiento, 
											g.descripcion, 
											e.estado, ciu.ciudad, m.municipio, d.detalle_direccion
									FROM cliente c
									INNER JOIN genero g      ON c.codgenero = g.codgenero
									INNER JOIN direccion d   ON c.ci_cliente = d.ci_cliente
													INNER JOIN estados e         ON d.id_estado = e.id_estado
													INNER JOIN ciudades ciu      ON d.id_ciudad = ciu.id_ciudad
													INNER JOIN municipios m      ON d.id_municipio = m.id_municipio
									WHERE c.ci_cliente = '$ci_cliente' ");
	
	
		while ($data = mysqli_fetch_array($sql)){

			
			$nombre = $data['nombre'];
			$apellido = $data['apellido'];
			$ncompleto = $nombre ." ". $apellido;
			
			$fecha_nacimiento = $data['fecha_nacimiento'];
			$genero = $data['descripcion'];
			
			$estado=$data['estado'];
			$ciudad=$data['ciudad'];
			$municipio=$data['municipio'];
			$detalle_direccion=$data['detalle_direccion'];
					
			if(!empty ($detalle_direccion)){
				$direccion = $estado. ", " .$ciudad.", ".$municipio.", ".$detalle_direccion.".";
			} else{
				$direccion = $estado. ", " .$ciudad.", ".$municipio.".";
			}
		}
	
?>

<html lang="en">
	<head>
		<title>Ver Cliente</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<h2>Ver Cliente</h2>
				<hr>
				
				<form action="" method="post">
				
					<label for ="ci_cliente">Cédula de Identidad</label>
					<input type="text" name="ci_cliente" class="ci"  value="<?php echo $ci_cliente; ?>" readonly>
					
					<label for ="nombre">Nombre Completo</label>
					<input type="text" name="nombre" value="<?php echo $ncompleto ?>"  readonly>
					
					<label for ="fecha_nacimiento">Fecha De Nacimiento </label>
					<input type="date"name="fecha_nacimiento" value="<?php echo $fecha_nacimiento?>"  readonly >

					<label for ="codgenero">Género </label>
					<input type="text" name="codgenero" value="<?php echo $genero ?>"  readonly>
					
					<label for ="direccion">Dirección</label>
					<input type="text" name="direccion" value="<?php echo $direccion ?>"  readonly>
				
					<a href="listado_cita.php" class="btn_cancel volver"> Volver</a>
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
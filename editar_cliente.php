<?php
session_start();

include 'includes/conexion.php';

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST ['ci_cliente']) || empty($_POST ['nombre']) || 
		 empty($_POST['apellido'])  || empty($_POST['fecha_nacimiento']) || empty($_POST['codgenero']) ||
		 empty($_POST['id_estado']) || empty($_POST['id_ciudad']) || empty($_POST['id_municipio']) 
		 
		 ){
			$alert='<p class="msg_error">Campos Obligatorios</p>';	
		
		}else{

			$ci_cliente = $_POST['ci_cliente'];
			$nombre = ucwords($_POST['nombre']);
			$apellido = ucwords($_POST['apellido']);
			$fecha_nacimiento = $_POST['fecha_nacimiento'];
			$codgenero = $_POST['codgenero'];
			$id_estado = $_POST['id_estado'];
			$id_ciudad = $_POST['id_ciudad'];
			$id_municipio = $_POST['id_municipio'];
			$detalle_direccion = $_POST['detalle_direccion'];
			
			
			$update= mysqli_query ($conexion, "UPDATE cliente c
												INNER JOIN direccion d ON c.ci_cliente = d.ci_cliente
												SET c.nombre='$nombre', c.apellido='$apellido', c.fecha_nacimiento='$fecha_nacimiento', c.codgenero='$codgenero',
												d.id_estado='$id_estado', d.id_ciudad='$id_ciudad', d.id_municipio='$id_municipio', d.detalle_direccion = '$detalle_direccion'
												WHERE c.ci_cliente= '$ci_cliente'");
			
			$verif_ci_user= mysqli_query ($conexion, "SELECT * FROM usuario WHERE ci_usuario = '$ci_cliente' ");
			
			if (mysqli_fetch_array($verif_ci_user) > 0){
				$updateuser= mysqli_query ($conexion, "UPDATE usuario u SET u.nombreu='$nombre', u.apellidou='$apellido', u.codgenero='$codgenero'
															WHERE u.ci_usuario = '$ci_cliente'");
			}
			
			if($update){
				
				$alert = '<p class="msg_save">Cliente actualizado.</p>';
				header("refresh:1;url=listado_cliente.php");	

			}else {
				$alert = '<p class="msg_">Error al actualizar cliente.</p>';
				header("refresh:2;url=listado_cliente.php");
			}	
			
		}			
	}
	
	if(empty($_REQUEST['ci']) ){
		header('location:listado_cliente.php');
	}
	
    $ci_cliente = $_REQUEST['ci'];
	
	$sql =mysqli_query($conexion, "SELECT c.nombre, c.apellido, c.fecha_nacimiento, g.descripcion, c.codgenero,
											d.id_estado, e.estado, 
											d.id_ciudad, ciu.ciudad, 
											d.id_municipio, m.municipio, d.detalle_direccion
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
			$fecha_nacimiento = $data['fecha_nacimiento'];
			$descripcion = $data['descripcion'];
			$codgenero = $data['codgenero'];
			
			$id_estado=$data['id_estado'];
			$estado=$data['estado'];
			$id_ciudad=$data['id_ciudad'];
			$ciudad=$data['ciudad'];
			$id_municipio=$data['id_municipio'];
			$municipio=$data['municipio'];
			$detalle_direccion=$data['detalle_direccion'];
		}
	
?>

<html lang="en">
	<head>
		<title>Actualizar Cliente</title>
		<meta charset=utf-8"/>
		<?php include "includes/scripts.php";?>
	<script type="text/javascript">
		
	$(document).ready(function(){
		$('#id_estado').on('change',function(){
			var estAdo = $(this).val();
			if(estAdo){
				$.ajax({
					type:'POST',
					url:'includes/ajaxData.php',
					data:'id_estado='+estAdo,
					success:function(html){
						$('#id_ciudad').html(html);
						$('#id_municipio').html('<option value="">Seleccione Ciudad</option>'); 
					}
				}); 
			}
		});
		
		$('#id_ciudad').on('change',function(){
					 //alert($('select[id=id_ciudad]').val());
			var ciuDad = $('#id_estado').val();
					//alert(ciuDad);
			if(ciuDad){
					//document.write(ciuDad) 
				$.ajax({
					type:'POST',
					url:'includes/ajaxData.php',
					data:'id_ciudad='+ciuDad,
					success:function(html){
						$('#id_municipio').html(html);
						//alert(ciuDad);
					}
				}); 
			}
		});
	});
		
		
		
		function Confirmar() {
			var mensaje = confirm("¿Desea continuar?");
			if (mensaje) {
				return true;
			}else {
				return false;
			}
		}
	</script>
	</head>
	
	<body>
		<?php include "includes/headeruser.php";?>	
		<section class="container">
		
			<div class="register">
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				
				<form action="" method="post" onsubmit="return Confirmar()">
					<h2>Actualizar Cliente</h2>
					<hr>
				
					<label for ="ci_cliente">Cédula de Identidad</label>
					<input type="text" name="ci_cliente"  class="textcenter" value="<?php echo $ci_cliente ?>" readonly>
					
					<label for ="nombre">Nombre</label>
					<input type="text" name="nombre" value="<?php echo $nombre ?>">
					
					<label for ="apellido">Apellido</label>
					<input type="text" name="apellido" value="<?php echo $apellido ?>">
					
					<label for ="fecha_nacimiento">Fecha De Nacimiento </label>
					<input type="date" min="1920-12-31" max="<?php echo date("Y-m-d");?>" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento?>" required >

					<label for ="codgenero">Género </label>
					
				<?php
					$query_genero=mysqli_query($conexion, "SELECT * FROM genero");
					$result_genero=mysqli_num_rows($query_genero);
				?>
					
					<select name="codgenero" id="codgenero">
					<option value="<?php echo $codgenero ?>" selected><?php echo $descripcion?></option>
				<?php
					if($result_genero>0){
					while($genero=mysqli_fetch_array($query_genero)){
				?>	
					<option value="<?php echo $genero["codgenero"];?>"><?php echo $genero["descripcion"];?></option>
				<?php				
					}
				}
				?>
					</select>
								
					<label for ="coddireccion">Dirección</label>
					<label for ="id_estado" class="textleft">Estado</label>
					
				<?php
					$query_direccion=mysqli_query($conexion, "SELECT * FROM estados");
					$result_direccion=mysqli_num_rows($query_direccion);
				?>
					
					<select name="id_estado" id="id_estado">
					<option value="<?php echo $id_estado ?>" selected><?php echo $estado?></option>
				<?php
					if($result_direccion>0){
					while($estado=mysqli_fetch_array($query_direccion)){
				?>	
					<option value="<?php echo $estado["id_estado"];?>"><?php echo $estado["estado"];?></option>
				<?php				
					}
				}
				?>
					</select>
					
					<label for ="id_ciudad" class="textleft">Ciudad </label>
					<select name="id_ciudad" id="id_ciudad">
						<option value="<?php echo $id_ciudad ?>"><?php echo $ciudad ?></option>
					</select>
					
					<label for ="id_municipio" class="textleft">Municipio</label>
					<select name="id_municipio" id="id_municipio">
						<option value="<?php echo $id_municipio ?>"><?php echo $municipio ?></option>
					</select>
					
					<label for ="detalle_direccion">Dirección Detallada</label>
					<input type="text" name="detalle_direccion" value="<?php echo $detalle_direccion ?>">
					
					<a href="listado_cliente.php" class="btn_ok"> Volver</a>
					<input type="submit" class="btn_cancel" value="Aceptar" >
				
				</form>
			
			</div>	
		
		</section>
	
	</body>
</html>
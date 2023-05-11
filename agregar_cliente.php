<?php
session_start();

	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';
$alert='';
	
	if(!empty($_POST)){
		
		if(empty($_POST['ci_cliente']) || empty($_POST['nombre']) || empty($_POST ['apellido']) || 
		empty($_POST['fecha_nacimiento']) || empty($_POST['codgenero']) || 
		empty($_POST['idarea']) || empty($_POST['telefono_cliente'])||
		empty($_POST['correo_cliente']) || empty($_POST['iddominio']) ||
		empty($_POST['id_estado']) || empty($_POST['id_ciudad']) || empty($_POST['id_municipio'])
		
		){

			$alert='<p class="msg_error">Campos Obligatorios</p>';
			
		}else{
			$ci_cliente = $_POST['ci_cliente'];
			$nombre = ucwords($_POST['nombre']);
			$apellido = ucwords($_POST['apellido']);
			$fecha_nacimiento = $_POST['fecha_nacimiento'];
			$codgenero = $_POST['codgenero'];
			$idarea = $_POST['idarea'];
			$telefono_cliente = $_POST['telefono_cliente'];
			$correo_cliente = $_POST['correo_cliente'];
			$iddominio = $_POST['iddominio'];
			$id_estado = $_POST['id_estado'];
			$id_ciudad = $_POST['id_ciudad'];
			$id_municipio = $_POST['id_municipio'];
			$detalle_direccion = $_POST['detalle_direccion'];

			if(preg_match_all("/^[V|E]-[0-9]{5,9}$/", $ci_cliente)){

				if(preg_match_all ("/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)$/", $correo_cliente)){

					$verif_ci= mysqli_query ($conexion, "SELECT ci_cliente FROM cliente WHERE ci_cliente = '$ci_cliente'");
					$verif_ci_user= mysqli_query ($conexion, "SELECT * FROM usuario 
																WHERE (ci_usuario = '$ci_cliente' AND nombreu != '$nombre' ) OR
																		(ci_usuario = '$ci_cliente' AND apellidou != '$apellido') OR
																		(ci_usuario = '$ci_cliente' AND codgenero != '$codgenero') 
																");
					$verif_telefono= mysqli_query ($conexion, "SELECT * FROM telefono_cliente WHERE  idarea = '$idarea' AND telefono_cliente = '$telefono_cliente'");
					$verif_telf_user= mysqli_query ($conexion, "SELECT * FROM telefono_usuario 
																WHERE ci_usuario != '$ci_cliente' AND idarea = '$idarea' AND telefono_usuario = '$telefono_cliente' ");
					
					$verif_correo= mysqli_query ($conexion, "SELECT * FROM correo_cliente WHERE correo_cliente = '$correo_cliente' AND iddominio = '$iddominio'");
					$verif_correo_user= mysqli_query ($conexion, "SELECT * FROM correo_usuario 
																WHERE ci_usuario != '$ci_cliente' AND correo_usuario = '$correo_cliente' AND iddominio = '$iddominio'");

					if(mysqli_fetch_array($verif_ci) > 0){
						$alert = '<p class="msg_error">La cédula ya existe.</p>';
						
					}elseif(mysqli_fetch_array($verif_ci_user) > 0){
						$alert = '<p class="msg_error">La cédula pertenece a un usuario, por favor ingrese los datos correspondientes.</br> (Nombre, Apellido  y Género)</p>';
						
					}elseif(mysqli_fetch_array($verif_telefono) > 0){
						$alert = '<p class="msg_error">El teléfono ya existe.</p>';
						
					}elseif(mysqli_fetch_array($verif_telf_user) > 0){
						$alert = '<p class="msg_error">El telefono le pertenece a un usuario.</p>';
						
					}elseif(mysqli_fetch_array($verif_correo) > 0){
						$alert = '<p class="msg_error">El correo ya existe.</p>';
						
					}elseif(mysqli_fetch_array($verif_correo_user) > 0){
						$alert = '<p class="msg_error">El correo le pertenece a un usuario.</p>';
						
					}else {
						$insert= mysqli_query ($conexion, "INSERT INTO cliente ( ci_cliente, nombre, apellido, fecha_nacimiento, codgenero) 
															VALUES ('$ci_cliente', '$nombre','$apellido','$fecha_nacimiento',  '$codgenero')");
						if($insert ==true){
							$insert_telf= mysqli_query ($conexion, "INSERT INTO telefono_cliente ( ci_cliente, idarea, telefono_cliente) 
															VALUES ('$ci_cliente', '$idarea','$telefono_cliente')");

							if($insert_telf ==false){
								$alert = '<p class="msg_error">Error al registrar telefono.</p>';
								
							}
						
							$insert_correo= mysqli_query ($conexion, "INSERT INTO correo_cliente ( ci_cliente, correo_cliente, iddominio) 
															VALUES ('$ci_cliente','$correo_cliente', '$iddominio')");

							if($insert_correo ==false){
								$alert = '<p class="msg_error">Error al registrar correo.</p>';
								
							}
							
							$insert_direccion= mysqli_query ($conexion, "INSERT INTO direccion ( ci_cliente, id_estado, id_ciudad, id_municipio, detalle_direccion) 
															VALUES ('$ci_cliente','$id_estado', '$id_ciudad', '$id_municipio', '$detalle_direccion')");

							if($insert_direccion ==true){
								$alert = '<p class="msg_save">Cliente registrado correctamente.</p>';
								header("refresh:2;url=listado_cliente.php");		
								
							}else{
								$alert = '<p class="msg_error">Error al registrar correo.</p>';
							}
							
						}else {
							$alert = '<p class="msg_error">Error al registrar cliente.</p>';
						}
					}
				} else {
					$alert = '<p class="msg_error">El correo tiene valores incorrectos.</p>';
					}
			}else {
					$alert = '<p class="msg_error">La cédula tiene valores incorrectos.</p>';
				}		
		}
	}
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Registro Nuevo Cliente</title>
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
</script>
		
	</head>
	<body>	
		<?php include "includes/headeruser.php";?>

		<section class="container">
			<div class="register">
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			
			<h2>Registrar Cliente</h2>
			<hr>
				<form action="" method="POST">
				<p class="mas">Campo Obligatorio(*)</p>
		
					<label for ="ci_cliente">Cédula de Identidad <b class="mas">*</b></label>
					<input type="text" name="ci_cliente" id="ci_cliente" placeholder="V ó E -xxxxxxx" pattern="[V|E]-[0-9]{5,9}"  required>
					
					<label for ="nombre">Nombre <b class="mas">*</b></label>
					<input type="text" name="nombre" id="nombre" placeholder="Nombre" required >
					
					<label for ="apellido">Apellido <b class="mas">*</b></label>
					<input type="text" name="apellido" id="apellido" placeholder="Apellido" required >
					
					<label for ="fecha_nacimiento">Fecha de Nacimiento <b class="mas">*</b></label>
					<input type="date" min="1920-12-31" max="<?php echo date("Y-m-d");?>" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de Nacimiento" required >

					<label for ="codgenero">Género <b class="mas">*</b></label>
					
				<?php
					$query_genero=mysqli_query($conexion, "SELECT * FROM genero");
					$result_genero=mysqli_num_rows($query_genero);
				?>
					
					<select name="codgenero" id="codgenero" required>
					<option value="" selected>Seleccione</option>
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
					
					<label for ="idarea">Teléfono <b class="mas">*</b></label>
					
				<?php
					$query_area=mysqli_query($conexion, "SELECT * FROM area");
					$result_area=mysqli_num_rows($query_area);
				?>
					
					<select name="idarea" id="idarea" class="wd30" required>
					<option value="" selected>Área</option>
				<?php
					if($result_area>0){
					while($area=mysqli_fetch_array($query_area)){
				?>	
					<option value="<?php echo $area["idarea"];?>"><?php echo $area["descripcion_area"];?></option>
				<?php				
					}
				}
				?>
					</select>
					<input type="tel" name="telefono_cliente" id="telefono_cliente" class="wd60" pattern="[0-9]{7}" placeholder="xxxxxxx" required>

					
					<label for ="correo_cliente">Correo <b class="mas">*</b></label>
					<input type="text" name="correo_cliente" id="correo_cliente" placeholder="Correo" class="wd50" pattern="([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*)" required>
				<?php
					$query_dominio=mysqli_query($conexion, "SELECT * FROM dominio");
					$result_dominio=mysqli_num_rows($query_dominio);
				?>
					
					<select name="iddominio" id="iddominio" class="wd40" required>
					<option value="" selected>Dominio</option>
				<?php
					if($result_dominio>0){
					while($dominio=mysqli_fetch_array($query_dominio)){
				?>	
					<option value="<?php echo $dominio["iddominio"];?>"><?php echo $dominio["descripcion_dominio"];?></option>
				<?php				
					}
				}
				?>
					</select>					

					<label for ="coddireccion" class="textcenter">Dirección </label>
					<label for ="id_estado" class="textleft">Estado <b class="mas">*</b></label>
				<?php
					$query_estado=mysqli_query($conexion, "SELECT * FROM estados
															ORDER BY estado ASC");
					$result_estado=mysqli_num_rows($query_estado);
				?>
					<select name="id_estado" id="id_estado" required>
					<option value=""selected>-Seleccione-</option>
				<?php
				if($result_estado>0){
					while($estado=mysqli_fetch_array($query_estado)){
				?>	
					<option value="<?php echo $estado["id_estado"];?>"><?php echo $estado["estado"];?></option>
				<?php				
					}
				}
				?>
					</select>
					
					<label for ="id_ciudad" class="textleft">Ciudad <b class="mas">*</b></label>
					<select name="id_ciudad" id="id_ciudad">
						<option value="">Selecccione Estado</option>
					</select>
					
					<label for ="id_municipio" class="textleft">Municipio <b class="mas">*</b></label>
					<select name="id_municipio" id="id_municipio">
						<option value="">Selecccione Ciudad</option>
					</select>
					
					<label for ="detalle_direccion" class="textleft">Dirección Detallada </label>
					<input type="text" name="detalle_direccion" id="detalle_direccion" placeholder="Dirección Detallada">
					
					
					
					<input type="submit" class="btn_save" value="Aceptar" >
				</form>
			</div>
		</section>

	</body>

</html>
<?php
	session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
require 'includes/conexion.php';

	if(!empty($_POST)){
		$ci_usuario = $_POST['ci_usuario'];
		$correo_usuario = $_POST['correo_usuario'];
		$iddominio = $_POST['iddominio'];
	 
		$query_delete = mysqli_query($conexion,"DELETE FROM correo_usuario WHERE ci_usuario = '$ci_usuario' AND correo_usuario = '$correo_usuario' AND iddominio = '$iddominio' ");
	 
		if($query_delete){
			header("Location:listado-correo_usuario.php?ci=$ci_usuario");	
		}else{
			$alert='<p class="msg_error">Error al eliminar telefono del cliente</p>';	
			header("refresh:1;url=listado-correo_usuario.php?ci=$ci_usuario");	
		}
	}
	
	if(empty($_REQUEST['ci']) )
    {
        header('location:listado_cliente.php');
    }else{
        $ci_usuario = $_REQUEST['ci'];
        $correo_usuario = $_REQUEST['correo'];
        $iddominio = $_REQUEST['dominio'];
		
		$sql =mysqli_query($conexion, "SELECT co.ci_usuario, co.correo_usuario, d.descripcion_dominio, co.iddominio, nombreu, u.apellidou
									FROM correo_usuario co
									INNER JOIN dominio d   ON co.iddominio = d.iddominio
									INNER JOIN usuario u   ON co.ci_usuario = u.ci_usuario
									WHERE co.ci_usuario = '$ci_usuario'AND co.correo_usuario = '$correo_usuario' AND co.iddominio = '$iddominio' ");
			
			while ($mostrar = mysqli_fetch_array($sql)){		
			$nombreu = $mostrar['nombreu'];
			$apellidou = $mostrar['apellidou'];
			$descripcion_dominio=$mostrar['descripcion_dominio'];
			}
	}
    ?>

<HTML>
	<HEAD>
		<TITLE>Eliminar Correo del Usuario</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<div class="data_delete">
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				<h3> ¿Desea eliminar el siguiente correo?</h3>
					</br>
					
					<p>Nombre del usuario: <span><?php echo $nombreu . ' ' . $apellidou;?></span></p>
					<p>Correo a eliminar: <span><?php echo $correo_usuario; echo $descripcion_dominio;?></span></p>
					
					

					<form method="POST" action="">
						<input type="hidden" name="ci_usuario" value="<?php echo $ci_usuario; ?>">
						<input type="hidden" name="iddominio" value="<?php echo $iddominio; ?>">
						<input type="hidden" name="correo_usuario" value="<?php echo $correo_usuario; ?>">
						
						<a href="listado-correo_usuario.php?ci=<?php echo $ci_usuario?>" class="btn_cancel"> Volver </a>
						<button type="submit" class="btn_ok"> Eliminar</button>
						
						</tr>
					</form>
			</div>
		</section>
	</BODY>
</HTML>
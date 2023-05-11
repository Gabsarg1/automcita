<?php
	session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}
require 'includes/conexion.php';

	if(!empty($_POST)){
		$ci_usuario = $_POST['ci_usuario'];
		$idarea = $_POST['idarea'];
		$telefono_usuario = $_POST['telefono_usuario'];
	 
		$query_delete = mysqli_query($conexion,"DELETE FROM telefono_usuario WHERE ci_usuario = '$ci_usuario' AND idarea = '$idarea' AND telefono_usuario = '$telefono_usuario' ");
	 
		if($query_delete){
			header("Location:listado-telefono_usuario.php?ci=$ci_usuario");	
		}else{
			$alert='<p class="msg_error">Error al eliminar telefono del usuario</p>';	
			header("refresh:1;url=listado-telefono_usuario.php?ci=$ci_usuario");	
		}
	}
	
	if(empty($_REQUEST['ci']) )
    {
        header('location:listado_usuario.php');
    }else{
        $ci_usuario = $_REQUEST['ci'];
        $idarea = $_REQUEST['area'];
        $telefono_usuario = $_REQUEST['telefono'];
		
		$sql =mysqli_query($conexion, "SELECT  telf.ci_usuario, telf.idarea, a.descripcion_area, telf.telefono_usuario, u.nombreu, u.apellidou
									FROM telefono_usuario telf
									INNER JOIN area a        ON telf.idarea = a.idarea
									INNER JOIN usuario u        ON telf.ci_usuario = u.ci_usuario
									WHERE telf.ci_usuario = '$ci_usuario' AND telf.idarea = '$idarea' AND telf.telefono_usuario = '$telefono_usuario' ");
			
			while ($mostrar = mysqli_fetch_array($sql)){		
			$nombreu = $mostrar['nombreu'];
			$apellidou = $mostrar['apellidou'];
			$descripcion_area=$mostrar['descripcion_area'];
			}
	}
    ?>

<HTML>
	<HEAD>
		<TITLE>Listado Teléfonos del usuario</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
		<?php include "includes/scripts.php";?>
	</HEAD>
	
	<BODY>
	<?php include "includes/headeruser.php";?>
		<section class="container" >
			<div class="data_delete">
				<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
				<h3> ¿Desea eliminar el siguiente número de teléfono?</h3>
					</br>
					
					<p>Nombre del usuario: <span><?php echo $nombreu. ' ' . $apellidou;?></span></p>
					<p>Número de teléfono a eliminar: <span><?php echo $descripcion_area; echo $telefono_usuario;?></span></p>
					
					

					<form method="POST" action="">
						<input type="hidden" name="ci_usuario" value="<?php echo $ci_usuario; ?>">
						<input type="hidden" name="idarea" value="<?php echo $idarea; ?>">
						<input type="hidden" name="telefono_usuario" value="<?php echo $telefono_usuario; ?>">
						
						<a href="listado-telefono_usuario.php?ci=<?php echo $ci_usuario?>" class="btn_cancel"> Volver </a>
						<button type="submit" class="btn_ok"> Eliminar</button>
						
						</tr>
					</form>
			</div>
		</section>
	</BODY>
</HTML>
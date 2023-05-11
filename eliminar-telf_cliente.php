<?php
	session_start();

require 'includes/conexion.php';

	if(!empty($_POST)){
		$ci_cliente = $_POST['ci_cliente'];
		$idarea = $_POST['idarea'];
		$telefono_cliente = $_POST['telefono_cliente'];
	 
		$query_delete = mysqli_query($conexion,"DELETE FROM telefono_cliente WHERE ci_cliente = '$ci_cliente' AND idarea = '$idarea' AND telefono_cliente = '$telefono_cliente' ");
	 
		if($query_delete){
			header("Location:listado-telefono_cliente.php?ci=$ci_cliente");	
		}else{
			$alert='<p class="msg_error">Error al eliminar telefono del cliente</p>';	
			header("refresh:1;url=listado-telefono_cliente.php?ci=$ci_cliente");	
		}
	}
	
	if(empty($_REQUEST['ci']) )
    {
        header('location:listado_cliente.php');
    }else{

        $ci_cliente = $_REQUEST['ci'];
        $idarea = $_REQUEST['area'];
        $telefono_cliente = $_REQUEST['telefono'];
		
		$sql =mysqli_query($conexion, "SELECT telf.ci_cliente, telf.idarea, a.descripcion_area, telf.telefono_cliente, c.nombre, c.apellido
									FROM telefono_cliente telf
									INNER JOIN area a        ON telf.idarea = a.idarea
									INNER JOIN cliente c        ON telf.ci_cliente = c.ci_cliente
									WHERE telf.ci_cliente = '$ci_cliente' AND telf.idarea = '$idarea' AND telf.telefono_cliente = '$telefono_cliente' ");
			
			while ($mostrar = mysqli_fetch_array($sql)){	
			$nombre = $mostrar['nombre'];
			$apellido = $mostrar['apellido'];
			$descripcion_area=$mostrar['descripcion_area'];
			}
	}
    ?>

<HTML>
	<HEAD>
		<TITLE>Listado Teléfonos del Cliente</TITLE>
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
					
					<p>Nombre del cliente: <span><?php echo $nombre. ' ' .$apellido;?></span></p>
					<p>Número de teléfono a eliminar: <span><?php echo $descripcion_area; echo $telefono_cliente;?></span></p>
					
					

					<form method="POST" action="">

						<input type="hidden" name="ci_cliente" value="<?php echo $ci_cliente; ?>">
						<input type="hidden" name="idarea" value="<?php echo $idarea; ?>">
						<input type="hidden" name="telefono_cliente" value="<?php echo $telefono_cliente; ?>">
						
						<a href="listado-telefono_cliente.php?ci=<?php echo $ci_cliente?>" class="btn_cancel"> Volver </a>
						<button type="submit" class="btn_ok"> Eliminar</button>
						
						</tr>
					</form>
			</div>
		</section>
	</BODY>
</HTML>
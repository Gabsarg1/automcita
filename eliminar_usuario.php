<?php
session_start();
if ($_SESSION['idrol'] ==2){
	header("location: index.php");
}

    include 'includes/conexion.php';

if(!empty($_POST))
 {
	 $ci_usuario = $_POST['ci_usuario'];
	 
	 $query_delete = mysqli_query($conexion,"UPDATE usuario SET estatus = 0 WHERE ci_usuario = '$ci_usuario' ");
	 
     if($query_delete){
         header("location: listado_usuario.php");
     }else{
         echo "Error al eliminar usuario";
		 header("refresh:2;url=listado_usuario.php");
     }
 }


    if( empty($_REQUEST['ci']) )
    {
        header('location:listado_cliente.php');
    }else{

        $ci_usuario = $_REQUEST['ci'];

        $query = mysqli_query($conexion,"SELECT * FROM usuario 
										WHERE ci_usuario= '$ci_usuario' ");

        $result = mysqli_num_rows($query);

        if ($result > 0){
            while ($mostrar = mysqli_fetch_array($query)) {
				$nombreu=$mostrar['nombreu'];
				$apellidou=$mostrar['apellidou'];
				$usuario=$mostrar['usuario'];
			}	
    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
        <title>Eliminar usuario</title>
    </head>
    <body>
        <?php include "includes/headeruser.php"; ?>
        <section class="container">
			<div class="data_delete">
				<h3> ¿Desea eliminar el siguiente usuario?</h3>
				</br>
				
				
				<p>Nombre del usuario: <span><?php echo $nombreu . ' ' . $apellidou;?></span></p>
				<p>Usuario: <span><?php echo $usuario;?></span></p>
				
				<form method="post" action="">
					<input type="hidden" name="ci_usuario" value="<?php echo $ci_usuario; ?>">
					
					<a href="listado_usuario.php" class="btn_cancel"> Cancelar</a>
					<button type="submit" class="btn_ok"> Eliminar</button>
				</form>
	<?php
        }else{
            header("location: listado_usuario.php");
        }
    }
	?>
			</div>
        </section>
    </body>
</html>
<?php
session_start();

    include 'includes/conexion.php';

if(!empty($_POST))
 {

	 $ci_cliente = $_POST['ci_cliente'];
	 
	 $query_delete = mysqli_query($conexion,"UPDATE cliente SET estatus = 0 WHERE ci_cliente = '$ci_cliente' ");
	 
     if($query_delete){
         header("location: listado_cliente.php");
     }else{
         echo "Error al eliminar cliente";
		 header("refresh:2;url=listado_cliente.php");
     }
 }


    if( empty($_REQUEST['ci']) )
    {
        header('location:listado_cliente.php');
    }else{
        $ci_cliente = $_REQUEST['ci'];

        $query = mysqli_query($conexion,"SELECT * FROM cliente 
										WHERE ci_cliente= '$ci_cliente' ");

        $result = mysqli_num_rows($query);

        if ($result > 0){
            while ($mostrar = mysqli_fetch_array($query)) {
				
    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
        <title>Eliminar Cliente</title>
    </head>
    <body>
        <?php include "includes/headeruser.php"; ?>
        <section class="container">
			<div class="data_delete">
				<h3> ¿Desea eliminar el siguiente cliente?</h3>
				</br>
				
				
				<p>Nombre del cliente: <span><?php echo $mostrar['nombre']. ' '.$mostrar['apellido'];?></span></p>
				
				<form method="post" action="">
					<input type="hidden" name="ci_cliente" value="<?php echo $ci_cliente; ?>">
					
					<a href="listado_cliente.php" class="btn_cancel"> Cancelar</a>
					<button type="submit" class="btn_ok"> Eliminar</button>
				</form>
				<?php
				}
        }else{
            header("location: listado_cliente.php");
        }
    }
	
	?>
			</div>
         </section>
    </body>
</html>
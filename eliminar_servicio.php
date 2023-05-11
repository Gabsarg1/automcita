
<?php
session_start();
if ($_SESSION['idrol'] ==2){
	header("location: index.php");
}

    include 'includes/conexion.php';

if(!empty($_POST))
 {
	 $idservicio = $_POST['idservicio'];
	 
	 $query_delete = mysqli_query($conexion,"DELETE FROM servicio  WHERE idservicio = $idservicio ");
	 
     if($query_delete){
         header("location: listado_servicio.php");
     }else{
         echo "Error al eliminar servicio";
     }
 }


    if(empty($_REQUEST['id']))
    {
        header("location: listado_servicio.php");
        mysqli_close($conexion);
    }else{

        $idservicio = $_REQUEST['id'];

        $query = mysqli_query($conexion,"SELECT * FROM servicio
										WHERE  idservicio= $idservicio ");

        $result = mysqli_num_rows($query);

        if ($result > 0){
            while ($mostrar = mysqli_fetch_array($query)) {

    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
        <title>Eliminar Servicio</title>
    </head>
    <body>
        <?php include "includes/headeruser.php"; ?>
        <section class="container">
			<div class="data_delete">
				<h3> ¿Desea eliminar el siguiente servicio?</h3>
				</br>
				<p>Servicio: <span><?php echo $mostrar['descripcion_servicio']; ?></span></p>
				
				<form method="post" action="">
					<input type="hidden" name="idservicio" value="<?php echo $idservicio; ?>">
					
					<a href="listado_servicio.php" class="btn_cancel"> Cancelar</a>
					<button type="submit" class="btn_ok"> Eliminar</button>
				</form>
				<?php
				}
        }else{
            header("location: listado_servicio.php");
        }
    }
	
	?>
			</div>
         </section>

    </body>
    </html>
<?php 

	include 'conexion.php';

if(isset($_POST["servicio"]) && !empty($_POST["servicio"])){
	$idservicio = $_POST['servicio'];

	$query=mysqli_query($conexion, "SELECT t.ci_cosmetologa, t.idservicio, u.nombreu, u.apellidou
											FROM trabajo t 
											INNER JOIN usuario u  ON t.ci_cosmetologa = u.ci_usuario
											WHERE t.idservicio = '$idservicio'");
	$result=mysqli_num_rows($query);
			
	if($result>0){
		echo "<option value=''>Seleccione</option>";
		while ($cosmetologa=mysqli_fetch_assoc($query)) {
			echo"<option value='".$cosmetologa['ci_cosmetologa']."'>".$cosmetologa['nombreu']." ".$cosmetologa['apellidou']."</option>";
		}
	}
	
}

if(isset($_POST["id_estado"]) && !empty($_POST["id_estado"])){

	$estado = $_POST["id_estado"];

    $query =  mysqli_query($conexion,"SELECT * FROM ciudades 
										WHERE id_estado = '$estado' ");
    $result_c = mysqli_num_rows($query);

    if($result_c > 0){
        echo "<option value=''>Seleccione</option>";
        while($ciudad = mysqli_fetch_assoc($query)){ 
            echo "<option value='".$ciudad['id_ciudad']."'>".$ciudad['ciudad']."</option>";
        }
    }
}

if(isset($_POST["id_ciudad"]) && !empty($_POST["id_ciudad"])){
	
	$ciudad = $_POST["id_ciudad"];
	
    $query = mysqli_query($conexion,"SELECT * FROM municipios 
									WHERE id_estado = '$ciudad' ");
    $result_m = mysqli_num_rows($query);
    
    if($result_m > 0){
        echo "<option value=''>Selecccione municipio</option>";
        while($municipio = mysqli_fetch_assoc($query)){ 
            echo "<option value='".$municipio['id_municipio']."'>".$municipio['municipio']."</option>";
        }
    }
}

?>
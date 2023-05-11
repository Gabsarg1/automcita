<?php
session_start();
$alert='';	
	
	if(!empty($_POST)){
		if( empty($_POST['usuario']) || empty($_POST['clave'])){
			$alert='<p class="msg_error">Campos Obligatorios</p>';
				
		}else{
		$usuario=strtolower($_POST['usuario']);
		$clave=strtolower($_POST['clave']);
			
		include 'includes/conexion.php';

		$query= mysqli_query ($conexion, "SELECT u.ci_usuario, u.nombreu, u.apellidou, u.usuario, u.idrol, r.nombrerol 
											FROM usuario u
											INNER JOIN rol r ON u.idrol = r.idrol
											WHERE  u.usuario = '$usuario' AND u.clave = '$clave' AND u.estatus =1");
		mysqli_close($conexion);
		
		$result = mysqli_num_rows($query);

			if($result>0){
				$data = mysqli_fetch_array ($query);
				$_SESSION['active']=true;
				$_SESSION['ci_usuario']=$data ['ci_usuario'];
				$_SESSION['nombreu']=$data ['nombreu'];
				$_SESSION['apellidou']=$data ['apellidou'];
				$_SESSION['usuario']=$data ['usuario'];
				$_SESSION['idrol']=$data ['idrol'];
				$_SESSION['nombrerol']=$data ['nombrerol'];
				
				
					header ("Location: index.php");
			}
			else{
				$alert = '<p class="msg_error">El usuario es incorrecto.</p>';
				session_destroy();
			}
		}
	}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Usuario</title>
    <?php include "includes/scripts.php";?>
</head>

<body>
	
    <section class="container">
        <div class="register">
        <div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
            <form action="" method="post">
                <h2 class="entrada">Iniciar Sesión</h2>
                <input class="entradainp" type="text" name="usuario" placeholder="Usuario">
                <input class="entradainp" type="password" name="clave" placeholder="Contraseña">
                
                <input type="submit" class="btn_save" value="Aceptar">
            </form>
        </div>
    </section>
</body>
</html>
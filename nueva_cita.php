<?php
session_start();
	if ($_SESSION['idrol'] ==2){
		header("location: index.php");
	}

include 'includes/conexion.php';

if(!empty($_POST)){
	if($ci_cliente == $ci_cosmetologa){
		$alert = '<p class="msg_error"> El cliente y el cosmetólogo son iguales.</p>';				
	}
}
?>

<html lang="en">
	<head>
		<meta charset=utf-8"/>
		<title>Registro Nuevo Usuario</title>
		<?php include "includes/scripts.php";?>
		
	<script type="text/javascript">
	$(document).ready(function(){
			
		$('#idservicio').on('change',function(){	 
			var serVicio = $(this).val();
					
			if(serVicio){	
				$.ajax({
					type:'POST',
					url:'includes/ajaxData.php',
					data:'servicio='+serVicio,
					success:function(html){
						$('#ci_cosmetologa').html(html);
					}
				}); 
			}
		});
		
	$.datepicker.regional['es'] = {
		prevText: '< Anterior || ',
		nextText: '  Próximo >',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		weekHeader: 'Sm',
		dateFormat: 'yy/mm/dd',
		minDate: 0, // Fecha a elegir
		firstDay: 1 // Comienza la sem (Lunes)
	};
 
 $.datepicker.setDefaults($.datepicker.regional['es']);

	$('#fecha').datepicker({
		beforeShowDay: function(date) {
			var day = date.getDay();
			return [(day != 0)];
		}
	});
	
	$('#fecha').datepicker("setDate", new Date());
	
	$('#verif').submit(function(){

        var cliente = $('#ci_cliente').val();
        var cosmetologa = $('#ci_cosmetologa').val();

        if(cliente == cosmetologa){
            $('.alertacambio').html('<p style="color:red">El cliente y el cosmetólogo son iguales.</p>');
            $('.alertacambio').slideDown();
			
            return false;
        }else {
			 return true;
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
			
				<h2>Nueva Cita</h2>
				<hr>
				
			<form action="nueva_cita2.php" method="POST" name="verif" id="verif">
			<div class="alertacambio" style="display: none;"></div>
				<label for ="fecha">Fecha</label>
					<input type="text" id="fecha" name="fecha" required readonly><br/><br/>
			
				<label for ="ci_cliente">Cliente</label>
				<?php
					$query_cliente=mysqli_query($conexion, "SELECT * FROM cliente WHERE estatus = 1");
					$result_cliente=mysqli_num_rows($query_cliente);
				?>
					
					<select name="ci_cliente" id="ci_cliente" required>
					<option value=""selected>Seleccione</option>
				<?php
				
					if($result_cliente>0){
					while($cliente=mysqli_fetch_array($query_cliente)){
						$nombre = $cliente["nombre"];
						$apellido = $cliente["apellido"];
				?>	
					<option value="<?php echo $cliente["ci_cliente"];?>"><?php echo $nombre. ' ' . $apellido?></option>
				<?php				
					}
					
				}
				?>
					</select>
				<br/><br/>
						
				<label for ="idservicio">Servicio</label>
				<?php
					$query_servicio=mysqli_query($conexion, "SELECT *  FROM servicio");
					$result_servicio=mysqli_num_rows($query_servicio);
				?>
					
					<select name="idservicio" id="idservicio" required>
					<option value=""selected>Seleccione</option>
				<?php
					if($result_servicio>0){
					while($servicio=mysqli_fetch_array($query_servicio)){
				?>	
					<option value="<?php echo $servicio["idservicio"];?>"><?php echo $servicio["descripcion_servicio"];?></option>
				<?php				
					}
					
				}
				?>
				</select>
				<br/><br/>
				
				<label for ="ci_cosmetologa">Cosmetólogo </label>
					<select name="ci_cosmetologa" id="ci_cosmetologa" required>
						<option value="">Selecccione Servicio</option>
					</select>
					
				<a href="listado_cita.php" class="btn_ok"> Volver</a>
				<input type="submit" class="btn_cancel" value="Elegir Hora" >


			</form>
			</div>
		</section>

	</body>

</html>
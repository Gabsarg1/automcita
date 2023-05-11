<?php
require('fpdf/fpdf.php');
date_default_timezone_set('America/Caracas');


class PDF extends FPDF{

	public function Header(){
		$this->SetFont('Times','B',10);
		$this->SetTextColor(68,78,75);
		$this->Cell(0,10,utf8_decode('Centro Estético Diva´s Studio'),0,0,'C');
		$this->Ln(6);
		$this->Cell(0,10,utf8_decode('C.C Galería las Américas piso 2 local 88.'),0,0,'C');
		$this->Ln(6);
		$this->Cell(0,10,'San Antonio de los Altos, Estado Bolivariano de Miranda.',0,0,'C');
		$this->Ln(6);
		$hoy = date("d-m-Y (H:i:s)");
		$this->Cell(0,10,$hoy,0,0,'C');
		$this->Ln(20);
		
	}

	public function Footer(){
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		$this->SetFont('Arial','I',10);
		// Número de página
		$this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/ {nb}',0,0,'R');
	}
} 

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('landscape', 'letter');

$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,'Reporte Clientes',0,0,'C');
		$pdf->Ln(20);
		
$pdf->SetFont('Times','B',12);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(255, 255, 255);
		$pdf-> Cell(20, 10, utf8_decode('Cédula'), 1, 0, 'C', 1);
		$pdf-> Cell(65, 10, 'Nombre Completo', 1, 0, 'C', 1);
		$pdf-> Cell(20, 10, utf8_decode('Género'), 1, 0, 'C', 1);
		$pdf-> Cell(55, 10, utf8_decode('Dirección'), 1, 0, 'C', 1);
		$pdf-> Cell(65, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
		$pdf-> Cell(30, 10, utf8_decode('Teléfono'), 1, 1, 'C', 1);
		$pdf->Ln(2);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);


require 'includes/conexion.php';
	$query= mysqli_query($conexion, "SELECT c.ci_cliente, c.nombre, c.apellido, g.descripcion, 
										e.estado, ciu.ciudad, m.municipio, d.detalle_direccion
										FROM cliente c
										INNER JOIN genero g      ON c.codgenero = g.codgenero
											INNER JOIN direccion d   ON c.ci_cliente = d.ci_cliente
											INNER JOIN estados e         ON d.id_estado = e.id_estado
											INNER JOIN ciudades ciu      ON d.id_ciudad = ciu.id_ciudad
											INNER JOIN municipios m      ON d.id_municipio = m.id_municipio
										WHERE c.estatus=1
										ORDER BY c.fechaingreso DESC");

	while($mostrar=mysqli_fetch_array($query)) {
		$ci_cliente=$mostrar['ci_cliente'];
		$nombre=$mostrar['nombre'];
		$apellido=$mostrar['apellido'];
			$ncompleto= $nombre." ".$apellido;
		$genero=$mostrar['descripcion'];
		
		$estado=$mostrar['estado'];
		$ciudad=$mostrar['ciudad'];
		$municipio=$mostrar['municipio'];
		$detalle_direccion=$mostrar['detalle_direccion'];
		if(!empty ($detalle_direccion)){
			$direccion = $estado. ", " .$ciudad.", ".$municipio.", ".$detalle_direccion.".";
		} else{
			$direccion = $estado. ", " .$ciudad.", ".$municipio.".";
		}
		
		
		$tel = "";
		$mail ="";
		
	$pdf-> Cell(20, 8, $ci_cliente , 1, 0, 'C', 1);
	$pdf-> Cell(65, 8, utf8_decode($ncompleto), 1, 0, 'C', 1);
	$pdf-> Cell(20, 8, $genero, 1, 0, 'C', 1);
	$pdf-> MultiCell(55, 8, utf8_decode($direccion), 1, 'C', 1);
	$y_aqui = $pdf->Gety();
	$y_aqui = $y_aqui - 8;
	$pdf->SetXY(170,$y_aqui);
	
	$telefono= mysqli_query($conexion, "SELECT telf.ci_cliente, a.descripcion_area, telf.telefono_cliente
										FROM telefono_cliente telf
										INNER JOIN area a ON telf.idarea = a.idarea
										WHERE ci_cliente = '$ci_cliente'");
		while($mostrar_telf=mysqli_fetch_array($telefono)) {
			$telf= $mostrar_telf['descripcion_area'].$mostrar_telf['telefono_cliente'];
			$tel = $telf . "\n". $tel; 
		}
	
	$correo= mysqli_query($conexion, "SELECT co.ci_cliente, co.correo_cliente, dom.descripcion_dominio
										FROM correo_cliente co
										INNER JOIN dominio dom ON co.iddominio = dom.iddominio
										WHERE ci_cliente = '$ci_cliente'");
		while($mostrar_correo=mysqli_fetch_array($correo)) {
			$email= $mostrar_correo['correo_cliente'].$mostrar_correo['descripcion_dominio'];
			$mail = $email ."\n". $mail; 
		}
	$pdf-> MultiCell(65, 8, $mail, 1, 'C', 1);
	
	$y_aqui = $pdf->Gety();
	$y_aqui = $y_aqui - 8;
	$pdf->SetXY(235,$y_aqui);
	$pdf-> MultiCell(30, 7, $tel, 1, 'C', 1);
	
	$pdf->Ln(1);
	}
	


$pdf->Output('I', 'Clientes.pdf');
?>
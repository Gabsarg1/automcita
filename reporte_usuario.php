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
		$pdf->Cell(0,10,'Reporte Usuarios',0,0,'C');
		$pdf->Ln(20);
		
$pdf->SetFont('Times','B',12);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(255, 255, 255);
		$pdf-> Cell(27, 10, utf8_decode('Cédula'), 1, 0, 'C', 1);
		$pdf-> Cell(60, 10, 'Nombre Completo', 1, 0, 'C', 1);
		$pdf-> Cell(25, 10, utf8_decode('Cargo'), 1, 0, 'C', 1);
		$pdf-> Cell(70, 10, utf8_decode('Dirección'), 1, 0, 'C', 1);
		$pdf-> Cell(55, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
		$pdf-> Cell(30, 10, utf8_decode('Teléfono'), 1, 1, 'C', 1);
		$pdf->Ln(2);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);


require 'includes/conexion.php';
	$query= mysqli_query($conexion, "SELECT u.ci_usuario, u.nombreu, u.apellidou, u.direccion, r.nombrerol
										FROM usuario u
										INNER JOIN rol r      ON u.idrol = r.idrol
										ORDER BY fechaingreso ASC");

	while($mostrar=mysqli_fetch_array($query)) {
		$ci_usuario=$mostrar['ci_usuario'];
		$nombre=$mostrar['nombreu'];
		$apellido=$mostrar['apellidou'];
			$ncompleto= $nombre ." ". $apellido;
		$rol=$mostrar['nombrerol'];
		$direccion=$mostrar['direccion'];
	
		$tel = "";
		$mail ="";
		
	$pdf-> Cell(27, 8, $ci_usuario , 1, 0, 'C', 1);
	$pdf-> Cell(60, 8, utf8_decode($ncompleto), 1, 0, 'C', 1);
	$pdf-> Cell(25, 8, utf8_decode($rol), 1, 0, 'C', 1);

	$pdf-> MultiCell(70, 8, utf8_decode($direccion), 1, 'C', 1);
	$y_aqui = $pdf->Gety();
	$y_aqui = $y_aqui - 8;
	$pdf->SetXY(192,$y_aqui);
	
	$telefono= mysqli_query($conexion, "SELECT telf.ci_usuario, a.descripcion_area, telf.telefono_usuario
										FROM telefono_usuario telf
										INNER JOIN area a ON telf.idarea = a.idarea
										WHERE ci_usuario = '$ci_usuario'");
		while($mostrar_telf=mysqli_fetch_array($telefono)) {
			$telf= $mostrar_telf['descripcion_area'].$mostrar_telf['telefono_usuario'];
			$tel = $telf . "\n". $tel; 
		}
	
	$correo= mysqli_query($conexion, "SELECT co.ci_usuario, co.correo_usuario, dom.descripcion_dominio
										FROM correo_usuario co
										INNER JOIN dominio dom ON co.iddominio = dom.iddominio
										WHERE ci_usuario = '$ci_usuario'");
		while($mostrar_correo=mysqli_fetch_array($correo)) {
			$email= $mostrar_correo['correo_usuario'].$mostrar_correo['descripcion_dominio'];
			$mail = $email ."\n". $mail; 
		}
	$pdf-> MultiCell(55, 8, $mail, 1, 'C', 1);
	
	$y_aqui = $pdf->Gety();
	$y_aqui = $y_aqui - 8;
	$pdf->SetXY(247,$y_aqui);

	$pdf-> MultiCell(30, 8, $tel, 1, 'C', 1);
	
	$pdf->Ln(1);
	}
	


$pdf->Output('I', 'usuarios.pdf');
?>
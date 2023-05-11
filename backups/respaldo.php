<?php
$conexion= mysqli_connect("localhost","root","","divas");

$tables=array();
$resultado=mysqli_query($conexion,"SHOW TABLES");

while($row=mysqli_fetch_row($resultado)){
	$tables[]=$row[0];
}



$backupSQL="";
foreach($tables as $table){
	
	$resultado=mysqli_query($conexion,"SHOW CREATE TABLE $table");
	$row=mysqli_fetch_row($resultado);
	$backupSQL.="\n\n".$row[1].";\n\n";


	$resultado=mysqli_query($conexion,"SELECT * FROM $table");
	$columnas=mysqli_num_fields($resultado);

	for($i=0;$i<$columnas;$i++){
		while($row=mysqli_fetch_row($resultado)){
			$backupSQL.="INSERT INTO $table VALUES(";
		
			for($j=0;$j<$columnas;$j++){
				$row[$j]=$row[$j];

				if(isset($row[$j])){
					$backupSQL.='"'.$row[$j].'"';
				}else{
				$backupSQL.='""';
				}
			
				if($j<($columnas-1)){
					$backupSQL.=',';
				}
			}
			
			$backupSQL.=");\n";
		}
	}
	
	$backupSQL.="\n";
}

if(!empty($backupSQL)){
	$backup_file_name='divas_backup_'.date("Ymd_His", time()).'.sql';
	$fileHandler=fopen($backup_file_name,'w+');
	$number_of_lines=fwrite($fileHandler,$backupSQL);
	fclose($fileHandler);
	
	// descargar el archivo

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exit;
}
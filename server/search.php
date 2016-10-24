<?php
include 'config/config.php';

/* Extrae los valores enviados desde la aplicacion movil */
$nitEnviado = $_GET ['nit'];

// retorna info de la base de datos
/*
 * $servidor = "localhost"; $user = "root"; $pass = "samile"; $db = "proyekta";
 */
$conexion = conectar ( "indicadores" );

$sql = "SELECT * FROM empresas WHERE nit =".$nitEnviado;

$resultado = ejecutar ( $sql, $conexion );

while ( $campo = mysql_fetch_row ( $resultado ) ) {
	
	$nit = $campo [0];
	$nombre = $campo [1];
	$ciudad = $campo [2];
	$dpto = $campo [3];
	$ciiu = $campo [4];
	
}

if (! empty ( $nit )) {
	
	// valida estado
	/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
		$resultados = array ();
		$resultados ["nit"] =$nit;
		$resultados ["nombre"] = $nombre;
		$resultados ["ciudad"] = $ciudad;
		$resultados ["dpto"] = $dpto;
		$resultados ["ciiu"] = $ciiu;
		$resultados ["mensaje"] = "Validacion Correcta";
		$resultados ["validacion"] = "ok";
	
} else {
	$resultados ["mensaje"] = "No se encontraron resultados";
	$resultados ["validacion"] = "error";
}

/* convierte los resultados a formato json */
$resultadosJson = json_encode ( $resultados );

/* muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET ['jsoncallback'] . '(' . $resultadosJson . ');';

?>
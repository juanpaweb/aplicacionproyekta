<?php
include 'config/config.php';

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET ['usuario'];
$passwordEnviado =md5($_GET ['password']);

// retorna info de la base de datos
/*
 * $servidor = "localhost"; $user = "root"; $pass = "samile"; $db = "proyekta";
 */
$conexion = conectar ( "webpk" );

$sql = "SELECT * FROM registro WHERE email ='" . $usuarioEnviado . "'  AND contrasena = '" .$passwordEnviado. "'";

$resultado = ejecutar ( $sql, $conexion );

while ( $campo = mysql_fetch_row ( $resultado ) ) {
	
	$registro_id = $campo [0];
	$primer_nombre = $campo [1];
	$primer_apellido = $campo [2];
	$tipo_identificacion = $campo [3];
	$pais = $campo [4];
	$numero = $campo [5];
	$fecha_nacimiento = $campo [6];
	$telefono = $campo [7];
	$email = $campo [8];
	$contrasena = $campo [9];
	$estado = $campo [10];
}

if (! empty ( $registro_id )) {
	
	// valida estado
	if ($estado != 'ACTIVO') {
		$resultados ["mensaje"] = "Su usuario no ha sido activado, por favor escribanos a xxxx@proyekta.com.co";
		$resultados ["validacion"] = "error";
	} else {
		/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
		$resultados = array ();
		$resultados ["hora"] = date ( "F j, Y, g:i a" );
		$resultados ["nombre"] = $primer_nombre . " " . $primer_apellido;
		$resultados ["id"] = $registro_id;
		$resultados ["mensaje"] = "Validacion Correcta";
		$resultados ["validacion"] = "ok";
	}
} else {
	$resultados ["mensaje"] = "Usuario y password incorrectos";
	$resultados ["validacion"] = "error";
}

/* convierte los resultados a formato json */
$resultadosJson = json_encode ( $resultados );

/* muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET ['jsoncallback'] . '(' . $resultadosJson . ');';

?>
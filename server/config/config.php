<?php
function conectar($bd) {
	$con = mysql_connect ( "localhost", "webpk", "1qazxsw23edc" ) or die ( "ERROR EN CONEXION: " . mysql_error () );
	
	$base_datos = mysql_select_db ( $bd, $con ) or die ( "ERROR AL SELECCIONAR BASE DE DATOS: " . mysql_error () );
	
	return $con;
}
function ejecutar($sql, $con) {
	$result = mysql_query ( $sql, $con ) or die ( "ERROR EN LA CONSULTA: " . mysql_error () );
	
	return $result;
}

?>

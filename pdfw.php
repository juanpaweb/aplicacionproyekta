<?php
session_start ();
require ("lib/mail/attach_mailer_class.php");
/* incluimos primeramente el archivo que contiene la clase fpdf */
include ('lib/fpdf.php');

/* Conexion a la base de datos */
include ('server/config/config.php');

$conexion = conectar ( "indicadores" );
$id = $_GET ['id']; // Tomamos por GET el id del producto del que se desean extraer los datos de la BD
                    
// /////////////////////
$sql = "SELECT * FROM empresas WHERE nit='$id'";

$resultado = ejecutar ( $sql, $conexion );

while ( $campo = mysql_fetch_row ( $resultado ) ) {
	
	$nombre = $campo [1];
	$html = "$campo[1]";
	$ciudad = $campo [2];
	$ciuu = $campo [4];
	$nit = $campo [0];
}

/**
 * *****************************
 */
$sqla = "SELECT anio FROM anios ";
$resultadoan = ejecutar ( $sqla, $conexion );
while ( $campos = mysql_fetch_row ( $resultadoan ) ) {
	if ($campos != null) {
		$anios [] = $campos [0];
	}
}
// Fabrica consulta RAZON CORRIENTE

foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,razon_corriente FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$razon = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$v1 = $camposLiq [1];
			break;
		case 2010 :
			$v2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$v3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$v4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$v5 = $camposLiq [1];
			;
			break;
		default :
			$cc="-";
		
	}
	
	//$razon .= "Año " . $camposLiq [0] . ":" . $camposLiq [1] . "\n ";
	
	}
	
	if(empty($v1)){
		$cc1="-";
	}
	if(empty($v2)){
		$cc2="-";
	}
	if(empty($v3)){
		$cc3="-";
	}
	if(empty($v4)){
		$cc4="-";
	}
	if(empty($v5)){
		$cc5="-";
	}
	
	$razon= '<td width="80" height="30" align="CENTER"> '.$v1.'</td><td width="80" height="30" align="CENTER"> '.$v2.'</td><td width="80" height="30" align="CENTER"> '.$v3.'</td><td width="80" height="30" align="CENTER"> '.$v4.'</td><td width="80" height="30" align="CENTER"> '.$v5.'</td>';
	
// Fabrica consulta KTNO
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,FORMAT(KTNO,0) FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$ktno = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$k1 = $camposLiq [1];
			break;
		case 2010 :
			$k2 = $camposLiq [1];
			
			break;
		case 2011 :
			$k3 = $camposLiq [1];
			
			break;
		case 2012 :
			$k4 = $camposLiq [1];
			
			break;
		case 2013 :
			$k5 = $camposLiq [1];
			
			break;
	}
	
	//$ktno .= "Año " . $camposLiq [0] . ":$" . $camposLiq [1] . "\n ";
}
$ktno= '<td width="80" height="30" align="CENTER"> '.$k1.'</td><td width="80" height="30" align="CENTER"> '.$k2.'</td><td width="80" height="30" align="CENTER"> '.$k3.'</td><td width="80" height="30" align="CENTER"> '.$k4.'</td><td width="80" height="30" align="CENTER"> '.$k5.'</td>';
//echo $ktno;
// Fabrica consulta prueba acida
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,prueba_acida_inventarios FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$pruebaa = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$pru1 = $camposLiq [1];
			break;
		case 2010 :
			$pru2 = $camposLiq [1];
				
			break;
		case 2011 :
			$pru3 = $camposLiq [1];
				
			break;
		case 2012 :
			$pru4 = $camposLiq [1];
				
			break;
		case 2013 :
			$pru5 = $camposLiq [1];
				
			break;
	}
	
	$pruebaa .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$pruebaa= '<td width="80" height="30" align="CENTER"> '.$pru1.'</td><td width="80" height="30" align="CENTER"> '.$pru2.'</td><td width="80" height="30" align="CENTER"> '.$pru3.'</td><td width="80" height="30" align="CENTER"> '.$pru4.'</td><td width="80" height="30" align="CENTER"> '.$pru5.'</td>';


// Fabrica consulta pri
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,pri FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$pri = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$pri1 = $camposLiq [1];
			break;
		case 2010 :
			$pri2 = $camposLiq [1];
				
			break;
		case 2011 :
			$pri3 = $camposLiq [1];
				
			break;
		case 2012 :
			$pri4 = $camposLiq [1];
				
			break;
		case 2013 :
			$pri5 = $camposLiq [1];
				
			break;
	}
	
	//$pri .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$pri= '<td width="80" height="30" align="CENTER"> '.$pri1.'</td><td width="80" height="30" align="CENTER"> '.$pri2.'</td><td width="80" height="30" align="CENTER"> '.$pri3.'</td><td width="80" height="30" align="CENTER"> '.$pri4.'</td><td width="80" height="30" align="CENTER"> '.$pri5.'</td>';

// Fabrica consulta prc
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,prc FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$prc = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$prc1 = $camposLiq [1];
			break;
		case 2010 :
			$prc2 = $camposLiq [1];
	
			break;
		case 2011 :
			$prc3 = $camposLiq [1];
	
			break;
		case 2012 :
			$prc4 = $camposLiq [1];
	
			break;
		case 2013 :
			$prc5 = $camposLiq [1];
	
			break;
	}
	
	//$prc .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$prc= '<td width="80" height="30" align="CENTER"> '.$prc1.'</td><td width="80" height="30" align="CENTER"> '.$prc2.'</td><td width="80" height="30" align="CENTER"> '.$prc3.'</td><td width="80" height="30" align="CENTER"> '.$prc4.'</td><td width="80" height="30" align="CENTER"> '.$prc5.'</td>';

// Fabrica consulta prp
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	
	$consulta [] = "SELECT '" . $val . "' AS anio,prp FROM  liq_" . $val . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$prp = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$prp1 = $camposLiq [1];
			break;
		case 2010 :
			$prp2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$prp3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$prp4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$prp5 = $camposLiq [1];
			;
			break;
	}
	
	//$prp .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$prp= '<td width="80" height="30" align="CENTER"> '.$prp1.'</td><td width="80" height="30" align="CENTER"> '.$prp2.'</td><td width="80" height="30" align="CENTER"> '.$prp3.'</td><td width="80" height="30" align="CENTER"> '.$prp4.'</td><td width="80" height="30" align="CENTER"> '.$prp5.'</td>';

// Fabrica consulta nivel endeudamiento
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,nivel_endeundamiento FROM  end_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$nend = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$end1 = $camposLiq [1];
			break;
		case 2010 :
			$end2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$end3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$end4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$end5 = $camposLiq [1];
			;
			break;
	}
	
	//$nend .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$nend= '<td width="80" height="30" align="CENTER"> '.$end1.'</td><td width="80" height="30" align="CENTER"> '.$end2.'</td><td width="80" height="30" align="CENTER"> '.$end3.'</td><td width="80" height="30" align="CENTER"> '.$end4.'</td><td width="80" height="30" align="CENTER"> '.$end5.'</td>';

// Fabrica consulta concentra endeuda
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,concentracion_endeuda_corto FROM  end_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$cend = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$cend1 = $camposLiq [1];
			break;
		case 2010 :
			$cend2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$cend3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$cend4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$cend5 = $camposLiq [1];
			;
			break;
	}
	
	//$cend .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$cend= '<td width="80" height="30" align="CENTER"> '.$cend1.'</td><td width="80" height="30" align="CENTER"> '.$cend2.'</td><td width="80" height="30" align="CENTER"> '.$cend3.'</td><td width="80" height="30" align="CENTER"> '.$cend4.'</td><td width="80" height="30" align="CENTER"> '.$cend5.'</td>';

// Fabrica consulta margen bruto
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,margen_bruto FROM  rent_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$mbruto = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	switch ($camposLiq [0]) {
		case 2009 :
			$mb1 = $camposLiq [1];
			break;
		case 2010 :
			$mb2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$mb3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$mb4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$mb5 = $camposLiq [1];
			;
			break;
	}
	
	//$mbruto .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$mbruto= '<td width="80" height="30" align="CENTER"> '.$mb1.'</td><td width="80" height="30" align="CENTER"> '.$mb2.'</td><td width="80" height="30" align="CENTER"> '.$mb3.'</td><td width="80" height="30" align="CENTER"> '.$mb4.'</td><td width="80" height="30" align="CENTER"> '.$mb5.'</td>';

// Fabrica consulta margen operacional
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,margen_operacional FROM  rent_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$mopera = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$mo1 = $camposLiq [1];
			break;
		case 2010 :
			$mo2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$mo3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$mo4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$mo5 = $camposLiq [1];
			;
			break;
	}
	
	//$mopera .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$mopera= '<td width="80" height="30" align="CENTER"> '.$mo1.'</td><td width="80" height="30" align="CENTER"> '.$mo2.'</td><td width="80" height="30" align="CENTER"> '.$mo3.'</td><td width="80" height="30" align="CENTER"> '.$mo4.'</td><td width="80" height="30" align="CENTER"> '.$mo5.'</td>';

// Fabrica consulta margen neto
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,margen_neto FROM  rent_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$mneto = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$mn1 = $camposLiq [1];
			break;
		case 2010 :
			$mn2 = $camposLiq [1];
			;
			break;
		case 2011 :
			$mn3 = $camposLiq [1];
			;
			break;
		case 2012 :
			$mn4 = $camposLiq [1];
			;
			break;
		case 2013 :
			$mn5 = $camposLiq [1];
			;
			break;
	}
	
	//$mneto .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$mneto= '<td width="80" height="30" align="CENTER"> '.$mn1.'</td><td width="80" height="30" align="CENTER"> '.$mn2.'</td><td width="80" height="30" align="CENTER"> '.$mn3.'</td><td width="80" height="30" align="CENTER"> '.$mn4.'</td><td width="80" height="30" align="CENTER"> '.$mn5.'</td>';

// Fabrica consulta roa
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,roa FROM  rent_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$roa = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$roa1 = $camposLiq [1];
			break;
		case 2010 :
			$roa2 = $camposLiq [1];
			
			break;
		case 2011 :
			$roa3 = $camposLiq [1];
		
			break;
		case 2012 :
			$roa4 = $camposLiq [1];
		
			break;
		case 2013 :
			$roa5 = $camposLiq [1];
		
			break;
	}
	
	//$roa .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$roa= '<td width="80" height="30" align="CENTER"> '.$roa1.'</td><td width="80" height="30" align="CENTER"> '.$roa2.'</td><td width="80" height="30" align="CENTER"> '.$roa3.'</td><td width="80" height="30" align="CENTER"> '.$roa4.'</td><td width="80" height="30" align="CENTER"> '.$roa5.'</td>';

// Fabrica consulta roe
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,roe FROM  rent_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$roe = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$roe1 = $camposLiq [1];
			break;
		case 2010 :
			$roe2 = $camposLiq [1];
				
			break;
		case 2011 :
			$roe3 = $camposLiq [1];
	
			break;
		case 2012 :
			$roe4 = $camposLiq [1];
	
			break;
		case 2013 :
			$roe5 = $camposLiq [1];
	
			break;
	}
	
	//$roe .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "% \n ";
}
$roe= '<td width="80" height="30" align="CENTER"> '.$roe1.'</td><td width="80" height="30" align="CENTER"> '.$roe2.'</td><td width="80" height="30" align="CENTER"> '.$roe3.'</td><td width="80" height="30" align="CENTER"> '.$roe4.'</td><td width="80" height="30" align="CENTER"> '.$roe5.'</td>';

// Fabrica consulta z_score
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,z_score FROM  cyg_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$zscore = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$zs1 = $camposLiq [1];
			break;
		case 2010 :
			$zs2 = $camposLiq [1];
	
			break;
		case 2011 :
			$zs3 = $camposLiq [1];
	
			break;
		case 2012 :
			$zs4 = $camposLiq [1];
	
			break;
		case 2013 :
			$zs5 = $camposLiq [1];
	
			break;
	}
	
	//$zscore .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$zscore= '<td width="80" height="30" align="CENTER"> '.$zs1.'</td><td width="80" height="30" align="CENTER"> '.$zs2.'</td><td width="80" height="30" align="CENTER"> '.$zs3.'</td><td width="80" height="30" align="CENTER"> '.$zs4.'</td><td width="80" height="30" align="CENTER"> '.$zs5.'</td>';

// Fabrica consulta apalancamiento operacional
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,apalancamiento_operacional FROM  cyg_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$aope = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$aop1 = $camposLiq [1];
			break;
		case 2010 :
			$aop2 = $camposLiq [1];
	
			break;
		case 2011 :
			$aop3 = $camposLiq [1];
	
			break;
		case 2012 :
			$aop4 = $camposLiq [1];
	
			break;
		case 2013 :
			$aop5 = $camposLiq [1];
	
			break;
	}
	
	//$aope .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$aope= '<td width="80" height="30" align="CENTER"> '.$aop1.'</td><td width="80" height="30" align="CENTER"> '.$aop2.'</td><td width="80" height="30" align="CENTER"> '.$aop3.'</td><td width="80" height="30" align="CENTER"> '.$aop4.'</td><td width="80" height="30" align="CENTER"> '.$aop5.'</td>';

// Fabrica consulta apalancamiento financiero
$final = '';
$consulta = '';
foreach ( $anios as $val ) {
	$tab = substr ( $val, 2 );
	$consulta [] = "SELECT '" . $val . "' AS anio,apalancamiento_financiero FROM  cyg_" . $tab . " WHERE nit = " . $id;
}
$i = 1;
foreach ( $consulta as $val2 ) {
	if (count ( $consulta ) == $i) {
		$final .= $val2;
	} else {
		$final .= $val2 . " UNION ";
	}
	
	$i ++;
}
$afina = '';
// ejecuta consulta
$sqlLiq = $final;

$resultadoliq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoliq ) ) {
	
	switch ($camposLiq [0]) {
		case 2009 :
			$af1 = $camposLiq [1];
			break;
		case 2010 :
			$af2 = $camposLiq [1];
	
			break;
		case 2011 :
			$af3 = $camposLiq [1];
	
			break;
		case 2012 :
			$af4 = $camposLiq [1];
	
			break;
		case 2013 :
			$af5 = $camposLiq [1];
	
			break;
	}
	
	//$afina .= "Año " . $camposLiq [0] . ": " . $camposLiq [1] . "\n ";
}
$afina= '<td width="80" height="30" align="CENTER"> '.$af1.'</td><td width="80" height="30" align="CENTER"> '.$af2.'</td><td width="80" height="30" align="CENTER"> '.$af3.'</td><td width="80" height="30" align="CENTER"> '.$af4.'</td><td width="80" height="30" align="CENTER"> '.$af5.'</td>';

/**
 * **************************
 */
// ////////////////////////

// Cabecera para solucionar el problema de los acentos y las ñ
header ( "Content-Type: text/html; charset=iso-8859-1 " );
// function hex2dec
// returns an associative array (keys: R,G,B) from
// a hex html code (e.g. #3FE5AA)
function hex2dec($couleur = "#000000") {
	$R = substr ( $couleur, 1, 2 );
	$rouge = hexdec ( $R );
	$V = substr ( $couleur, 3, 2 );
	$vert = hexdec ( $V );
	$B = substr ( $couleur, 5, 2 );
	$bleu = hexdec ( $B );
	$tbl_couleur = array ();
	$tbl_couleur ['R'] = $rouge;
	$tbl_couleur ['G'] = $vert;
	$tbl_couleur ['B'] = $bleu;
	return $tbl_couleur;
}

// conversion pixel -> millimeter in 72 dpi
function px2mm($px) {
	return $px * 25.4 / 72;
}
function txtentities($html) {
	$trans = get_html_translation_table ( HTML_ENTITIES );
	$trans = array_flip ( $trans );
	return strtr ( $html, $trans );
}
class PDF extends FPDF {
	var $B;
	var $I;
	var $U;
	var $HREF;
	var $fontList;
	var $issetfont;
	var $issetcolor;
	function PDF($orientation = 'P', $unit = 'mm', $size = 'A4') {
		// Llama al constructor de la clase padre
		$this->FPDF ( $orientation, $unit, $size );
		// IniciaciÃƒÂ³n de variables
		$this->B = 0;
		$this->I = 0;
		$this->U = 0;
		$this->HREF = '';
	}
	
	// FunciÃƒÂ³n para escribir en cÃƒÂ³digo HTML y que se detecten las etiquetas
	function WriteHTML($html) {
		$html = strip_tags ( $html, "<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>" ); // remove all unsupported tags
		$html = str_replace ( "\n", '', $html ); // replace carriage returns by spaces
		$html = str_replace ( "\t", '', $html ); // replace carriage returns by spaces
		$a = preg_split ( '/<(.*)>/U', $html, - 1, PREG_SPLIT_DELIM_CAPTURE ); // explodes the string
		foreach ( $a as $i => $e ) {
			if ($i % 2 == 0) {
				// Text
				if ($this->HREF)
					$this->PutLink ( $this->HREF, $e );
				elseif ($this->tdbegin) {
					if (trim ( $e ) != '' && $e != " ") {
						$this->Cell ( $this->tdwidth, $this->tdheight, $e, $this->tableborder, ' ', $this->tdalign, $this->tdbgcolor );
					} elseif ($e == " ") {
						$this->Cell ( $this->tdwidth, $this->tdheight, '', $this->tableborder, ' ', $this->tdalign, $this->tdbgcolor );
					}
				} else
					$this->Write ( 5, stripslashes ( txtentities ( $e ) ) );
			} else {
				// Tag
				if ($e [0] == '/')
					$this->CloseTag ( strtoupper ( substr ( $e, 1 ) ) );
				else {
					// Extract attributes
					$a2 = explode ( ' ', $e );
					$tag = strtoupper ( array_shift ( $a2 ) );
					$attr = array ();
					foreach ( $a2 as $v ) {
						if (preg_match ( '/([^=]*)=["\']?([^"\']*)/', $v, $a3 ))
							$attr [strtoupper ( $a3 [1] )] = $a3 [2];
					}
					$this->OpenTag ( $tag, $attr );
				}
			}
		}
	}
	function OpenTag($tag, $attr) {
		// Opening tag
		switch ($tag) {
			
			case 'SUP' :
				if (! empty ( $attr ['SUP'] )) {
					// Set current font to 6pt
					$this->SetFont ( '', '', 6 );
					// Start 125cm plus width of cell to the right of left margin
					// Superscript "1"
					$this->Cell ( 2, 2, $attr ['SUP'], 0, 0, 'L' );
				}
				break;
			
			case 'TABLE' : // TABLE-BEGIN
				if (! empty ( $attr ['BORDER'] ))
					$this->tableborder = $attr ['BORDER'];
				else
					$this->tableborder = 0;
				break;
			case 'TR' : // TR-BEGIN
				break;
			case 'TD' : // TD-BEGIN
				if (! empty ( $attr ['WIDTH'] ))
					$this->tdwidth = ($attr ['WIDTH'] / 4);
				else
					$this->tdwidth = 40; // Set to your own width if you need bigger fixed cells
				if (! empty ( $attr ['HEIGHT'] ))
					$this->tdheight = ($attr ['HEIGHT'] / 6);
				else
					$this->tdheight = 6; // Set to your own height if you need bigger fixed cells
				if (! empty ( $attr ['ALIGN'] )) {
					$align = $attr ['ALIGN'];
					if ($align == 'LEFT')
						$this->tdalign = 'L';
					if ($align == 'CENTER')
						$this->tdalign = 'C';
					if ($align == 'RIGHT')
						$this->tdalign = 'R';
				} else
					$this->tdalign = 'L'; // Set to your own
				if (! empty ( $attr ['BGCOLOR'] )) {
					$coul = hex2dec ( $attr ['BGCOLOR'] );
					$this->SetFillColor ( $coul ['R'], $coul ['G'], $coul ['B'] );
					$this->tdbgcolor = true;
				}
				$this->tdbegin = true;
				break;
			
			case 'HR' :
				if (! empty ( $attr ['WIDTH'] ))
					$Width = $attr ['WIDTH'];
				else
					$Width = $this->w - $this->lMargin - $this->rMargin;
				$x = $this->GetX ();
				$y = $this->GetY ();
				$this->SetLineWidth ( 0.2 );
				$this->Line ( $x, $y, $x + $Width, $y );
				$this->SetLineWidth ( 0.2 );
				$this->Ln ( 1 );
				break;
			case 'STRONG' :
				$this->SetStyle ( 'B', true );
				break;
			case 'EM' :
				$this->SetStyle ( 'I', true );
				break;
			case 'B' :
			case 'I' :
			case 'U' :
				$this->SetStyle ( $tag, true );
				break;
			case 'A' :
				$this->HREF = $attr ['HREF'];
				break;
			case 'IMG' :
				if (isset ( $attr ['SRC'] ) && (isset ( $attr ['WIDTH'] ) || isset ( $attr ['HEIGHT'] ))) {
					if (! isset ( $attr ['WIDTH'] ))
						$attr ['WIDTH'] = 0;
					if (! isset ( $attr ['HEIGHT'] ))
						$attr ['HEIGHT'] = 0;
					$this->Image ( $attr ['SRC'], $this->GetX (), $this->GetY (), px2mm ( $attr ['WIDTH'] ), px2mm ( $attr ['HEIGHT'] ) );
				}
				break;
			case 'BLOCKQUOTE' :
			case 'BR' :
				$this->Ln ( 5 );
				break;
			case 'P' :
				$this->Ln ( 10 );
				break;
			case 'FONT' :
				if (isset ( $attr ['COLOR'] ) && $attr ['COLOR'] != '') {
					$coul = hex2dec ( $attr ['COLOR'] );
					$this->SetTextColor ( $coul ['R'], $coul ['G'], $coul ['B'] );
					$this->issetcolor = true;
				}
				if (isset ( $attr ['FACE'] ) && in_array ( strtolower ( $attr ['FACE'] ), $this->fontlist )) {
					$this->SetFont ( strtolower ( $attr ['FACE'] ) );
					$this->issetfont = true;
				}
				if (isset ( $attr ['FACE'] ) && in_array ( strtolower ( $attr ['FACE'] ), $this->fontlist ) && isset ( $attr ['SIZE'] ) && $attr ['SIZE'] != '') {
					$this->SetFont ( strtolower ( $attr ['FACE'] ), '', $attr ['SIZE'] );
					$this->issetfont = true;
				}
				break;
		}
	}
	function CloseTag($tag) {
		// Closing tag
		if ($tag == 'SUP') {
		}
		
		if ($tag == 'TD') { // TD-END
			$this->tdbegin = false;
			$this->tdwidth = 0;
			$this->tdheight = 0;
			$this->tdalign = "L";
			$this->tdbgcolor = false;
		}
		if ($tag == 'TR') { // TR-END
		                    
			// $this->Ln();
			$this->SetXY ( 90, $this->GetY () + 5 );
		}
		if ($tag == 'TABLE') { // TABLE-END
		                       // $this->Ln();
			$this->tableborder = 0;
		}
		
		if ($tag == 'STRONG')
			$tag = 'B';
		if ($tag == 'EM')
			$tag = 'I';
		if ($tag == 'B' || $tag == 'I' || $tag == 'U')
			$this->SetStyle ( $tag, false );
		if ($tag == 'A')
			$this->HREF = '';
		if ($tag == 'FONT') {
			if ($this->issetcolor == true) {
				$this->SetTextColor ( 0 );
			}
			if ($this->issetfont) {
				$this->SetFont ( 'arial' );
				$this->issetfont = false;
			}
		}
	}
	function SetStyle($tag, $enable) {
		// Modify style and select corresponding font
		$this->$tag += ($enable ? 1 : - 1);
		$style = '';
		foreach ( array (
				'B',
				'I',
				'U' 
		) as $s ) {
			if ($this->$s > 0)
				$style .= $s;
		}
		$this->SetFont ( '', $style );
	}
	function PutLink($URL, $txt) {
		// Put a hyperlink
		$this->SetTextColor ( 0, 0, 255 );
		$this->SetStyle ( 'U', true );
		$this->Write ( 5, $txt, $URL );
		$this->SetStyle ( 'U', false );
		$this->SetTextColor ( 0 );
	}
	
	// Cabecera de pÃƒÂ¡gina
	function Header() {
		// Logo de la cabecera del PDF
		// $this->Image('img/logo_uno.png',10,4,53,40);
		$this->SetFont ( 'Helvetica', 'B', 42 );
		$this->SetTextColor ( 192, 203, 255 );
		///$this->RotatedText ( 90, 90, 'N O   C O P I A R', 0 );
	}
	function RotatedText($x, $y, $txt, $angle) {
		// Text rotated around its origin
		$this->Rotate ( $angle, $x, $y );
		$this->Text ( $x, $y, $txt );
		$this->Rotate ( 0 );
	}
	function Rotate($angle, $x = -1, $y = -1) {
		if ($x == - 1)
			$x = $this->x;
		if ($y == - 1)
			$y = $this->y;
		if ($this->angle != 0)
			$this->_out ( 'Q' );
		$this->angle = $angle;
		if ($angle != 0) {
			$angle *= M_PI / 180;
			$c = cos ( $angle );
			$s = sin ( $angle );
			$cx = $x * $this->k;
			$cy = ($this->h - $y) * $this->k;
			$this->_out ( sprintf ( 'q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy ) );
		}
	}
	// Pie de pÃƒÂ¡gina
	function Footer() {
		// PosiciÃƒÂ³n: a 1,5 cm del final
		$this->SetY ( - 15 );
		// Arial italic 8
		$this->SetFont ( 'Arial', '', 8 );
		// NÃƒÂºmero de pÃƒÂ¡gina
		$this->Cell ( 0, 10, 'Page ' . $this->PageNo (), 0, 0, 'C' );
	}
	// Tabla coloreada
	function TablaColores($header, $razon, $ktno, $pruebaa, $pri, $prc, $prp, $nend, $cend, $mbruto, $mopera, $mneto, $roa, $roe, $zscore, $aope, $afina) {
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor ( 0, 0, 255 );
		$this->SetTextColor ( 255 );
		$this->SetDrawColor ( 0, 0, 255 );
		$this->SetLineWidth ( .3 );
		$this->SetFont ( '', 'B' );
		// Cabecera
		$this->Cell ( 70, 7, "INDICADOR", 1, 0, 'C', 1 );
		$this->Cell ( 70, 7, "FORMULA", 1, 0, 'C', 1 );
		$this->Cell ( 50, 7, "RESULTADOS", 1, 0, 'C', 1 );
		$this->Cell ( 90, 7, "INTERPRETACION", 1, 0, 'C', 1 );
		
		$this->Ln ();
		// Restauración de colores y fuentes
		$this->SetFillColor ( 224, 235, 255 );
		$this->SetTextColor ( 0 );
		$this->SetFont ( '' );
		// Datos
		$fill = false;
		$this->Cell ( 70, 10, "Razón Corriente", '', 0, 'L', $fill );
		$this->Cell ( 70, 10, "Activo Corriente / Pasivo Corriente", '', 0, 'L', $fill );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$razonf = wordwrap ( $razon, 15, "\n" );
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $razonf, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 5, "Mide la capacidad de la empresa para responder con sus obligaciones en el corto plazo.", '', 1, $fill );
		
		$this->Ln ( 25 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Capital de Trabajo", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Activo corriente – Pasivo Corriente", '', 0, 'L', $fill );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$ktnof = wordwrap ( $ktno, 30, "\n" );
		
		$cell_width = 50;
		
		$this->MultiCell ( $cell_width, 6, $ktno, '', 1, $fill );
		
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		
		$this->MultiCell ( $cell_width, 6, "Son los recursos disponibles con los que cuenta la empresa para operar el funcionamiento normal del negocio..", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Prueba Acida", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "(Activo Corriente – Inventarios) / Pasivo corriente", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $pruebaa, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Mide la capacidad de la empresa para responder con sus obligaciones a corto plazo, aun si sus inventarios permanecieran quietos.", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "PRI (Periodo de rotación de inventarios)", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "(Inv. Prom / Costo de ventas ) x 365", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $pri, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Corresponde al número de días promedio en los que los inventarios se transformaran en caja o en cuentas por cobrar..", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "PRC (Periodo de rotación de cartera)", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "(CxC. Prom / Ventas netas) x 365", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $prc, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Corresponde al número de días promedio en los cuales, la compañía recupera cartera.", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "PRP (Periodo de rotación de proveedores)", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "CxP Provee Prom / Costo de ventas) x 365", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $prp, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Corresponde al número de días promedio en que se pagan las cuentas por pagar a proveedores.", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Nivel de Endeudamiento", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Total Pasivo / Total Patrimonio", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $nend, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Indica el porcentaje en los cuales son dueños los acreedores. (No se toma en cuenta para su cálculo las valorizaciones).", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Concentración endeudamiento corto plazo", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Pasivo corriente / Total Pasivo", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $cend, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Indica el porcentaje de la empresa que se financia a corto plazo. Es decir, antes de 1 año.", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Margen bruto", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Bruta / Ventas", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $mbruto, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Indica los centavos que la empresa gana de utilidad bruta por cada peso vendido.", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Margen Operacional", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Operacional / Ventas", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $mopera, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Indica los centavos que la empresa gana de utilidad operacional por cada peso vendido. (Sin Opex).", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Margen Neto", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Neta / Ventas", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $mneto, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Indica los centavos que la empresa gana de utilidad neta por cada peso vendido. (Sin Opex y sin impuestos y resultaos no operacionales).", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "ROA", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Operacional / Activos", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $roa, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Rentabilidad que generan los activos invertidos en la empresa.", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "ROE", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Neta / Patrimonio", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $roe, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Rentabilidad de los accionistas de acuerdo a la inversión realizada.", '', 1, $fill );
		$this->Ln ( 30 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Z.SCORE", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "(1.2 x (KT/TA) + 1.4 x (UR/TA) + 3.3 x (EBIT/TA) + 0.6 x (TP/TPAT) + 1 x (SALES / TA)", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $zscore, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Corresponde al cálculo del predictor de quiebra de acuerdo con el modelo de Altman.", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Apalancamiento Operacional", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Bruta / Utilidad Operacional", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $aope, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Significa que por cada punto porcentual que se incremente o disminuya las ventas, la utilidad operacional crecerá o disminuirá xx veces (Multiplicar el APO x el porcentaje de incremento en ventas)", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = ! $fill;
		$this->Cell ( 70, 6, "Apalancamiento Financiero", '', 0, 'L', $fill );
		$this->Cell ( 70, 6, "Utilidad Operacional / Utilidad Neta", '', 0, 'L', $fill );
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 50;
		$this->MultiCell ( $cell_width, 6, $afina, '', 1, $fill );
		$this->SetXY ( $current_x + $cell_width, $current_y );
		
		$current_y = $this->GetY ();
		$current_x = $this->GetX ();
		
		$cell_width = 90;
		$this->MultiCell ( $cell_width, 6, "Significa que por cada punto porcentual que se incremente o disminuya la utilidad operacional, la utilidad por acción crecerá o disminuirá xx veces (Multiplicar el APF x el porcentaje de incremento en utilidad operacional)", '', 1, $fill );
		$this->Ln ( 20 );
		$fill = true;
		$this->Ln ();
		// $this->Cell(160,0,'','T');
	}
}

// Antes de pasar los datos al PDF, hay que pasar las variables por la funciÃƒÂ³n html_entity_decode para decodificar los caracteres especiales, los acentos y las ÃƒÂ±
// Siempre y cuando los datos extraÃƒÂ­dos de la BD sean UTF8 (no lo probe con otra codificaciÃƒÂ³n)
$html = html_entity_decode ( $html );
$nombre = html_entity_decode ( $nombre );

// Creamos una nueva instancia de la clase
$pdf = new PDF ( 'P', 'mm', 'A4' );

// AÃƒÂ¡dimos la primera pÃƒÂ¡gina
$pdf->AddPage ();
$pdf->SetFont ( 'ARIAL', '', 12 );
$pdf->Ln ( 10 );

$pdf->SetFontSize ( 20 );
$pdf->SetTextColor ( 179, 179, 179 );
//////////////////////////////////////////
// Evita que se vean los errores
error_reporting(0);
include("include/jpgraph.php");
include("include/jpgraph_line.php");
include("include/jpgraph_bar.php");

//////////////////////////////////RAZON CORRIENTE/////////////////////
$datos = array($v1,$v2,$v3,$v4,$v5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(40,40,40,40);
$grafico->SetScale("textlin");
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("RAZON CORRIENTE");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("white");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("white");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("grafico.png");

//////////////////////////////////CAPITAL DE TRABAJO/////////////////////
$datos = array(str_replace(',','',$k1),str_replace(',','',$k2),str_replace(',','',$k3),str_replace(',','',$k4),str_replace(',','',$k5));
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("CAPITAL DE TRABAJO");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("ktno.png");

//////////////////////////////////PRUEBA ACIDA /////////////////////
$datos = array($pru,$pru2,$pru3,$pru4,$pru5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("PRUEBA ACIDA");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("pruebaa.png");

//////////////////////////////////PRI /////////////////////
$datos = array($pri1,$pri2,$pri3,$pri4,$pri5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("PRI (Rotación de Inventarios en Días) ");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("pri.png");


//////////////////////////////////PRC /////////////////////
$datos = array($prc1,$prc2,$prc3,$prc4,$prc5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("PRC (Rotación de Cartera en Días)");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("prc.png");

//////////////////////////////////PRP /////////////////////
$datos = array($prp1,$prp2,$prp3,$prp4,$prp5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("PRP (Rotación de Proveedores en Días)");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("white");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("white");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("prp.png");

//////////////////////////////////NIVEL DE ENDEUDAMIENTO /////////////////////
$datos = array($end1,$end2,$end3,$end4,$end5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Nivel de endeudamiento");
$grafico->title->SetColor("white");
//$lineplot = new LinePlot($datos);
/*$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);*/
//$bplot->SetColor("white");
/*$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("nend.png");

//////////////////////////////////NIVEL DE ENDEUDAMIENTO /////////////////////
$datos = array($cend1,$cend2,$cend3,$cend4,$cend5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Concentración endeudamiento Corto Pazo ");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("cend.png");

//////////////////////////////////MARGEN BRUTO /////////////////////
$datos = array($mb1,$mb2,$mb3,$mb4,$mb5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Margen bruto ");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("mbruto.png");

//////////////////////////////////MARGEN OPERACIONAL /////////////////////
$datos = array($mo1,$mo2,$mo3,$mo4,$mo5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Margen Operacional ");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("mopera.png");

//////////////////////////////////MARGEN NETO /////////////////////
$datos = array($mn1,$mn2,$mn3,$mn4,$mn5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Margen Neto");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("mneto.png");

//////////////////////////////////ROA  /////////////////////
$datos = array($roa1,$roa2,$roa3,$roa4,$roa5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("ROA (Rentabilidad del activo) ");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("roa.png");


//////////////////////////////////ROE  /////////////////////
$datos = array($roe1,$roe2,$roe3,$roe4,$roe5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("ROE (Rentabilidad Del patrimonio) ");
$grafico->title->SetColor("white");
/*$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);*/
$bplot = new BarPlot($datos);
$bplot->SetFillColor("white");
$grafico->Add($bplot);
$bplot->value->SetColor("white");
$bplot->value->Show();
$grafico->Stroke("roe.png");

//////////////////////////////////APALANCAMIENTO OPERACIONAL  /////////////////////
$datos = array($aop1,$aop2,$aop3,$aop4,$aop5);

$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Apalancamiento Operacional");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("aope.png");

//////////////////////////////////APALANCAMIENTO FINANCIERO  /////////////////////
$datos = array($af1,$af2,$af3,$af4,$af5);

$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Apalancamiento financiero ");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("afina.png");

//////////////////////////////////Z SCORE  /////////////////////
$datos = array($zs1,$zs2,$zs3,$zs4,$zs5);
$grafico = new Graph(400, 300, "auto");
$grafico->img->SetMargin(60,40,40,40);
$grafico->SetScale('textlin');
$grafico->SetShadow();
$grafico->SetColor(array(0,145,197));
$grafico->yscale->SetGrace(10,10);
$grafico->SetMarginColor(array(0,145,197));
$grafico->xaxis->SetTickLabels(array('2009','2010','2011','2012', '2013'));
$grafico->xaxis->SetColor("white");
$grafico->yaxis->SetColor("white");
$grafico->title->Set("Z-Score");
$grafico->title->SetColor("white");
$lineplot = new LinePlot($datos);
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(4);
$lineplot->SetColor("blue");
$lineplot->SetCenter();
$lineplot->SetColor("white");
$lineplot->mark->setFillColor("white");
$grafico->Add($lineplot);
$grafico->Stroke("zs.png");


$pdf->Cell ( 0, $height, $nombre, 0, 0, 'L' );
$pdf->Ln ( 10 );
$pdf->Cell ( 0, $height, 'INDICADORES FINANCIEROS', 0, 0, 'L' );
$pdf->Ln ( 20 );
$pdf->SetFontSize ( 10 );
$pdf->SetXY ( 85, 42 );
$pdf->Cell ( 0, $height, 'NOMBRE: ' . $nombre, 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetXY ( 85, 48 );
$pdf->Cell ( 0, $height, "NIT: " . $nit, 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetXY ( 85, 53 );
$pdf->Cell ( 0, $height, "CIIU: " . $ciuu, 0, 0, 'L' );
$pdf->SetXY ( 15, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 34, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 25, 62 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 62 );
$pdf->Cell ( 0, $height, "Razón Corriente ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85, 67 );
$pdf->Cell ( 0, $height, "Mide la capacidad de la empresa en cancelar sus obligaciones de Corto Plazo. ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 72 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 72 );
$pdf->Cell ( 0, $height, "Activo Corriente / Pasivo Corriente  ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 77 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'grafico.png', 110, 80, 65, 45 );
$pdf->SetXY ( 90, 130 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$html = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$razon.
'</tr>
</table>';

$pdf->WriteHTML ( $html );

///////////////CAPITAL DE TRABAJO//////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 150 );
$pdf->Cell ( 0, $height, "Capital de Trabajo ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85, 155 );
$pdf->Cell ( 0, $height, "Mide la capacidad de la empresa en cancelar sus obligaciones de Corto Plazo. ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 160 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 160 );
$pdf->Cell ( 0, $height, "Activo corriente – Pasivo Corriente ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 170 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'ktno.png', 110, 170, 65, 45 );
$pdf->SetXY ( 90, 220 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$ktno.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );
$current_y = $pdf->GetY ();
$current_x = $pdf->GetX ();
//$pdf->SetXY ( $current_x, $current_y  + 70);

$pdf->AddPage();

$pdf->SetXY ( 10, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 10, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 20, 38 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );


///////////////PRUEBA ACIDA //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 20 );
$pdf->Cell ( 0, $height, "Prueba Acida ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,25);
$pdf->MultiCell ( $cell_width, 3, "Mide la capacidad de la empresa para responder con sus obligaciones a corto plazo, aun si sus inventarios permanecieran quietos.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 35 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 35 );
$pdf->Cell ( 0, $height, "(Activo Corriente – Inventarios) / Pasivo corriente", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 40 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'pruebaa.png', 110, 40, 65, 45 );
$pdf->SetXY ( 90, 90 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$pruebaa.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

///////////////PRI //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 105 );
$pdf->Cell ( 0, $height, "PRI (Rotación de Inventarios en Días)  ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,110);
$pdf->MultiCell ( $cell_width, 3, "Días promedio en los cuales los inventarios se convierten en efectivo o cuentas por cobrar.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 120 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 120 );
$pdf->Cell ( 0, $height, "(Inv. Prom / Costo de ventas ) x 365", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 125 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'pri.png', 110, 125, 65, 45 );
$pdf->SetXY ( 90, 175 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$pri.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


///////////////PRC //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 190 );
$pdf->Cell ( 0, $height, "PRC (Rotación de Cartera en Días)", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,195);
$pdf->MultiCell ( $cell_width, 3, "Días promedio en los cuales se recuperan las cuentas por cobrar a clientes.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 205 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 205 );
$pdf->Cell ( 0, $height, "(CxC. Prom / Ventas netas) x 365 ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 210 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'prc.png', 110, 210, 65, 45 );
$pdf->SetXY ( 90, 260 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$prc.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


////////////////////////pagina 3////////////////////////////////////////////

$pdf->AddPage();

$pdf->SetXY ( 10, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 10, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 20, 38 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );


///////////////PRP //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 20 );
$pdf->Cell ( 0, $height, "PRP (Rotación de Proveedores en Días)  ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,25);
$pdf->MultiCell ( $cell_width, 3, "Días promedio en los cuales se vencen las cuentas por pagar a proveedores.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 35 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 35 );
$pdf->Cell ( 0, $height, "CxP Provee Prom / Costo de ventas) x 365", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 40 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'prp.png', 110, 40, 65, 45 );
$pdf->SetXY ( 90, 90 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$prp.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

///////////////NIVEL DE ENDEUDAMIENTO //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 105 );
$pdf->Cell ( 0, $height, "Nivel de endeudamiento ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,110);
$pdf->MultiCell ( $cell_width, 3, "Porcentaje perteneciente a los acreedores.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 120 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 120 );
$pdf->Cell ( 0, $height, "Total Pasivo / Total Patrimonio ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 125 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'nend.png', 110, 125, 65, 45 );
$pdf->SetXY ( 90, 175 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$nend.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


///////////////Concentración endeudamiento Corto Pazo //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 190 );
$pdf->Cell ( 0, $height, "Concentración endeudamiento Corto Pazo ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,195);
$pdf->MultiCell ( $cell_width, 3, "Porcentaje de los pasivos que se financian antes de 1 año.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 205 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 205 );
$pdf->Cell ( 0, $height, "Pasivo corriente / Total Pasivo", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 210 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'cend.png', 110, 210, 65, 45 );
$pdf->SetXY ( 90, 260 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$cend.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

////////////////////////pagina 4////////////////////////////////////////////

$pdf->AddPage();

$pdf->SetXY ( 10, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 10, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 20, 38 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );


///////////////MARGEN BRUTO //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 20 );
$pdf->Cell ( 0, $height, "Margen bruto ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,25);
$pdf->MultiCell ( $cell_width, 3, "Por cada peso vendido se obtuvieron xx centavos de utilidad bruta.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 35 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 35 );
$pdf->Cell ( 0, $height, "Utilidad Bruta / Ventas", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 40 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'mbruto.png', 110, 40, 65, 45 );
$pdf->SetXY ( 90, 90 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$mbruto.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

///////////////MARGEN OPERACIONAL //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 105 );
$pdf->Cell ( 0, $height, "Margen Operacional", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,110);
$pdf->MultiCell ( $cell_width, 3, "Por cada peso vendido se obtuvieron xx centavos de utilidad operacional.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 120 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 120 );
$pdf->Cell ( 0, $height, "Utilidad Operacional / Ventas ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 125 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'mopera.png', 110, 125, 65, 45 );
$pdf->SetXY ( 90, 175 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$mopera.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


///////////////Margen neto//////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 190 );
$pdf->Cell ( 0, $height, "Margen Neto", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,195);
$pdf->MultiCell ( $cell_width, 3, "Por cada peso vendido se obtuvieron xx centavos de utilidad neta.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 205 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 205 );
$pdf->Cell ( 0, $height, "Utilidad Neta / Ventas", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 210 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'mneto.png', 110, 210, 65, 45 );
$pdf->SetXY ( 90, 260 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$mneto.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


////////////////////////pagina 5////////////////////////////////////////////

$pdf->AddPage();

$pdf->SetXY ( 10, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 10, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 20, 38 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );


///////////////ROA //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 20 );
$pdf->Cell ( 0, $height, "ROA (Rentabilidad del activo)", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,25);
$pdf->MultiCell ( $cell_width, 3, "Rentabilidad que generan los activos de la empresa.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 35 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 35 );
$pdf->Cell ( 0, $height, "Utilidad Operacional / Activos", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 40 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'roa.png', 110, 40, 65, 45 );
$pdf->SetXY ( 90, 90 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$roa.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

///////////////ROE //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 105 );
$pdf->Cell ( 0, $height, "ROE (Rentabilidad Del patrimonio) ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,110);
$pdf->MultiCell ( $cell_width, 3, "Rentabilidad que obtienen los accionistas sobre su inversión.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 120 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 120 );
$pdf->Cell ( 0, $height, "Utilidad Neta / Patrimonio ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 125 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'roe.png', 110, 125, 65, 45 );
$pdf->SetXY ( 90, 175 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$roe.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );


///////////////Apalancamiento Operacional//////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 190 );
$pdf->Cell ( 0, $height, "Apalancamiento Operacional ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,195);
$pdf->MultiCell ( $cell_width, 3, "Por cada punto porcentual que se incrementan o disminuyen las ventas, la utilidad operacional aumenta o decrece xx veces.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 205 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 205 );
$pdf->Cell ( 0, $height, "Utilidad Bruta / Utilidad Operacional ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 210 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'aope.png', 110, 210, 65, 45 );
$pdf->SetXY ( 90, 260 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$aope.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

////////////////////////pagina 6////////////////////////////////////////////

$pdf->AddPage();

$pdf->SetXY ( 10, 32 );
$pdf->Image ( 'img/logo_dos.png', 10, 10, 73, 25 );
$pdf->SetFont ( 'ARIAL', 'I', 8 );
$pdf->Ln ( 15 );
$pdf->SetXY ( 20, 38 );
$pdf->Cell ( 0, $height, 'Creación de modelacion financiera', 0, 0, 'L' );
$pdf->SetFontSize ( 10 );
$pdf->SetFont ( 'ARIAL', '', 10 );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 238, 118, 0 );
$pdf->Cell ( 0, $height, 'Pongase en contacto con nosotros', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetTextColor ( 179, 179, 179 );
$pdf->Cell ( 0, $height, 'Proyekta Analyzer', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'contactenos@proyekta.com.co', 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->Cell ( 0, $height, 'www.proyekta.com.co', 0, 0, 'L' );


///////////////APALANCAMIENTO FINANCIERO //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 20 );
$pdf->Cell ( 0, $height, "Apalancamiento financiero", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,25);
$pdf->MultiCell ( $cell_width, 3, "Por cada punto porcentual que se incremente o disminuya la utilidad operacional, la utilidad por acción aumenta o decrece xx veces.", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 35 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 35 );
$pdf->Cell ( 0, $height, "Utilidad Operacional / Utilidad Neta", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 40 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'afina.png', 110, 40, 65, 45 );
$pdf->SetXY ( 90, 90 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$afina.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );

///////////////Z SCORE //////////////////////////
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 105 );
$pdf->Cell ( 0, $height, "Z-Score ", 0, 0, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 85,110);
$pdf->MultiCell ( $cell_width, 3, "Corresponde al cálculo del predictor de quiebra de acuerdo al modelo de Altman. (Las variables pueden cambiar de acuerdo al país).", '', 1, $fill );
$pdf->Ln ( 10 );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 120 );
$pdf->Cell ( 0, $height, "Formula: ", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', '', 9 );
$pdf->SetXY ( 105, 120 );
$pdf->Cell ( 0, $height, "(1.2 x (KT/TA) + 1.4 x (UR/TA) + 3.3 x (EBIT/TA) + 0.6", 0, 0, 'L' );
$pdf->SetFont ( 'ARIAL', 'B', 9 );
$pdf->SetXY ( 85, 125 );
$pdf->Cell ( 0, $height, "Resultados: ", 0, 0, 'L' );
$pdf->Image ( 'zs.png', 110, 125, 65, 45 );
$pdf->SetXY ( 90, 175 );
$pdf->SetDrawColor ( 0, 0, 0 );
$pdf->SetTextColor ( 120, 120, 120 );
$htmlk = '<table border="1" >
<tr>
<td width="80" height="30" align="CENTER">2009</td><td width="80" height="30" align="CENTER">2010</td><td width="80" height="30" align="CENTER">2011</td><td width="80" height="30" align="CENTER">2012</td><td width="80" height="30" align="CENTER">2013</td>
</tr>
<tr>'.$zscore.
'</tr>
</table>';

$pdf->WriteHTML ( $htmlk );




// $pdf->WriteHTML(utf8_decode($nombre));

// La funciÃƒÂ³n WriteHTML es la que creamos anteriormente para que lea las etiquetas html como <br>, <b>, <i>, <p>, etc.

// $pdf->Line(10,65, 280, 65);
// $pdf->Image($img, 55, 70, 100, 80);
/*$pdf->Ln ( 20 );
$pdf->SetFont ( 'Arial', 'B', 10 );
$pdf->Cell ( 0, $height, "Interpretación de los indicadores Financieros mas relevantes ", 0, 0, 'C' );

$pdf->SetFont ( 'Helvetica', '', 8 );
$header = array (
		'INDICADOR',
		'FORMULA',
		'RESULTADO',
		'INTERPRETACION' 
);
$pdf->Ln ( 5 );*/
//$pdf->TablaColores ( $header, $razon, $ktno, $pruebaa, $pri, $prc, $prp, $nend, $cend, $mbruto, $mopera, $mneto, $roa, $roe, $zscore, $aope, $afina );

$pdf->Ln ( 110 );
$pdf->SetLeftMargin ( 10 );
$pdf->SetFontSize ( 12 );

// Lo mismo que en la variable anterior, decodificamos la variable $html para que el texto se vea correctamente con los acentos y las ÃƒÂ± correspondientes.
$file = 'pdf/' . $nit . ".pdf";

// Con OutPut hacemos que se visualice el PDF que acabamos de crear
$pdf->Output($file,'F');
$pdf->Output ();

// //////////////////////////////////////////////////////
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	$file = $path . $filename;
	$file_size = filesize ( $file );
	$handle = fopen ( $file, "r" );
	$content = fread ( $handle, $file_size );
	fclose ( $handle );
	$content = chunk_split ( base64_encode ( $content ) );
	$uid = md5 ( uniqid ( time () ) );
	$name = basename ( $file );
	$header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
	$header .= "Reply-To: " . $replyto . "\r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
	$header .= "This is a multi-part message in MIME format.\r\n";
	$header .= "--" . $uid . "\r\n";
	$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	$header .= $message . "\r\n\r\n";
	$header .= "--" . $uid . "\r\n";
	$header .= "Content-Type: Content-Type: application/pdf; name=\"" . $filename . "\"\r\n"; // use different content types here
	$header .= "Content-Transfer-Encoding: base64\r\n";
	$header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
	$header .= $content . "\r\n\r\n";
	$header .= "--" . $uid . "--";
	if (mail ( $mailto, $subject, "", $header )) {
		echo "mail send ... OK"; // or use booleans here
	} else {
		echo "mail send ... ERROR!";
	}
}

$my_file = "pdf/" . $nit . ".pdf"; // puede ser cualquier formato
/*
 * $my_path = $_SERVER['DOCUMENT_ROOT']."/apppro/pdf"; $my_name = "Proyekta Analyzer"; $my_mail = "admin@proyekta.com.co"; $my_replyto = "sorimimend@gmail.com"; $my_subject = "Proyekta Analyzer - Informe de empresa."; $my_message = "Proyekta Analyzer - Informe de empresa."; mail_attachment($my_file, $my_path, $_SESSION['EMAIL_USUARIO'], $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
 */
$my_mail = new attach_mailer ( $name = 'Proyekta Analyzer', $from = 'admin@proyekta.com.co', $to = $_SESSION ['EMAIL_USUARIO'], $cc = "sorimimend@gmail.com", $bcc = "", $subject = 'Proyekta Analyzer - Informe de empresa.', $body = 'Proyekta Analyzer - Informe de empresa.' );
$my_mail->create_attachment_part ( $my_file );
$my_mail->process_mail ();

$msg .= $my_mail->get_msg_str ();

// echo $msg;

// borra archivo
unlink('grafico.png');
unlink('afina.png');
unlink('aope.png');
unlink('cend.png');
unlink('ktno.png');
unlink('mbruto.png');
unlink('mneto.png');
unlink('mopera.png');
unlink('nend.png');
unlink('prc.png');
unlink('pri.png');
unlink('prp.png');
unlink('pruebaa.png');
unlink('roa.png');
unlink('roe.png');
unlink('zs.png');

unlink ( $my_file );

echo '<script>
	
		window.location.href = "javascript:window.history.back();";
	
</script>';
?>
 
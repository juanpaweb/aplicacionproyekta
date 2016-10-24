<?php
include 'config/config.php';

/* Extrae los valores enviados desde la aplicacion movil */
$categoria = $_GET ['categoriae'];
$indicador = $_GET ['indicadore'];
$nit = $_GET ['nit'];

// retorna info de la base de datos

$conexion = conectar ( "indicadores" );

// años existentes
$sql = "SELECT anio FROM anios ";

$resultado = ejecutar ( $sql, $conexion );

while ( $campos = mysql_fetch_row ( $resultado ) ) {
	if ($campos != null) {
		$anios [] = $campos [0];
	}
}

if ($categoria == 1) {
	$tbla = "liq_";
	switch ($indicador) {
		
		case 1 :
			$campo = 'capital_de_trabajo';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 2 :
			$campo = 'KTNO';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 3 :
			$campo = 'razon_corriente';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 4 :
			$campo = 'prueba_acida_inventarios';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 5 :
			$campo = 'prueba_acida_cartera';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 6 :
			$campo = 'pri';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 7 :
			$campo = 'prc';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 8 :
			$campo = 'prp';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 9 :
			$campo = 'ciclo_caja';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 10 :
			$campo = 'ciclo';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 11 :
			$campo = 'cantidad_min_efectivo';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
	}
} elseif ($categoria == 2) {
	$tbla = "end_";
	switch ($indicador) {
		
		case 1 :
			$campo = 'Nivel_Endeundamiento';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 2 :
			$campo = 'Nivel_Endeundamiento_sin_Valoriz';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 3 :
			$campo = 'Nivel_Endeundamiento_CXP_Socios_Sup1';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 4 :
			$campo = 'Nivel_Endeundamiento_CXP_Socios_Sup2';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 5 :
			$campo = 'Concentracion_endeuda_corto';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 6 :
			$campo = 'Impacto_Carga_Financiera';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 7 :
			$campo = 'Cobertura_Intereses';
			$simbolo = "<%=value%>";
			$formato = "v";
			break;
		case 8 :
			$campo = 'Endeudamiento_Financiero';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
	}
} elseif ($categoria == 3) {
	$tbla = "rent_";
	switch ($indicador) {
		
		case 1 :
			$campo = 'Margen_bruto';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 2 :
			$campo = 'Margen_Operacional';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 3 :
			$campo = 'Margen_Neto';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 4 :
			$campo = 'ROA';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
		case 5 :
			$campo = 'ROE';
			$simbolo = "<%= value +' %'  %> ";
			$formato = "p";
			break;
	}
} elseif ($categoria == 4) {
	$tbla = "cyg_";
	switch ($indicador) {
		
		case 1 :
			$campo = 'Activos_Netos_Operacion';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 2 :
			$campo = 'EBITDA';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 3 :
			$campo = 'NOPAT';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 4 :
			$campo = 'Margen_EBITDA';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 5 :
			$campo = 'Crecimiento_vtas';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 6 :
			$campo = 'Cobertura_Ebitda';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			
			break;
		case 7 :
			$campo = 'Indice_ret_utilidades';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			
			break;
		case 8 :
			$campo = 'Tasa_crec_iterno';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 9 :
			$campo = 'Tasa_crec_sust';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 10 :
			$campo = 'Apalancamiento_Operacional';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			
			break;
		case 11 :
			$campo = 'Apalancamiento_financiero';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 12 :
			$campo = 'Punto_Equilibrio';
			$simbolo = "<%= ' $' + value/1000000 +'M'  %> ";
			$formato = "m";
			break;
		case 13 :
			$campo = 'Z_SCORE';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
		case 14 :
			$campo = 'BRIEF';
			$simbolo = "<%= value   %> ";
			$formato = "v";
			break;
	}
}

// Fabrica consulta

foreach ( $anios as $val ) {
	if ($categoria == 1) {
		$consulta [] = "SELECT '" . $val . "' AS anio," . $campo . " FROM  " . $tbla . $val . " WHERE nit = " . $nit;
	} else {
		$tab = substr ( $val, 2 );
		$consulta [] = "SELECT '" . $val . "' AS anio," . $campo . " FROM  " . $tbla . $tab . " WHERE nit = " . $nit;
	}
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

// ejecuta consulta
$sqlLiq = $final;

$resultadoLiq = ejecutar ( $sqlLiq, $conexion );

while ( $camposLiq = mysql_fetch_row ( $resultadoLiq ) ) {
	
	$x [] = $camposLiq [0];
	$y [] = $camposLiq [1];
}
$j = 1;
foreach ( $x as $val3 ) {
	if (count ( $x ) == $j) {
		$cadena .= '"' . $val3 . '"';
	} else {
		$cadena .= '"' . $val3 . '",';
	}
	$j ++;
}
// /formato valores
if ($formato == "p") {
	$maximo = max ( $y ) . " %";
	$mediana = medianac ( $y ) . " %";
	$minimo = min ( $y ) . " %";
} elseif ($formato == "m") {
	setlocale ( LC_MONETARY, 'es_CO' );
	$maximo = money_format ( '%(#10n', max ( $y ) );
	$mediana = money_format ( '%(#10n', medianac ( $y ) );
	$minimo = money_format ( '%(#10n', min ( $y ) );
} elseif ($formato == "v") {
	$maximo = max ( $y );
	$mediana = medianac ( $y );
	$minimo = min ( $y );
}
// fin formato
$resultados = array ();
$resultados ["total"] = 4;
$resultados ["cx"] = $x;
$resultados ["cy"] = $y;
$resultados ["max"] = $maximo;
$resultados ["med"] = $mediana;
$resultados ["min"] = " " . $minimo;
$resultados ["simbolo"] = $simbolo;
$resultados ["nombre"] = nombres ( $categoria, $indicador );
$resultados ["nindica"] = $simbolo;
$resultados ["mensaje"] = "ya casi!!!";
$resultados ["validacion"] = "ok";
/* convierte los resultados a formato json */
$resultadosJson = json_encode ( $resultados );

/* muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET ['jsoncallback'] . '(' . $resultadosJson . ');';

// ///////////////////////////////////////////////////////////////////////////////////////////////////////////
// CALCULO DE LA MEDIANA
function medianac($datos) {
	sort ( $datos );
	$cantidad = count ( $datos );
	$posMediana = ($cantidad + 1) / 2;
	$medtipo = $datos [2];
	
	return $medtipo;
}
function nombres($cate, $indi) {
	if ($cate == 1) {
		$ncategoria = "Liquidez-";
		switch ($indi) {
			
			case 1 :
				$nindicador = 'Capital de Trabajo';
				break;
			case 2 :
				$nindicador = 'KTNO';
				break;
			case 3 :
				$nindicador = 'Razon Corriente';
				
				break;
			case 4 :
				$nindicador = 'Prueba Acida Inventarios';
				
				break;
			case 5 :
				$nindicador = 'Prueba Acida Cartera';
				
				break;
			case 6 :
				$nindicador = 'PRI';
				
				break;
			case 7 :
				$nindicador = 'PRC';
				
				break;
			case 8 :
				$nindicador = 'PRP';
				
				break;
			case 9 :
				$nindicador = 'Ciclo Caja';
				
				break;
			case 10 :
				$nindicador = 'Ciclo';
				
				break;
			case 11 :
				$nindicador = 'Cantidad Min Efectivo';
				break;
		}
	} elseif ($cate == 2) {
		$ncategoria = "Endeudamiento -";
		switch ($indi) {
			
			case 1 :
				$nindicador = 'Nivel Endeundamiento';
				
				break;
			case 2 :
				$nindicador = 'Nivel Endeundamiento sin Valoriz';
				
				break;
			case 3 :
				$nindicador = 'Nivel Endeundamiento CXP Socios Sup1';
				
				break;
			case 4 :
				$nindicador = 'Nivel Endeundamiento CXPSocios Sup2';
				
				break;
			case 5 :
				$nindicador = 'Concentracion Endeudamiento corto plazo';
				
				break;
			case 6 :
				$nindicador = 'Impacto Carga Financiera';
				
				break;
			case 7 :
				$nindicador = 'Cobertura Intereses';
				
				break;
			case 8 :
				$nindicador = 'Endeudamiento Financiero';
				
				break;
		}
	} elseif ($cate == 3) {
		$ncategoria = "Rentabilidad - ";
		switch ($indi) {
			
			case 1 :
				$nindicador = 'Margen Bruto';
				
				break;
			case 2 :
				$nindicador = 'Margen Operacional';
				
				break;
			case 3 :
				$nindicador = 'Margen Neto';
				
				break;
			case 4 :
				$nindicador = 'ROA';
				
				break;
			case 5 :
				$nindicador = 'ROE';
				
				break;
		}
	} elseif ($cate == 4) {
		$ncategoria = "CORPORATIVOS y/o GERENCIALES -";
		switch ($indi) {
			
			case 1 :
				$nindicador = 'Activos Netos Operacion';
				
				break;
			case 2 :
				$nindicador = 'EBITDA';
				
				break;
			case 3 :
				$nindicador = 'NOPAT';
				
				break;
			case 4 :
				$nindicador = 'Margen EBITDA';
				
				break;
			case 5 :
				$nindicador = 'Crecimiento en ventas';
				
				break;
			case 6 :
				$nindicador = 'Cobertura EBITDA';
						
				break;
			case 7 :
				$nindicador = 'Indice de retencion de utilidades';
				
				break;
			case 8 :
				$nindicador = 'Tasa de crecimiento interno';
				
				break;
			case 9 :
				$nindicador = 'Tasa de crecimiento sustentable';
				
				break;
			case 10 :
				$nindicador = 'Apalancamiento Operacional';
				
				break;
			case 11 :
				$nindicador = 'Apalancamiento Financiero';
				
				break;
			case 12 :
				$nindicador = 'Punto de Equilibrio';
				
				break;
			case 13 :
				$nindicador = 'Z_SCORE';
				
				break;
			case 14 :
				$nindicador = 'BRIEF';
				
				break;
		}
	}
	
	return $ncategoria . " " . $nindicador;
}

?>
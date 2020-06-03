<html>
<head>
	<title>TAREA 12</title>
	<body>
		<h2><center >
			<font size=6 color="red">M&Eacute;TODOS NUM&Eacute;RICOS</font>
		</center></h2>
		<h2><center >
			<font size=5 color="purple"><b>INTERPOLACI&Oacute;N POR SPLINES C&Uacute;BICOS</b></font>
		<center ></h2>
		<table>
		<form method="get" name="form1" action="">
			<tr>
				<td colspan="2">
					<input type="submit" name="boton" value="Generar">
				</td>
			</tr>
			</form>
			</table>

			<?php 

				function mostrarMatriz($matriz, $n){

					echo '<table border="1px" style = "table-layout:fixed"> ';	
					for($i = 0; $i < $n; $i++ ){
						echo "<tr>";
						for($j = 0; $j < $n; $j++){
							echo "<td align = center>".$matriz[$i][$j]."</td>";
						}	
					}
					echo "</tr>";
					echo "</table></br>";
				}

				function mostrarArreglo($arreglo, $n){

					echo '<table width="10%" border="1px" style = "table-layout:fixed"> ';
					for($i = 0; $i < $n; $i++){
						echo "<tr>";
						echo "<td align = center>".$arreglo[$i]."</td>";
					}
					echo "</table></br>";;
				}

				function eliminacionGaussiana($matAux1, $b1, $n){

					$m = 0;

					for($k = 0; $k < $n - 1; $k++){
				    	for($i = $k + 1; $i < $n; $i++){
				    		$m = (($matAux1[$i][$k]) / ($matAux1[$k][$k]));
				    		for($j = $k ; $j < $n ; $j++){
				    			$matAux1[$i][$j] = $matAux1[$i][$j] - $m * $matAux1[$k][$j];
				    		}
				    		$b1[$i] = $b1[$i] - $m * $b1[$k]; 
				    	}
				    }

				    for($l = $n - 1; $l >= 0; $l--){
				    	$suma = 0;
				    	for($j = $l + 1; $j < $n; $j++){
				    		$suma += $matAux1[$l][$j] * $b1[$j];
				    	}
				    	$b1[$l] = (($b1[$l] - $suma) / ($matAux1[$l][$l]));
				    }

				    return $b1;

				}	

				function hi($x, $n){

					for($i = 1; $i < $n; $i++){

						$hi[] = $x[$i] - $x[$i-1];
					}

					return $hi;

				}

				function variableI($y, $n){

					for($i = 1; $i < $n; $i++){

						$zi[] = $y[$i] - $y[$i-1];
					}

					return $zi;
				}

				function landaI($h, $n){
					
					for($i = 0; $i < $n - 2; $i++){

						$li[] = ($h[$i+1])/($h[$i] + $h[$i+1]);
					}

					return $li;
				}

				function ui($h, $n){
					
					for($i = 0; $i < $n - 2; $i++){

						$ui[] = ($h[$i+1])/($h[$i] + $h[$i+1]);
					}

					return $ui;
				}

				function di($z, $h, $n){

					for($i = 0; $i < $n-2; $i++){

						$di[] = (6*($z[$i+1] - $z[$i]))/($h[$i] + $h[$i+1]);
					}

					return $di;
				}

				function matrizTridiagonL($l, $u, $n){

					for($i = 0; $i < $n-2 ; $i++){
						$mat[$i][$i] = 2;
						for($j = 0; $j < $n-2; $j++){

							if($i == $j){
								continue;
							}
						}
					}

					$mat[0][1] = $l[0];
					$mat[0][2] = 0 ;
					$mat[1][0] = $u[1];
					$mat[1][2] = $l[1];
					$mat[2][0] = 0;
					$mat[2][1] = $u[2]; 

					return $mat;

				}

				function ri($m, $h, $n){

					for($i = 1; $i < $n; $i++){
						$r[] = $m[$i-1] / 6*$h[$i-1];
					}

					return $r;
				}

				function si($m, $h, $n){

					for($i = 1; $i < $n; $i++){
						$s[] = $m[$i] / 6*$h[$i-1];
					}

					return $s;

				}

				function ti($y, $m, $h, $n){

					for($i = 1; $i < $n; $i++){
						$t[] = ($y[$i-1] - (($m[$i-1]) * ($h[$i-1]*$h[$i-1])/6)) / $h[$i-1];
					}

					return $t;
				}

				function vi($y, $m, $h, $n){

					for($i = 0; $i < $n-1; $i++){
						$v[] = ($y[$i+1] - (($m[$i+1]) * ($h[$i]*$h[$i])/6)) / $h[$i];
					}

					return $v;
				}

				function Vi2($s, $r, $n){

					for($i = 0; $i < $n-1; $i++){
						$V[] = $s[$i] - $r[$i];
					}
					return $V;
				}

				function wi($r, $x, $s, $n){

					for($i = 0; $i < $n-1; $i++){
						$w[] = 3*($r[$i]*$x[$i+1] - $s[$i]*$x[$i]);
					}
					return $w;
				}

				function fi($s, $x, $r, $v, $t, $n){

					for($i = 0; $i < $n-1; $i++){
						$f[] = 3*($s[$i]*$x[$i]*$x[$i] - $r[$i]*$x[$i+1]*$x[$i+1]) + $v[$i] - $t[$i];
					}
					return $f;

				}

				function gi($x, $r, $t, $s, $v, $n ){

					for($i = 0; $i < $n-1; $i++){
						$g[] = $x[$i+1]*($r[$i]*$x[$i+1]*$x[$i+1] + $t[$i]) - $x[$i]*($s[$i]*$x[$i]*$x[$i] + $v[$i]);
					}
					return $g;

				}

				function mostrarP($v, $x, $w, $f, $g, $n){

					for($i = 0; $i < $n-1; $i++){
						echo  "P3 [".($i+2) ."] = ( $v[$i] X^3 ) + ( $w[$i] X^2 ) + ( $f[$i] X ) + ( $g[$i] ) ";
						echo "</br></br>";
					}
				}


				////////////////////////////

				$archivo = fopen("Tarea13_Entrada.txt", "r");

				if($archivo == NULL)
					echo "No se pude leer el archivo </br>";
				

				$numColumnas = 3;
				$numFilas = 3;

				while(!feof($archivo)){
					
					$linea  = fgets($archivo);
					$token = strtok($linea, ",");

					while($token !== false){
						$variable[] = trim($token);
						$token =  strtok(",");
					}
				}
				fclose($archivo);

				$tamanio = sizeof($variable);
				$posicion = array_search("b", $variable);

				for($i = 0; $i < $posicion; $i++){
					$x[] = $variable [$i];
				}


				for($i = $posicion + 1; $i < $tamanio; $i++){
					$y[] = $variable[$i];
				}


		    	if(isset($_GET['boton'])){

		    		$n = sizeof($x);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores hi</b></font><br/>';
					echo "<br/>";
		    		$hi = hi($x, $n);
		    		mostrarArreglo($hi, $n-1);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores ^i</b></font><br/>';
					echo "<br/>";
		    		$zi = variableI($y, $n);
		    		mostrarArreglo($zi, $n-1);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores Landai</b></font><br/>';
					echo "<br/>";
		    		$li = landaI($hi, $n);
		    		mostrarArreglo($li, $n-2);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores Ui</b></font><br/>';
					echo "<br/>";
		    		$ui = ui($hi, $n);
		    		mostrarArreglo($ui, $n-2);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores di</b></font><br/>';
					echo "<br/>";
		    		$di = di($zi, $hi, $n);
		    		mostrarArreglo($di, $n-2);

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>MATRIZ TRIDIAGONAL</b></font><br/>';
					echo "<br/>";
		    		echo "<table border='0' >";
		    		$tamMat = sizeof($ui);
		    		$matriz =  matrizTridiagonL($li, $ui, $n);
		    		echo "<td><b>";
		    		mostrarMatriz($matriz, $tamMat);
		    		echo "</b></td>";
					echo "<td></td>";

					echo "<td><b>";
					echo " * </br></br>";
					echo "</b><td>";
					echo "<td></td><td></td><td></td>";

					echo "<td>";
					echo "[M2]</br></br>";
					echo "[M3]</br></br>";
					echo "[M4]</br></br>";
					echo "<td>";				

					echo "<td></td><td></td><td></td>";
					echo "<td><b>";
					echo " = </br></br>";
					echo "</b><td>";
					echo "<td></td><td></td><td></td>";

					echo "<td><b>";
					mostrarArreglo($di, $tamMat);
					echo "</b></td>";
					echo "</table>";	
		    		echo "</br>";

		    		$mi = eliminacionGaussiana($matriz, $di, $tamMat);
		    		for($m = 0; $m < $n; $m++){
		    			if($m == 0){
		    				$Mi[$m] = 0; 
		    			}else if($m == $n-1){
		    				$Mi[$m] = 0; 
		    			}else{
		    				$Mi[$m] = $mi[$m-1];
		    			}
		    		}

		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores Mi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($Mi, $n);

		  
		    		$ri = ri($Mi, $hi, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores ri</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($ri, $n-1);


		    		$si = si($Mi, $hi, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores si</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($si, $n-1);


					$ti = ti($y, $Mi, $hi, $n);
					echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores ti</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($ti, $n-1);


		    		$vi = vi($y, $Mi, $hi, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores vi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($vi, $n-1);

		    		$Vi = Vi2($si, $ri, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores Vi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($Vi, $n-1);


		    		$wi = wi($ri, $x, $si, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores wi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($wi, $n-1);


		    		$fi = fi($si, $x, $ri, $vi, $ti, $n);
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores fi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($fi, $n-1);


		    		$gi = gi($x, $ri, $ti, $si, $vi, $n );
		    		echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="green"><b>Valores gi</b></font><br/>';
					echo "<br/>";
					mostrarArreglo($gi, $n-1);

					echo "<br/>";
		    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=5 color="blue"><b>Ecuaciones Finales</b></font><br/>';
					echo "<br/>";
		    		mostrarP($Vi, $x, $wi, $fi, $gi, $n);
		    		
			    }

			?>
		
	</body>
	</head>
</html>
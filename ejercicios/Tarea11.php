<html>
<head>
	<title>TAREA 11</title>
	<body>
		<h2><center >
			<font size=6 color="red">M&Eacute;TODOS NUM&Eacute;RICOS</font>
		</center></h2>
	
		<table>
			<form method="get" name="form1" action="">
			<tr> 
		        <td>   Elija el metodo: </td>
			    <td>   <select name="opcion">
			    	   <option value="2" selected> Algoritmo de Thomas</option>
			    	   <option value="3" selected> Newton Multivariable</option>
                       <option value="1" selected> Seleccione</option>
                </select> 
                </td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="boton" value="Generar">
				</td>
			</tr>
			</form>
			</table>

			<?php 

				function mostrarMatriz($matriz, $n){

					echo '<table width="30%" border="1px" style = "table-layout:fixed"> ';	
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


				$archivo = fopen("Tarea11_entrada.txt", "r");

				if($archivo == NULL)
					echo "No se pude leer el archivo </br>";
				
				$numLineas = 0;
				$numLineas = count(file("tarea11_entrada.txt"));
				$numLineas = $numLineas - 2;

				$numColumnas = $numLineas;
				$numFilas = $numLineas;

				while(!feof($archivo)){
					
					$linea  = fgets($archivo);
					$token = strtok($linea, ",");

					while($token !== false){
						$variable[] = trim($token);
						$token =  strtok(",");
					}
				}
				fclose($archivo);

				//print_r($variable);

				$tamanio = sizeof($variable);
				$posicion = array_search("b", $variable);

				for($i = 0; $i < $posicion; $i++){
					$matrizAux[] = $variable [$i];
				}

				for($i = $posicion + 1; $i < $tamanio; $i++){
					$mult[] = $variable[$i];
				}

	
		    	if(isset($_GET['boton'])){


				    $opcion=$_GET['opcion'];

			    	
			    	if($opcion == 2){

			    		echo "<br/>";
					   	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=5 color="blue"><b>Matriz Tridiagonal</b></font><br/>';
					   	echo "<br/>";

						echo "<table border='0' >";

						$pos = 0;
						for($i = 0; $i < $numFilas; $i++ ){
							for($j = 0; $j < $numColumnas; $j++){
								$matriz[$i][$j] = $matrizAux[$pos];
								$pos++;
							}
						}

						echo "<td><b>";
						for($i = 0; $i < $numFilas; $i++ ){
							for($j = 0; $j < $numColumnas; $j++){
								echo "[".$matriz[$i][$j]."]&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</br></br>";
						}
						echo "</b></td>";
						echo "<td></td>";

						echo "<td><b>";
						echo " * </br></br>";
						echo "</b><td>";
						echo "<td></td><td></td><td></td>";

						echo "<td>";
						echo "<b>[X1]</b></br></br>";
						echo "<b>[X2]</b></br></br>";
						echo "<b>[X3]</b></br></br>";
						echo "<b>[X4]</b></br></br>";
						echo "<td>";				

						echo "<td></td><td></td><td></td>";
						echo "<td><b>";
						echo " = </br></br>";
						echo "</b><td>";
						echo "<td></td><td></td><td></td>";

						echo "<td><b>";
						$size = sizeof($mult);
						for($i = 0; $i < $size; $i++){
							echo "[".$mult[$i]."]</br></br>";
						}
						echo "</b></td>";
						echo "</table>";	
				    	echo "</br>";

				    	$n = sizeof($matriz);

				    	for($f = 0; $f < $numFilas; $f++){
					    	for($c = 0; $c < $numColumnas; $c++){
					    		$a[$f][$c] = $matriz[$f][$c];
					    		$a2[$f][$c] = $matriz[$f][$c];
					    	}
					    	$b[$f] = $mult[$f];
					    }

					    for($i = 1; $i < $n; $i++){
				           
				            $a[$i][$i] = $a[$i][$i] - ($a[$i][$i-1]*$a[$i-1][$i])/$a[$i-1][$i-1];
				            $b[$i] = $b[$i] - ($a[$i][$i-1]*$b[$i-1])/$a[$i-1][$i-1];
				            $a[$i][$i-1] = 0;
				        }

				        $x[$n-1] = $b[$n-1]/$a[$n-1][$n-1];
				         
				        for($k = $n-2; $k >= 0; $k--){

				            $x[$k] = ($b[$k]-$a[$k][$k+1]*$x[$k+1])/$a[$k][$k];
				         
				         }

				         echo "</br>";
						 echo '&nbsp;<font size=4 color="teal"><b>Resultado Final</b></font><br/>';
						 echo "<br/>";
				         mostrarArreglo($x, $n);



			    	}else if($opcion == 3){

			    		/*echo "<br/>";
			   			echo "<br/>";
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="purple"><b>DESCOMPOSICIÓN L.U.</b></font><br/>';
						echo "<br/>";

						$m = 0;

						echo '&nbsp;<font size=4 color="teal"><b>Valores de M[i][k]</b></font><br/>';
						echo "</br>";
						for($k = 0; $k < $n - 1; $k++){
							$L[$k][$k] = 1;
							for($i = $k + 1; $i < $n; $i++){
								$m = (($matAux2[$i][$k]) / ($matAux2[$k][$k]));
								echo "<font size=3><b>&nbsp;&nbsp;&nbsp;M[$i][$k]&nbsp;: &nbsp;</b>".$m."</font></br>";
								$L[$i][$k] = $m;
								//$L[0][$k] = 0;
								for($j = $k; $j < $n; $j++){
									$U[0][$j] = $matAux2[0][$j];
									$U[$i][$j] = $matAux2[$i][$j] - $m * $matAux2[$k][$j];
								} 
								$b2[$i] = $b2[$i] - $m * $b2[$k]; 
							}
						}

						$L[$n-1][$n-1] = 1;
						for($i = 0; $i < $n ; $i++){
							for($j = $i + 1; $j < $n; $j++){
								$L[$i][$j] = 0;
							}
						}
						echo "</br>";
						echo '&nbsp;<font size=4 color="Green"><b>Matriz Triangular U</b></font><br/>';
						echo "<br/>";
						mostrarMatriz($U, $n);
						echo '&nbsp;<font size=4 color="Green"><b>Matriz Triangular L</b></font><br/>';
						echo "<br/>";
						mostrarMatriz($L, $n);
						echo '&nbsp;<font size=4 color="Green"><b>Matriz B</b></font><br/>';
						echo "<br/>";
						mostrarArreglo($b2, $n);

						for($l = $n - 1; $l >= 0; $l--){
				    		$suma = 0;
				    		for($j = $l + 1; $j < $n; $j++){
				    			$suma += $U[$l][$j] * $b2[$j];
				    		}
				    		$b2[$l] = (($b2[$l] - $suma) / ($U[$l][$l]));
				    	}

				    	echo '&nbsp;<font size=4 color="Green"><b>Resultado Final</b></font><br/>';
						echo "<br/>";
				    	mostrarArreglo($b2, $n);				
						
			    	*/}
		    		
			    }

			?>
		
	</body>
	</head>
</html>
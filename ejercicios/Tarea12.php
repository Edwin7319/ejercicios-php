<html>
<head>
	<title>TAREA 12</title>
	<body>
		<h2><center >
			<font size=6 color="red">M&Eacute;TODOS NUM&Eacute;RICOS</font>
		</center></h2>
		<table>
		<form method="get" name="form1" action="">
			<tr>
                <td>
                    Xo:
                </td>
                <td>
                    <input type="text" name="Xo" value="<?php if(isset($_GET['Xo'])) echo $_GET['Xo'];?>">
                </td>
                <td>
                    Yo:
                </td>
                <td>
                    <input type="text" name="Yo" value="<?php if(isset($_GET['Yo'])) echo $_GET['Yo'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    X:
                </td>
                <td>
                    <input type="text" name="X" value="<?php if(isset($_GET['X'])) echo $_GET['X'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    X1:
                </td>
                <td>
                    <input type="text" name="X1" value="<?php if(isset($_GET['X1'])) echo $_GET['X1'];?>">
                </td>
                <td>
                    Y1:
                </td>
                <td>
                    <input type="text" name="Y1" value="<?php if(isset($_GET['Y1'])) echo $_GET['Y1'];?>">
                </td>
            </tr>
			<tr> 
		        <td>   Elija el metodo: </td>
			    <td>   <select name="opcion">
			    	   <option value="2" selected> Interpolacion Lineal</option>
			    	   <option value="3" selected> Interpolacion Cuadratica</option>
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

				function interpolacionCuadratica($x){

					$n = sizeof($x);
					$aux = 0;

					for($i = 0; $i < $n; $i++){

						$aux = 0;
						while($aux < 3){
							$p2[] = pow($x[$i], $aux);
							$aux++;
						}
					}

					return $p2;
				}


				$archivo = fopen("Tarea12_Entrada.txt", "r");

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


				    $opcion=$_GET['opcion'];
			    	
			    	
			    	
			    	if($opcion == 2){

			    		$Xo = $_GET['Xo'];
			    		$Yo = $_GET['Yo'];
			    		$X = $_GET['X'];
			    		$X1 = $_GET['X1'];
			    		$Y1 = $_GET['Y1'];

			    		echo '</br><font size=4 color="purple"><b>VALORES INGRESADOS</b></font><br/>';
			    		echo '</br></br><font size=4 color="teal"><b>INTERPOLACION LINEAL</b></font></br>';
			    		echo '<table BORDER = "1">';
			    		echo "<tr>";
			    		echo '<td WIDTH="70">';
			    		echo "Xo = ".$Xo;
			    		echo "</td>";
			    		echo '<td WIDTH="70">';
			    		echo "Yo = ".$Yo;
			    		echo "</td>";
			    		echo "</tr>";
			    		echo "<tr>";
			    		echo '<td WIDTH="70">';
			    		echo "X = ".$X;
			    		echo "</td>";
			       		echo '<td WIDTH="70">';
			    		echo "Y = ?";
			    		echo "</td>";
			       		echo "</tr>";
			    		echo "<tr>";
			    		echo '<td WIDTH="70">';
			    		echo "X1 = ".$X1;
			    		echo "</td>";
			    		echo '<td WIDTH="70">';
			    		echo "Y1 = ".$Y1;
			    		echo "</td>";
			    		echo "</tr>";
			    		echo '</table>';

			    		$Y = $Yo + (($Y1 - $Yo)/($X1-$Xo)) * ($X - $Xo);

			    		echo '</br></br><font size=4 color="teal"><b>Respuesta:</b></font>';
			    		echo '&nbsp;&nbsp;<font size=5 color="red"><b>'.$Y.'</b></font>';
			    		
			    	}else if($opcion == 3){

			    		$n = sizeof($y);

						echo "<br/>";
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="purple"><b>X[k]</b></font><br/>';
				 		mostrarArreglo($x, $n);
				 		echo "<br/>";
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="purple"><b>Y[k]</b></font><br/>';
			    		echo '<table style="width:100%">';
			    		mostrarArreglo($y, $n);
			  
			    		$pos = 0;

			    		$p = interpolacionCuadratica($x);

			    		for($i = 0; $i < $n; $i++){
			    			for($j = 0; $j < $n; $j++){
			    				$matriz[$i][$j] = $p[$pos];
			    				$pos++;
			    			}
			    		}

			    		echo "<br/>";
			    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="purple"><b>Matriz Generada por valores de P(xi)</b></font><br/>';
			    		mostrarMatriz($matriz, $n);
			    
			    		$b = eliminacionGaussiana($matriz, $y, $n);

			    		echo "<br/>";
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=4 color="purple"><b>RESPUESTA</b></font><br/>';
			    		mostrarArreglo($b, $n);
			    	}
		    		
			    }

			?>
		
	</body>
	</head>
</html>
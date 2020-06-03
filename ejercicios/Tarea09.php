<html>
<head>
	<title>TAREA 09</title>
	<body>
		<h2><center>
			M&Eacute;TODOS NUM&Eacute;RICOS
		</center></h2>
	
		<table>
			<form method="get" name="form1" action="">
			<tr>
				<td>
					Tolerancia:
				</td>
				<td>
					<input type="text" name="tol" value="<?php if(isset($_GET['tol'])) echo $_GET['tol'];?>">
				</td>
			</tr>
			<tr> 
		        <td>   Elija el metodo: </td>
			    <td>   <select name="opcion">
			    	   <option value="2" selected> Metodo GAUSS-JACOBI</option>
			    	   <option value="3" selected> Metodo GAUSS-SEIDEL</option>
			    	   <option value="4" selected> Metodo ROS</option>
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
				$archivo = fopen("Tarea09_entrada.txt", "r");

				if($archivo == NULL)
					echo "No se pude leer el archivo </br>";
				
				$numLineas = 0;
				$numLineas = count(file("tarea09_entrada.txt"));
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

				$tamanio = sizeof($variable);
				$posicion = array_search("b", $variable);

				for($i = 0; $i < $posicion; $i++){
					$matrizAux[] = $variable [$i];
				}

				for($i = $posicion + 1; $i < $tamanio; $i++){
					$mult[] = $variable[$i];
				}

				echo "<br/>";
			   	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VALORES INGRESADOS<br/>";
			   	echo "<br/>";

				echo "<table border='0' >";

				$pos = 0;
				for($i = 0; $i < $numFilas; $i++ ){
					for($j = 0; $j < $numColumnas; $j++){
						$matriz[$i][$j] = $matrizAux[$pos];
						$pos++;
					}
				}

				echo "<td>";
				for($i = 0; $i < $numFilas; $i++ ){
					for($j = 0; $j < $numColumnas; $j++){
						echo "[".$matriz[$i][$j]."]&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					echo "</br></br>";
				}
				echo "</td>";
				echo "<td></td>";

				echo "<td>";
				echo " * </br></br>";
				echo "<td>";
				echo "<td></td><td></td><td></td>";

				echo "<td>";
				echo "[X]</br></br>";
				echo "[Y]</br></br>";
				echo "[Z]</br></br>";
				echo "<td>";				

				echo "<td></td><td></td><td></td>";
				echo "<td>";
				echo " = </br></br>";
				echo "<td>";
				echo "<td></td><td></td><td></td>";

				echo "<td>";
				$size = sizeof($mult);
				for($i = 0; $i < $size; $i++){
					echo "[".$mult[$i]."]</br></br>";
				}
				echo "</td>";
				echo "</table>";	
		    	echo "</br>";


		    	if(isset($_GET['boton'])){

			    	$tolerancia = $_GET['tol'];
			    	$opcion=$_GET['opcion'];

			    	if($opcion == 2){
	
			    		echo "<br/>";
			   			echo "<br/>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TABLA METODO GAUSS-JACOBI<br/>";
						echo "<br/>";

				   		$conta = 1;
						
						$sumatoria [0] = 1 ;
						$sumatoria [1] = 1 ;
						$sumatoria [2] = 1 ;

						echo "<table border='0' >";
						echo "<td>Estimacion</br>Inicial K[0]</td>";
				     	echo "<td></td><td></td><td></td>";
				     	echo "<td>";
				     	for($f = 0; $f < $numFilas; $f++){
				     		echo "X[".($f+1)."] = $sumatoria[$f]</br>";
				     	}
						echo "<td>";
						echo "</table>";
						echo "</br></br>";

						echo "<table border='1' >";
				      	echo "<td bgcolor=yellow>K[i]</td>
		    		  	<td bgcolor=yellow>X[i]</td>
		      			<td bgcolor=yellow>ERROR</td>";

		      			$boolean1 = false;
		      			$tamSumatoria = sizeof($sumatoria);

						while($boolean1 === false){

							echo"<tr >";
					   		echo "<td>&nbsp;&nbsp;K[$conta]&nbsp;&nbsp;</td>";

				    		for($i = 0; $i < $numFilas ; $i++){
				    			$suma = 0;
				    			for($j = 0; $j < $numColumnas ; $j++){
				    				if($i === $j)
				    					continue;
				    				$suma += $matriz[$i][$j] * $sumatoria[$j];			    				
				    			}

				    			$respuesta [$i] = ((1/$matriz[$i][$i]) * ($mult[$i] - $suma));
				    			$auxiliar[$i] = $sumatoria[$i];
				    		}

				    		for($b = 0; $b < $numFilas; $b++ ){
				    			$error[$b] = abs(($respuesta[$b] - $auxiliar[$b])/$auxiliar[$b]);
				    		}

				    		$errorN = 0;
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			if($error[$b] < $tolerancia){
				    				$errorN ++;
				    			}
				    		}

				    		echo "<td>";
				    		for ($i = 0; $i < $numFilas ; $i++){
				    			$sumatoria [$i] = $respuesta [$i];
								echo "X[".($i+1)."] = $sumatoria[$i] </br>"; 
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			echo "X[".($b+1)."] = $error[$b] </br>";
				    		}
				    		echo "</td>";

				    		$conta ++;
				    		echo"<tr>";

				    		if($tamSumatoria == $errorN){
				    			$boolean1 = true;
				    		}
				   		}
			   			echo "</table>";

			   		}else if($opcion == 3){


			    		echo "<br/>";
			   			echo "<br/>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TABLA METODO GAUSS-SEIDEL<br/>";
						echo "<br/>";

						$contador = 1;
					   	$estimacion[0]=1;
				     	$estimacion[1]=1;
				     	$estimacion[2]=1;

				     	echo "<table border='0' >";
				     	echo "<td>Estimacion</br>Inicial K[0]</td>";
				     	echo "<td></td><td></td><td></td>";
				     	echo "<td>";
				     	for($f = 0; $f < $numFilas; $f++){
				     		echo "X[".($f+1)."] = $estimacion[$f]</br>";
				     	}
						echo "<td>";
						echo "</table>";
						echo "</br></br>";	

				     	echo "<table border='1' >";
				      	echo "<td bgcolor=green>K[i]</td>
		    		  	<td bgcolor=green>X[i]</td>
		      			<td bgcolor=green>ERROR</td>";

		      			$boolean2 = false;
		      			$tamEstimacion = sizeof($estimacion);
		      			$wo = 1.5;
		      			$wu = 0.5;

				   		while($boolean2 === false){

				   			$p=0;

				   			echo"<tr >";
					   		echo "<td>&nbsp;&nbsp;K[$contador]&nbsp;&nbsp;</td>";

				    		for($i = 0; $i < $numFilas ; $i++){
				    			$auxiliar[$i] = $estimacion[$i];
				    			$suma = 0;
				    			for($j = 0; $j < $numColumnas ; $j++){
				    				if($i === $j)
				    					continue;
				    				$suma += $matriz[$i][$j] * $estimacion[$j];		    				
				    			}

				    			$estimacion[$i] = ((1/$matriz[$i][$i]) * ($mult[$i] - $suma));
				    		}

				    		//echo "$estimacion[0] - $auxiliar[0] / $auxiliar[0] </br>";
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			$error[$b] = abs(($estimacion[$b] - $auxiliar[$b])/$auxiliar[$b]);
				    		}

				    		$errorN = 0;
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			if($error[$b] < $tolerancia){
				    				$errorN ++;
				    			}
				    		}

				    		echo "<td>";
				    		for ($i = 0; $i < $numFilas ; $i++){
				    			echo "X[".($i+1)."] = $estimacion[$i] </br>"; 
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			echo "X[".($b+1)."] = $error[$b] </br>";
				    		}
				    		echo "</td>";

				    		$contador ++;

				    		echo"<tr>";

				    		if($tamEstimacion == $errorN){
				    			$boolean2 = true;
				    		}

				    		}
				    		echo "</table>";
				   		} else if($opcion == 4){

				   		echo "<br/>";
			   			echo "<br/>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TABLA METODO ROS<br/>";
						echo "<br/>";

						$contador = 1;
					   	$estimacion[0]=1;
				     	$estimacion[1]=1;
				     	$estimacion[2]=1;

				     	echo "<table border='0' >";
				     	echo "<td>Estimacion</br>Inicial K[0]</td>";
				     	echo "<td></td><td></td><td></td>";
				     	echo "<td>";
				     	for($f = 0; $f < $numFilas; $f++){
				     		echo "X[".($f+1)."] = $estimacion[$f]</br>";
				     	}
						echo "<td>";
						echo "</table>";
						echo "</br></br>";	

				     	echo "<table border='1' >";
				      	echo "<td bgcolor=green>K[i]</td>
		    		  	<td bgcolor=green>X[i]</td>
		      			<td bgcolor=green>Sobrerelajacion W = 1.5</td>
		      			<td bgcolor=green>Subrelajacion W = 0.5</td>";

		      			$boolean2 = false;
		      			$tamEstimacion = sizeof($estimacion);
		      			$wo = 1.5;
		      			$wu = 0.5;

				   		while($boolean2 === false){

				   			$p=0;

				   			echo"<tr >";
					   		echo "<td>&nbsp;&nbsp;K[$contador]&nbsp;&nbsp;</td>";

				    		for($i = 0; $i < $numFilas ; $i++){
				    			$auxiliar[$i] = $estimacion[$i];
				    			$suma = 0;
				    			for($j = 0; $j < $numColumnas ; $j++){
				    				if($i === $j)
				    					continue;
				    				$suma += $matriz[$i][$j] * $estimacion[$j];		    				
				    			}

				    			$estimacion[$i] = ((1/$matriz[$i][$i]) * ($mult[$i] - $suma));
				    			$X1[$i] = ($wo * $estimacion[$i]) + ((1 - $wo) * $auxiliar[$i]);
				    			$X2[$i] = ($wu * $estimacion[$i]) + ((1 - $wu) * $auxiliar[$i]);
				    		}

				    		//echo "$estimacion[0] - $auxiliar[0] / $auxiliar[0] </br>";
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			$error[$b] = abs(($estimacion[$b] - $auxiliar[$b])/$auxiliar[$b]);
				    		}

				    		$errorN = 0;
				    		for($b = 0; $b < $numFilas; $b++ ){
				    			if($error[$b] < $tolerancia){
				    				$errorN ++;
				    			}
				    		}

				    		echo "<td>";
				    		for ($i = 0; $i < $numFilas ; $i++){
				    			echo "X[".($i+1)."] = $estimacion[$i] </br>"; 
				    		}
				    		echo "</td>";

				    		$contador ++;

				    		echo "<td>";
				    		for ($i = 0; $i < $numFilas ; $i++){
				    			echo "X[".($i+1)."] = $X1[$i] </br>"; 
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		for ($i = 0; $i < $numFilas ; $i++){
				    			echo "X[".($i+1)."] = $X2[$i] </br>"; 
				    		}
				    		echo "</td>";

				    		echo"<tr>";

				    		if($tamEstimacion == $errorN){
				    			$boolean2 = true;
				    		}

				    		}
				    		echo "</table>";
				   		}
				   	}

			?>
		
	</body>
	</head>
</html>
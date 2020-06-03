<html>
<head>
	<title>TAREA 07</title>
	<body>
		<h2><center>
			M&Eacute;TODO NUM&Eacute;RICOS
		</center></h2>
	
		<table>
			<form method="get" name="form1" action="">
			<tr>
				<td>
					Funci&oacute;n:
				</td>
				<td>
					<input type="text" name="Fx" value="<?php if(isset($_GET['Fx'])) echo $_GET['Fx']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					Cota Inferior (a):
				</td>
				<td>
					<input type="text" name="A" value="<?php if(isset($_GET['A'])) echo $_GET['A'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Cota Superior (b):
				</td>
				<td>
					<input type="text" name="B" value="<?php if(isset($_GET['B'])) echo $_GET['B'];?>">
				</td>
			</tr>
			<tr>
				<td>
					Tolerancia:
				</td>
				<td>
					<input type="text" name="tol" value="<?php if(isset($_GET['tol'])) echo $_GET['tol'];?>">
				</td>
			</tr>
			<tr> 
		        <td>   Escoja el metodo: </td>
			    <td>   <select name="opcion">
			    	   <option value="2" selected> Metodo Biseccion</option>
			    	   <option value="3" selected> Metodo Secante</option>
                       <option value="4" selected> Metodo Hibrido</option> 
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

			function funcion($x, $func){

			    $resultado=0;
			    $resultado=str_replace('x', '($x)', $func);
			    $resultado= str_replace('^', '**', $resultado);
			    $resultado= preg_replace('/(\d)(\()/i', "\\1*\\2", $resultado);
			    eval("\$resultado= ". $resultado .";");

			    return $resultado;                                         
		    }
 		 

 		 if(isset($_GET['boton'])){
     		
     		$cotaInf=$_GET['A'];
		    $cotaSup=$_GET['B'];
		    $tolerancia=$_GET['tol'];
		    $opcion=$_GET['opcion'];
		    

		   if($opcion==2){

			   	$maximoError=($cotaSup-$cotaInf)/2;
			   	$contador=1;
			   	$n=0;
			   	echo "<br/>";
			   	echo "TABLA DE RESULTADOS METODO DE BISECCION<br/>";
			   	echo "<br/>";
			   	$c=0;
			   	$s=0;
			
				echo "<table border='1' >";
	      	 	echo "<td bgcolor=yellow>N# Iteracion</td>
	      		<td bgcolor=yellow>valor de a</td>
	      	 	<td bgcolor=yellow>valor de c</td>
	      	 	<td bgcolor=yellow>valor de b</td>
	      	 	<td bgcolor=yellow>Posible Raiz</td>
	      		<td bgcolor=yellow>Error</td>";
			  
			  while(abs($maximoError)>$tolerancia){
			  	
			  	echo"<tr >";  

				$c=($cotaSup+$cotaInf)/2;
				$s=0;
				$s=funcion($c,$_GET['Fx']);

				echo 
				  "<td>$contador</td>
				  <td>$cotaInf</td>
				  <td> $c </td> 
				  <td>$cotaSup </td>";
				

				if((funcion($cotaSup,$_GET['Fx'])*funcion($c, $_GET['Fx']))<=0){

					echo 
					"<td>SI </td>";
					$cotaInf=$c;

				}else{
					echo 
					"<td>NO</td>";
					$cotaSup=$c;
				}
				
				echo "
				 <td>$maximoError </td>";
				 echo"<tr>";

				$maximoError=($cotaSup-$cotaInf)/2;
				$contador++;
		
				}
			
		    echo "</table>";	
		    echo "<br/>";

		   } elseif($opcion==3){

		   	echo "<br/>";
			echo "TABLA DE RESULTADOS METODO SECANTE<br/>";
			echo "<br/>";

		   	$error=10;
		   	$contador=1;
		   	$x0=$cotaInf;
		   	$x1=$cotaSup;

			echo "<table border='1' >";
	      	echo "<td bgcolor=yellow>N# Iteracion</td>
	      	<td bgcolor=yellow>valor de X(k-1)</td>
	      	<td bgcolor=yellow>valor de X(k)</td>
	      	<td bgcolor=yellow>valor de X(k+1)</td>
	      	<td bgcolor=yellow>Error</td>";

		   	while($error>$tolerancia){

		   		echo"<tr >";

		   		echo "<td>$contador</td>
				<td>$x0</td>
				<td> $x1 </td>";  

		   		if($contador<=15){
		   			$x2=$x1-((($x1-$x0)/(funcion($x1,$_GET['Fx'])-funcion($x0,$_GET['Fx'])))*funcion($x1,$_GET['Fx']));
		   			$error=abs(funcion($x2,$_GET['Fx']));
		   		
		   			$x0=$x1;
		   			$x1=$x2;

		   			echo "<td>$x2 </td>
		   		    <td>$error </td>";
		   		}else{
		   			$error=0;
		   			echo "<td>$x2 </td>
		   		    <td>No Converge </td>";
		   		}
		   		
		   		
				echo"<tr>";
		   		$contador++;
		   	}

		   } elseif($opcion==4){

		   	echo "<br/>";
			echo "TABLA DE RESULTADOS METODO HIBRIDO<br/>";
			echo "<br/>";

		   	$error=10;
		   	$contador=0;
		   	$ak=$cotaInf;
		   	$bk=$cotaSup;

			echo "<table border='1' >";
	      	echo "<td bgcolor=yellow>N# Iteracion</td>
	      	<td bgcolor=yellow>valor de a(k)</td>
	      	<td bgcolor=yellow>valor de b(k)</td>
	      	<td bgcolor=yellow>valor de c(k)</td>
	      	<td bgcolor=yellow>Error</td>";

		   	while($error>$tolerancia){

		   		echo"<tr >";

		   		echo "<td>$contador</td>
				<td>$ak</td>
				<td>$bk</td>";  

		   		$ck=$bk-((($bk-$ak)/(funcion($bk,$_GET['Fx'])-funcion($ak,$_GET['Fx'])))*funcion($bk,$_GET['Fx']));

		   		$error=abs(funcion($ck,$_GET['Fx']));
		   		
		   		if(abs(funcion($bk,$_GET['Fx'])*(funcion($ck,$_GET['Fx']))) <0 ) {
		   			$ak=$ck;
		   		}else{
		   			$bk=$ck;
		   		}

		   		echo "<td>$ck</td>
		   		<td>$error </td>";
		   		
				echo"<tr>";
		   		$contador++;
		   	}

		   }

	} 
		    

			?>
		
	</body>
	</head>
</html>
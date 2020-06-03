<html>
<head>
	<title>TAREA 06</title>
	<body>
		<h2><center>
			M&Eacute;TODO DE BISECCI&Oacute;N
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
			
			echo 	"Valor de la Funcion:  ".$s."<br/>" ;
		    echo "</table>";	
		    echo "<br/>";
		   // echo "VALOR DE RAIZ:  ".$c."<br/>";
		} 
		    

			?>
		
	</body>
	</head>
</html>
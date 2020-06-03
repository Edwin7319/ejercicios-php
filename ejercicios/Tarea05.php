<html>
<head>
	<title>TAREA 05</title>
	<body>
		<h2><center>
			M&Eacute;TODO CAMBIO DE SIGNO
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
					Subintervalos:
				</td>
				<td>
					<input type="text" name="inter" value="<?php if(isset($_GET['inter'])) echo $_GET['inter'];?>">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit" name="boton" value="Buscar">
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
		    $intervalos=$_GET['inter'];

		    if($intervalos%2==0){
		    	$intervalos++;
		    }
		 
		   $contador=1;
		   echo "<br/>";
		   echo "TABLA DE RESULTADOS<br/>";
		   echo "<br/>";
		
		 	echo "<table border='1' >";
      	 	echo "<td bgcolor=yellow>N# Intervalos</td>
      	 	<td bgcolor=yellow>f(k)</td>
      	 	<td bgcolor=yellow>f(k+1)</td>
      	 	<td bgcolor=yellow>Posible Raíz?</td>";
      	 	$h=($cotaSup-$cotaInf)/$intervalos;
		  
		  while($contador<=$intervalos){

		  	echo"<tr >";  

			$aux=$cotaInf+$h;

			$fk=funcion($cotaInf,$_GET['Fx']);
			$fk1=funcion($aux,$_GET['Fx']);

			 echo "<td>$contador</td>
			  <td>$fk </td>
			  <td>$fk1 </td>";

			if(($fk)*($fk1)<=0){
				echo "<td>Es una Posible Raíz </td>";
			}else{
				echo "<td>NO es una Posible Raíz </td>";
			}
			  echo"<tr>";
			 
			 	$cotaInf=$aux;
	
			 	$aux=$aux+$h;

			 	$contador++;
			
			}
	
		    


		}
		 echo "</table>";

			?>
		
	</body>
	</head>
</html>
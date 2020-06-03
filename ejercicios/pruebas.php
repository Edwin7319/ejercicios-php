<html>
<head>
	<title>TAREA 03</title>
	<body>
		<h2><center>
			M&Eacute;TODO DEL TRAPECIO
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
					Integral Analitica:
				</td>		
				<td>
					<input type="text" name="Ix" value="<?php if(isset($_GET['Ix'])) echo $_GET['Ix'];?>">
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

		    $grafico = new Graph(500, 400, 'auto');
		    
		   $trapecios=1;
		   $contador=1;
		   $tolerancia=1/10000;
		   $valorInt=funcion($cotaSup,$_GET['Ix'])-funcion($cotaInf,$_GET['Ix']);
		   echo "<br/>";
		   echo "TABLA DE RESULTADOS<br/>";
		   echo "<br/>";
		   $aux=1;
		
		 echo "<table border='1' >";
      	 echo "<td bgcolor=yellow>N# Iteracion</td>
      	 <td bgcolor=yellow># de trapecios</td>
      	 <td bgcolor=yellow>Integral Numerica</td>
      	 <td bgcolor=yellow> Integral Analitica</td>
      	 <td bgcolor=yellow>Error/integral</td>";
		  
		  while($aux>$tolerancia && $trapecios<500){
		  	echo"<tr >";  

			$h=($cotaSup-$cotaInf)/$trapecios;
			$s=0;
			$aux=0;
			
			

			 for ($i=1; $i<=$trapecios; $i++){
	
			 	$s=(($h/2)*(funcion(($cotaInf+($i-1)*$h),$_GET['Fx'])+funcion(($cotaInf+($i)*$h),$_GET['Fx']))+$s);
			 	
			 }
				$aux=abs($s-$valorInt);
			  echo 
			  "<td>$contador</td>
			  <td>$trapecios </td>
			  <td> $s </td> 
			  <td>$valorInt </td>
			  <td>$aux </td>";
			  echo"<tr>";
			 $trapecios=$trapecios+2;
			 $contador++;
			
			}
	
		    


		}
		 echo "</table>";

			?>
		
	</body>
	</head>
</html>